<?php

namespace App\Services\User\Update\Actions;

use App\Interfaces\UserRepositoryInterface;
use App\Services\User\Update\Dto\UpdateDto;

class UpdateAction
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {
    }

    public function run(UpdateDto $dto)
    {
        $userId = $dto->id;

        return $this->userRepository->updateUser($dto, $userId);
    }
}
