<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $table = 'board';

    protected $fillable = [
        'title',
        'visibility',
        'workspace_id',
        'prefs_background_url',
        'prefs_background'

    ];

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorite', 'board_id', 'user_id');
    }

    public function boardLists()
    {
        return $this->hasMany(WorkList::class, 'board_id', 'id');
    }

    public function boardWork()
    {
        return $this->belongsTo(Workspace::class, 'workspace_id', 'id');
    }
}
