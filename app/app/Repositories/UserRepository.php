<?php

namespace App\Repositories;

use App\Models\User;
use App\Services\User\Create\Dto\CreateDto;
use App\Services\User\Update\Dto\UpdateDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private function query(): Builder
    {
        return User::query();
    }

    public function createUser(CreateDto $dto): Model|Builder
    {
        return $this->query()->create([
            "name" => $dto->name,
            "email" => $dto->email,
            "password" => $dto->password,
            "enable" => $dto->enable,
            "role_id" => $dto->role_id
        ]);
    }

    public function deleteUser($userId)
    {

        $user = $this->query()->find($userId);

        if ($user) {

           return $user->update([
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

    public function updateUser(UpdateDto $dto, int $userId)
    {
        return $this->query()->where('id',$userId)->update([
            'name' => $dto->name,
            'email' => $dto->email
        ]);
    }

    public function index($indexId): Model|Builder|null
    {
        return User::query()->where('id', $indexId)->first();
    }

//    public function getUsersWithProducts(int $userId): ?User
//    {
//        return $this->query()->with('products')->find($userId);
//    }
}
