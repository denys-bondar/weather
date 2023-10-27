<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\WeatherService;
use Illuminate\Http\JsonResponse;


class WeatherController extends Controller
{

    public function __construct(private readonly WeatherService $weatherService)
    {
    }

    public function getWeatherByCity(): JsonResponse
    {
        return  $this->weatherService->getWeatherByCity();
    }

}
