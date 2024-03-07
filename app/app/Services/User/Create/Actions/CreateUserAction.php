<?php

namespace App\Services\User\Create\Actions;

use App\Interfaces\UserRepositoryInterface;
use App\Services\User\Create\Dto\CreateUserDto;

class CreateUserAction
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    )
    {
    }

    public function run(CreateUserDto $dto)
    {
        return $this->userRepository->createUser($dto);
    }
}
