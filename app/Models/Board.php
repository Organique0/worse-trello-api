<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function favoritedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'board_id', 'user_id')->withTimestamps();
    }

    public function boardLists(): HasMany
    {
        return $this->hasMany(WorkList::class, 'board_id', 'id');
    }

    public function boardWork(): BelongsTo
    {
        return $this->belongsTo(Workspace::class, 'workspace_id', 'id');
    }
}
