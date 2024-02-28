<?php

namespace App\Services\User\Delete\Actions;

use App\Interfaces\UserRepositoryInterface;
use App\Services\User\Delete\Dto\DeleteDto;

class DeleteAction
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {
    }

    public function run(DeleteDto $dto)
    {
        $userId = $dto->id;

        return $this->userRepository->deleteUser($userId);
    }
}

