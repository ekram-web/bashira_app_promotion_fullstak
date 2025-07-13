<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'address',
        'phone',
        'email',
        'website',
        'map_embed_url',
        'social_media',
        'working_hours'
    ];

    protected $casts = [
        'social_media' => 'array',
        'working_hours' => 'array'
    ];
}
