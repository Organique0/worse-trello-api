<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    use HasFactory;

    protected $primaryKey = 'workspaceId';

    protected $fillable = [
        'title'
    ];

    public function workspaceBoards()
    {
        return $this->hasMany(Board::class, 'boardId', 'workspaceId');
    }
}
