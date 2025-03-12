<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\FileAdder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @method void prepareToAttachMedia(Media $media, FileAdder $fileAdder)
 */
class Tour extends Model implements HasMedia
{

    use InteractsWithMedia;
    protected $guarded = [];


    protected $casts = [
        'images' => 'array',
        'program' => 'array',
        'description' => 'array',
        'header_image' => 'array',
        'tags' => 'array'
    ];


    //

    public function registerMediaConversions(Media $media = null): void
    {
        // Первая конверсия 800x533
        $this->addMediaConversion('size_800_533')
            ->width(800)
            ->height(533)
            ->sharpen(10);

        // Вторая конверсия 1000x470
        $this->addMediaConversion('size_1000_470')
            ->width(1000)
            ->height(470)
            ->sharpen(10);
    }


}
