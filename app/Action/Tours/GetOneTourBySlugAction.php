<?php

namespace App\Action\Tours;

use App\Models\Tour;

class GetOneTourBySlugAction
{

    public function __invoke()
    {

       return Tour::find(4);

    }

}
