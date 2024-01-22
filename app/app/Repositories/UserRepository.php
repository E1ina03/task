<?php

namespace App\Repositories;


use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository
{
    private function query(): Builder
    {
        return User::query();
    }

    public function create(array $data): ?User
    {
        return $this->query()->create($data);
    }

    public function update(array $user ): int
    {
        return $this->query()->update($user);
    }

    public function delete( int $userId):void
    {
         $this->query()->where('id', $userId)->delete();
    }

    public function updateEnable(array $user):void
    {
        $this->query()->update($user);
    }
}
