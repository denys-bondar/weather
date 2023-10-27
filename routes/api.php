<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);


    Route::middleware('auth:api')->group(function () {

        Route::prefix('user')->group(function () {
            Route::get('', [UserController::class, 'me']);
            Route::patch('update', [UserController::class, 'updateUser']);
            Route::patch('update', [UserController::class, 'updateUser']);

            Route::get('logout', [AuthController::class, 'logout']);

            Route::get('weather', [WeatherController::class, 'getWeatherByCity']);
        });

    });
});
