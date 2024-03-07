<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Weather;
use Illuminate\Database\Eloquent\Builder;

class WeatherRepository
{
    private function query(): Builder
    {
        return Weather::query();
    }

    public function findByCity(string $city): ?Weather
    {
        return $this->query()->where('city', $city)->first();
    }

    public function create(array $data): Weather
    {
        return $this->query()->create($data);
    }

    public function updateTemperature(string $city, float $temperature): void
    {
        $this->query()->where('city', $city)->update(['temperature' => $temperature]);
    }
}
