<?php

declare(strict_types=1);

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
