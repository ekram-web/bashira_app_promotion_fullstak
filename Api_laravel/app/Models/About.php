<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'mission',
        'vision',
        'values'
    ];

    protected $casts = [
        'values' => 'array'
    ];
}
