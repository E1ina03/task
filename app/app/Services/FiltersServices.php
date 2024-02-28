<?php


namespace App\Services;

use App\Repositories\FiltersRepository;
use Illuminate\Database\Eloquent\Builder;

class FiltersServices
{
    protected FiltersRepository $filtersRepository;

    public function __construct(FiltersRepository $filtersRepository)
    {
        $this->filtersRepository = $filtersRepository;
    }

    public function applyFilters(Builder $query, array $filters): Builder
    {
        return $this->filtersRepository->applyFilters($query, $filters);
    }

    public function paginateUser(Builder $query, array $filter): array
    {
        return $this->filtersRepository->paginateUser($query, $filter);
    }
}
