<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Exceptions\Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Interfaces\UserRepositoryInterface;
use App\Services\User\Create\Dto\CreateUserDto;
use App\Services\User\Update\Dto\UpdateUserDto;

class UserRepository implements UserRepositoryInterface
{
    private function query(): Builder
    {
        return User::query();
    }

    public function createUser(CreateUserDto $dto): Model|Builder
    {
        return $this->query()->create([
            "name" => $dto->name,
            "email" => $dto->email,
            "password" => $dto->password,
            "enable" => $dto->enable,
            "role_id" => $dto->role_id
        ]);
    }

    public function deleteUser(int $userId): void
    {
        $user = $this->query()->find($userId);

        if ($user === null) {
            throw new \Exception('Product not found');
        } else {
            $user->update([
                'name' => 'deleted',
                'email' => "$userId deleted",
                'password' => "$userId deleted",
                'created_at' => null,
                'updated_at' => null,
                'enable' => 0,
                'role_id' => null,
            ]);
        }
    }

    public function updateUser(UpdateUserDto $dto, int $userId): void
    {
        $user = $this->query()->find($userId);

        if ($user === null) {
            throw new \Exception('User not found');
        } else {
            $this->query()->where('id', $userId)->update([
                'name' => $dto->name,
                'email' => $dto->email
            ]);
        }
    }

    public function getUserById(int $userId): ?User
    {
        $user = User::query()->where('id', $userId)->first();
        if ($user === null) {
            throw new Exception('Product not found');
        }

        return $user;
    }

//    public function getUsersWithProducts(int $userId): ?User
//    {
//        return $this->query()->with('products')->find($userId);
//    }
}
