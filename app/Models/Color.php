<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $primaryKey = 'colorId';

    protected $fillable = [
        'value',
        'name'
    ];

    public function labelColor()
    {
        return $this->hasMany(Label::class, 'lableId', 'colorId');
    }
}
