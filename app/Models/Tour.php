<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $guarded = [];


    protected $casts = [
        'images' => 'array',
        'program' => 'array',
        'description' => 'array',
        'header_image' => 'array',
        'tags' => 'array'
    ];
    //
}
