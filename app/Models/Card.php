<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'card';


    protected $fillable = [
        'title',
        'order',
        'description',
        'list_id'
    ];

    public function cardComment()
    {
        return $this->hasMany(Comment::class, 'id', 'id');
    }

    public function cardLabel()
    {
        return $this->hasMany(Label::class, 'id', 'id');
    }

    public function cardList()
    {
        return $this->belongsTo(BoardList::class, 'list_id', 'id');
    }
}
