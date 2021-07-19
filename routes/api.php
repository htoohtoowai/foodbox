<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\StateRegionController;
use App\Http\Controllers\API\TownController;

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

Route::group(['middleware' => 'localization'], function () {
    Route::group(['prefix' => 'v1.0.0'], function () {
        Route::get('/state-regions', [StateRegionController::class, 'index']);
        Route::get('/towns/{srPcode}/state-region', [TownController::class, 'index']);
        Route::get('/categories', [CategoryController::class, 'index']);
    });
});
