<?php

namespace App\Services\User\Delete\Actions;

use App\Exceptions\Exception;
use App\Interfaces\UserRepositoryInterface;
use App\Services\User\Delete\Dto\DeleteUserDto;

class DeleteUserAction
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {
    }

    public function run(DeleteUserDto $dto)
    {
        $userId = $dto->id;
        try {
            return $this->userRepository->deleteUser($userId);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

