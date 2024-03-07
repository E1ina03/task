<?php

namespace App\Services\User\Update\Actions;

use App\Exceptions\Exception;
use App\Interfaces\UserRepositoryInterface;
use App\Services\User\Update\Dto\UpdateUserDto;

class UpdateUserAction
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {
    }

    public function run(UpdateUserDto $dto)
    {
        $userId = $dto->id;
        try {
            return $this->userRepository->updateUser($dto, $userId);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
