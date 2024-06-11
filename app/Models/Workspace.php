<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workspace extends Model
{
    use HasFactory;

    protected $table = 'workspace';


    protected $fillable = [
        'title',
        'type',
        'description',
    ];

    public function workspaceBoards(): HasMany
    {
        return $this->hasMany(Board::class, 'workspace_id', 'id');
    }

    public function workspaceUser(): BelongsToMany
    {
        return $this->belongsToMany(Workspace_user::class, 'workspace_user', 'id', 'workspaceId');
    }
}
