<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\WeatherServices;

class WeatherController extends Controller
{
    public function __construct(protected WeatherServices $weatherService) {}
    public function getCurrentWeather(Request $request): JsonResponse
    {
        $apiKey = env('WEATHER_API_KEY');

        $city = $request->toArray();

        $currentWeather = $this->weatherService->getCurrentWeather($apiKey, $city);

        return response()->json($currentWeather);
    }
}

