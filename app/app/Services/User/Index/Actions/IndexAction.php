<?php

namespace App\Services\User\Index\Actions;

use App\Interfaces\UserRepositoryInterface;
use App\Services\User\Index\Dto\IndexDto;


class IndexAction{
    public function __construct(
    protected UserRepositoryInterface $userRepository
) {
}

    public function run(IndexDto $dto)
{
    return $this->userRepository->index($dto->toArray());
}
}
