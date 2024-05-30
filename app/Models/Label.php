<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $table = 'label';


    protected $fillable = [
        'title'
    ];

    public function labelCard()
    {
        return $this->belongsTo(Card::class, 'id', 'cd_id');
    }

    public function labelColor()
    {
        return $this->belongsTo(Color::class, 'id', 'co_id');
    }
}
