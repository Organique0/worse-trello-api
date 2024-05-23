<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $primaryKey = 'cardId';

    protected $fillable = [
        'title',
        'order',
        'description',
    ];

    public function cardComment()
    {
        $this->hasMany(Comment::class, 'commentId', 'cardId');
    }

    public function cardLabel()
    {
        $this->hasMany(Label::class, 'labelId', 'cardId');
    }
}
