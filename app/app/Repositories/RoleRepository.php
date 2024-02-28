<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class RoleRepository
{
    private function query(): Builder
    {
        return Role::query();
    }

    public function findByName(string $name): ?Role
    {
        return $this->query()->where('name', $name)->first();
    }
}
