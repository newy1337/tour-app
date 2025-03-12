<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\FileAdder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @method void prepareToAttachMedia(Media $media, FileAdder $fileAdder)
 */
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
