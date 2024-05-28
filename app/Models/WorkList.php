<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkList extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'order',
        'description'
    ];

    public function worklistCard()
    {
        return $this->hasMany(Card::class, 'id', 'id');
    }
}
