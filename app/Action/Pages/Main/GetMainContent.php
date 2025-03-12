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
                $tour->header_image = $this->resizeImage($tour->header_image);
                return $tour;
            }),
            'new_tours' => Tour::orderBy('created_at', 'desc')->take(3)->get($this->returnModel()),
            'special_tours' => Tour::orderBy('price_discount', 'desc')->take(3)->get($this->returnModel())->map(function (Tour $tour) {
                $tour->price_with_discount = $tour->price - ($tour->price * $tour->price_discount / 100);
                return $tour;
            }),
            'reviews' => TourReviews::take(3)->get()
        ];
    }


    private function returnModel()
    {
        return [
            'title',
            'title_description',
            'slug',
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
        return "tours/{$filenameWithoutExt}_800x533.{$extension}";

    }

}
