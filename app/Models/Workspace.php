<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    use HasFactory;

    protected $table = 'workspace';


    protected $fillable = [
        'title'
    ];

    public function workspaceBoards()
    {
        return $this->belongsTo(Board::class, 'w_id', 'id');
    }

    public function workspaceUser()
    {
        return $this->belongsToMany(WorkList::class, 'workspace_user', 'userId', 'id');
    }
}
