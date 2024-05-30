<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite_user_board extends Model
{
    use HasFactory;

    protected $fillable = [
        'u_id',
        'b_id'
    ];

    public function hasUser()
    {
        return $this->belongsTo(User::class, 'u_id', 'id');
    }

    public function hasBoard()
    {
        return $this->belongsTo(Board::class, 'b_id', 'id');
    }
}
