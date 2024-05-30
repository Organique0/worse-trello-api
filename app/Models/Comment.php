<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';


    protected $fillable = [
        'content'
    ];

    public function userComment()
    {
        return $this->belongsTo(User::class, 'id', 'u_id');
    }

    public function cardComment()
    {
        return $this->belongsTo(Card::class, 'id', 'c_id');
    }
}
