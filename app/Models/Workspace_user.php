<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace_user extends Model
{
    use HasFactory;

    protected $table = 'workspace_user';

    protected $fillable = [
        'userId',
        'workspaceId'
    ];

    public function hasUser()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function hasWorkspace()
    {
        return $this->belongsTo(Workspace::class, 'workspaceId', 'id');
    }
}
