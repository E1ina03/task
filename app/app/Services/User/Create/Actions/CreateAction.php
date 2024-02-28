<?php

namespace App\Services\User\Create\Actions;

use App\Interfaces\UserRepositoryInterface;
use App\Services\User\Create\Dto\CreateDto;

class CreateAction
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    )
    {
    }

    public function run(CreateDto $dto)
    {
        return $this->userRepository->createUser($dto);
    }
}
