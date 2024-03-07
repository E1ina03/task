<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\WeatherRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class WeatherServices
{
    public function __construct(protected WeatherRepository $weatherRepository)
    {
    }

    public function getCurrentWeather(Request $request): JsonResponse
    {
        $data = $request->toArray();
        $city = $data['city'];
        $apiKey = env('WEATHER_API_KEY');
        $apiUrl = env('WEATHER_URL');
        $url = "$apiUrl$apiKey&q=$city";

        try {
            $response = Http::get($url);
            $data = json_decode($response->body(), true);

            $existingWeather = $this->weatherRepository->findByCity($data['location']['name']);

            if ($existingWeather) {
                $this->weatherRepository->updateTemperature($existingWeather->city, $data['current']['temp_c']);
            } else {
                $this->weatherRepository->create([
                    'city' => $data['location']['name'],
                    'temperature' => $data['current']['temp_c'],
                ]);
            }

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(["error" => "An error has occurred: " . $e->getMessage()], 500);
        }
    }
}
