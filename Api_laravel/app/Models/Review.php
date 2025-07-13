<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'name',
        'role',
        'text',
        'image',
        'rating',
        'is_active',
        'order'
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean'
    ];
}
