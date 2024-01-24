<?php

namespace App\Services;

use App\Models\Weather;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class WeatherServices
{
    public function getCurrentWeather(Request $request): JsonResponse
    {
        $data = $request->toArray();
        $city = $data['city'];
        $apiKey = env('WEATHER_API_KEY');

     $url = "https://api.weatherapi.com/v1/current.json?key=$apiKey&q=$city";

        try
        {
            $response = Http::get($url);

            $body = $response->body();

            $data = json_decode($body, true);

            $existingWeather = Weather::where('city', $data['location']['name'])->first();

            if ($existingWeather)
            {
                $existingWeather->update(['temperature' => $data['current']['temp_c']]);
            }
            else
            {
                Weather::create(
                    [
                    'city' => $data['location']['name'],
                    'temperature' => $data['current']['temp_c'],
                ]
                );
            }
            return response()->json($data);
        }
        catch (\Exception $e)
        {
            return response()->json(["error" => "An error has occurred: " . $e->getMessage()], 500);
        }
    }
}
