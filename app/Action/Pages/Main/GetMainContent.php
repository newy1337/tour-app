<?php

namespace App\Action\Pages\Main;

use App\Models\Tour;
use App\Models\TourReviews;

class GetMainContent
{

    public function __invoke()
    {

        return [
            'tours' => Tour::inRandomOrder()->take(6)->get($this->returnModel())->map(function ($tour) {
                $attributes = $tour->getAttributes();
                $attributes['header_image'] = $this->resizeImage($tour->getOriginal('header_image'));
                $tour->setRawAttributes($attributes, false);
                return $tour;
            }),
            'new_tours' => Tour::orderBy('created_at', 'desc')->take(3)->get($this->returnModel()),
            'special_tours' => Tour::orderBy('price_discount', 'desc')->take(3)->get($this->returnModel()),
            'reviews' => TourReviews::take(3)->get()
        ];
    }


    private function returnModel()
    {
        return [
            'title',
            'title_description',
            'price',
            'header_image',
            'price_discount',
            'rating',
            'tags',
            'duration',
        ];

    }


    private function resizeImage($image): string
    {
        $filenameWithoutExt = pathinfo($image, PATHINFO_FILENAME);
        $extension = pathinfo($image, PATHINFO_EXTENSION);
        $baseUrl = url('/');
        return "{$baseUrl}/storage/tours/{$filenameWithoutExt}_800x533.{$extension}";

    }

}
