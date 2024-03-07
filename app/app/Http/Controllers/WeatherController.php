<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\WeatherServices;

class WeatherController extends Controller
{
    public function __construct(protected WeatherServices $weatherService)
    {
    }

    public function getCurrentWeather(Request $request): JsonResponse
    {
        $currentWeather = $this->weatherService->getCurrentWeather($request);

        return response()->json($currentWeather);
    }
}

