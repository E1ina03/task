<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Services\User\Create\Dto\CreateUserDto;
use App\Services\User\Update\Dto\UpdateUserDto;

interface UserRepositoryInterface
{
    public function createUser(CreateUserDto $dto): Model|Builder;

    public function updateUser(UpdateUserDto $dto, int $userId): void;
    public function deleteUser(int $userId): void;
    public function getUserById(int $userId): ?User;
}
