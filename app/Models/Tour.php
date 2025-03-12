<?php

namespace App\Models;

use App\Casts\ImageCast;
use App\Casts\ImageProgramCast;
use App\Casts\ImagesArrCast;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\FileAdder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @method void prepareToAttachMedia(Media $media, FileAdder $fileAdder)
 */
class Tour extends Model
{

    /**
     * @var float|int|mixed
     */
    protected $guarded = [];


    protected $casts = [
        'images' => 'array',
        'program' => 'json',
        'description' => 'array',
        'header_image' => 'string',
        'tags' => 'array'
    ];


    //




}
