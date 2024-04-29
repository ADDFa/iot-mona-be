<?php

use App\Http\Controllers\EggController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(EggController::class)->group(function () {
    Route::get("egg", "index");
    Route::get("egg/total-clasification", "totalClassification");
    Route::post("egg", "store");
});
