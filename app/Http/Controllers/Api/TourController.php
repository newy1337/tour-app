<?php

namespace App\Http\Controllers\Api;

use App\Action\Tours\GetOneTourBySlugAction;
use App\Action\Tours\GetToursAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TourController extends Controller
{

    public function getAll(Request $request, GetToursAction $getToursAction)
    {
        return $getToursAction($request);
    }
    public function getOne(string $slug, GetOneTourBySlugAction $getOneTourBySlugAction)
    {
        return $getOneTourBySlugAction($slug);
    }

    public function contact(Request $request)
    {
        return [
          'name' => $request->name,
          'phone' => $request->phone,
          'tour_slug' => $request->tour_slug,
          'peopleCount' => $request->peopleCount,
        ];
    }
}
