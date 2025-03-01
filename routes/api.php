<?php

use App\Http\Controllers\Api\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/',[PageController::class,'getMain']);
