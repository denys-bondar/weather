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
    Route::post('login', [AuthController::class, 'login'])->name('api-v1.login');
    Route::post('register', [UserController::class, 'register'])->name('api-v1.register');

    Route::middleware('auth:api')->group(function () {

        Route::prefix('user')->group(function () {
            Route::get('', [UserController::class, 'me'])->name('api-v1.user.info');
            Route::patch('update', [UserController::class, 'updateUser'])->name('api-v1.user.update');
            Route::get('weather', [WeatherController::class, 'getWeatherByCity'])->name('api-v1.user.weather');
            Route::get('logout', [AuthController::class, 'logout'])->name('api-v1.logout');;
        });
    });
});
