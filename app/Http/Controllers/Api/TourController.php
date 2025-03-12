<?php

namespace App\Http\Controllers\Api;

use App\Action\Tours\GetOneTourBySlugAction;
use App\Http\Controllers\Controller;

class TourController extends Controller
{

    public function getOne(GetOneTourBySlugAction $getOneTourBySlugAction)
    {
        return $getOneTourBySlugAction();
    }
}
