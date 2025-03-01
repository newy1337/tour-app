<?php

namespace App\Http\Controllers\Api;

use App\Action\Pages\Main\GetMainContent;
use App\Http\Controllers\Controller;

class PageController extends Controller
{


    public function getMain(GetMainContent $getMainContent)
    {

        return $getMainContent();
    }

}
