<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class FiltersServices
{
    public function applyFilters(Builder $query, array $filters): Builder
    {
        if (isset($filters['name']))
        {
            $query->orderBy('name', $filters['name']);
        }

        if (isset($filters['firstname']))
        {
            $this->applyFirstnameFilter($query, $filters['firstname']);
        }

        if (isset($filters['enable']))
        {
            $this->applyEnableFilter($query, $filters['enable']);
        }

        return $query;
    }

    public function applyFirstnameFilter(Builder $query, string $firstName): void
    {
        $query->where('name', $firstName);
    }

    public function applyEnableFilter(Builder $query, bool $enable): void
    {
        $query->where('enable', $enable);
    }

    public function paginateUser(Builder $query, array $filter): array
    {
        $perPage = $filter['limit'];
        $page = $filter['offset'];
        $users = $query->paginate($perPage, page:$page);
        $usersTotal = $users->total();

        return ['users' => $users, 'total' => $usersTotal];
    }
}
