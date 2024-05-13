<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSocial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function callback($service)
    {
        $serviceUser = Socialite::driver($service)->user();
        $email = $serviceUser->getEmail();
        $name = $serviceUser->getName();

        $nameParts = explode(" ", $name);
        $first_name = $nameParts[0];
        $last_name = $nameParts[1];

        $username = $serviceUser->getNickname();
        if (is_null($username)) {
            $username = $name;
        };

        $user = $this->getExistingUser($serviceUser, $email, $service);

        $newUser = false;
        if (!$user) {
            $newUser = true;

            $user = User::create([
                'username' => $username,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' => '',
                'avatar_url' => $serviceUser->getAvatar(),
                'email_verified_at' => Carbon::now()
            ]);
        }

        if ($this->needsToCreateSocial($user, $service)) {
            UserSocial::create([
                'user_id' => $user->id,
                'social_id' => $serviceUser->getId(),
                'service' => $service
            ]);
        }

        Auth::login($user);

        return redirect(env('FRONTEND_URL'));
        //return redirect(env('CLIENT_BASE_URL') . '/auth/social-callback?token=' . $this->auth->fromUser($user) . '&origin=' . ($newUser ? 'register' : 'login'));
    }




    public function needsToCreateSocial(User $user, $service)
    {
        return !$user->hasSocialLinked($service);
    }

    public function getExistingUser($serviceUser, $email, $service)
    {
        return User::where('email', $email)->orWhereHas('social', function ($q) use ($serviceUser, $service) {
            $q->where('social_id', $serviceUser->getId())->where('service', $service);
        })->first();
    }
}
