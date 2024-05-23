<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $primaryKey = 'boardId';

    protected $fillable = [
        'title',
        'imgThumb',
        'imgFull',
        'imgAuthor',
        'imgSite'
    ];

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorited', 'boardId', 'userId');
    }

    public function boardLists()
    {
        return $this->hasMany(WorkList::class, 'listId', 'boardId');
    }
}
