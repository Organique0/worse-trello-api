<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardList extends Model
{
    use HasFactory;

    protected $table = 'list';


    protected $fillable = [
        'title',
        'order',
        'board_id'
    ];

    public function BoardListCard()
    {
        return $this->hasMany(Card::class, 'id', 'list_id');
    }

    public function board()
    {
        return $this->belongsTo(Board::class, 'board_id', 'id');
    }
}
