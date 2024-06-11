<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Workspace_user extends Model
{
    use HasFactory;

    protected $table = 'workspace_user';

    protected $fillable = [
        'userId',
        'workspaceId'
    ];


    public function hasUser(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'userId', 'id');
    }

    public function hasWorkspace(): BelongsToMany
    {
        return $this->belongsToMany(Workspace::class, 'workspaceId', 'id');
    }
}
