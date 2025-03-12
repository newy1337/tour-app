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

        $tour->header_image = "{$filenameWithoutExt}1400x470.{$extension}";
        return $tour;


    }

}
