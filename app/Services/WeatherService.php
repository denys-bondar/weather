<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use RakibDevs\Weather\Weather;
use Exception;

class WeatherService
{
    use ApiResponser;

    public function __construct(private readonly UserService $userService)
    {
    }

    public function getWeatherByCity(): JsonResponse
    {
        try{

            $wt = new Weather();
            $user = User::find(auth()->id());
            $weather = $wt->getCurrentByCity($user->city);
            return  $this->successResponse([
                "weather" => $weather
            ]);
        } catch (Exception $exception) {
            return $this->errorResponseException($exception, $exception->getMessage(), 400);
        }
    }

}
