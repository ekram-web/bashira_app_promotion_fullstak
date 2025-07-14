<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'app_store_url',
        'play_store_url',
        'qr_code_image',
        'qr_code_image_playstore',
        'phone_image',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
