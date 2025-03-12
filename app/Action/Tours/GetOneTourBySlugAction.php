<?php

namespace App\Action\Tours;

use App\Models\Tour;

class GetOneTourBySlugAction
{

    public function __invoke($slug)
    {

        return Tour::where('slug', $slug)->firstOrFail();

    }

}
