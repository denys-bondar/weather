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

    /**
     * @OA\Get (
     *     path="/api/v1/user/weather",
     *     operationId="GetWeatherByCityUser",
     *     tags={"User"},
     *     summary="get weather by city of user",
     *     security={{"bearer_token":{}}},
     *     @OA\Response(response=200, description="OK")
     * )
     */
    public function getWeatherByCity(): JsonResponse
    {
        return  $this->weatherService->getWeatherByCity();
    }

}
