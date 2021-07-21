<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\StateRegionController;
use App\Http\Controllers\API\TownController;
use App\Http\Controllers\API\Auth\MemberController;
use App\Http\Controllers\API\SupplierController;
use App\Http\Controllers\API\SupplierAddressController;

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
            Route::group(['prefix' => 'members'], function () {
                Route::post('/register', [MemberController::class, 'register']);
                Route::post('/login', [MemberController::class, 'login']);
            });
            Route::group(['middleware' => ['auth:sanctum']], function (){
                Route::get('/state-regions', [StateRegionController::class, 'index']);
                Route::get('/towns/{srPcode}/state-region', [TownController::class, 'index']);
                Route::get('/categories', [CategoryController::class, 'index']);
                Route::resources([
                    '/suppliers' => SupplierController::class,
                ]);
                Route::put('/supplier-addresses/{id}', [SupplierAddressController::class, 'update']);
            });
        });

    });
