<?php

namespace App\Action\Tours;

use App\Models\Tour;

class GetOneTourBySlugAction
{

    public function __invoke($slug)
    {

        $tour =  Tour::where('slug', $slug)->firstOrFail();


        $pathOriginal = $tour->header_image;
        $filenameWithoutExt = pathinfo($pathOriginal, PATHINFO_FILENAME);
        $extension = pathinfo($pathOriginal, PATHINFO_EXTENSION);

        $tour->header_image = "{$filenameWithoutExt}_1400x470.{$extension}";

        $tour->related = Tour::inRandomOrder()
            ->where('hidden',false)
            ->take(6)
            ->get($this->returnModel())
            ->map(function ($tour) {
                $tour->header_image = $this->resizeImage($tour->header_image);
                return $tour;
            });
        return $tour;


    }

    private function resizeImage($image): string
    {
        $filenameWithoutExt = pathinfo($image, PATHINFO_FILENAME);
        $extension = pathinfo($image, PATHINFO_EXTENSION);
        return "tours/{$filenameWithoutExt}_800x533.{$extension}";

    }

    private function returnModel(): array
    {
        return ['*'];
    }

}
