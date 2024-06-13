<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite_user_board extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    protected $fillable = [
        'user_id',
        'board_id'
    ];

    public function hasUser()
    {
        return $this->belongsToMany(User::class, 'user_id', 'id');
    }

    public function hasBoard()
    {
        return $this->belongsToMany(Board::class, 'board_id', 'id');
    }
}
