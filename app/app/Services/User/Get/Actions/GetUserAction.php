<?php

declare(strict_types=1);

namespace App\Services\User\Get\Actions;

use App\Exceptions\Exception;
use App\Interfaces\UserRepositoryInterface;
use App\Services\User\Get\Dto\GetUserDto;

class GetUserAction
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {
    }

    public function run(GetUserDto $dto)
    {
        try {
            return $this->userRepository->getUserById($dto->userId);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
