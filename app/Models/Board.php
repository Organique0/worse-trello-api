<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;



    protected $fillable = [
        'title',
        'imgThumb',
        'imgFull',
        'imgAuthor',
        'imgSite'
    ];

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorite', 'id', 'userId');
    }

    public function boardLists()
    {
        return $this->hasMany(WorkList::class, 'id', 'id');
    }

    public function boardWork()
    {
        return $this->belongsTo(Workspace::class, 'id', 'id');
    }
}
