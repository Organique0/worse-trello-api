<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'order',
        'description',
    ];

    public function cardComment()
    {
        $this->hasMany(Comment::class, 'id', 'id');
    }

    public function cardLabel()
    {
        $this->hasMany(Label::class, 'id', 'id');
    }

    public function cardList()
    {
        $this->belongsTo(WorkList::class, 'id', 'I_id');
    }
}
