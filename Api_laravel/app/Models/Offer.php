<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'section_title',
        'section_description',
    ];
}
