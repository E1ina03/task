<?php
namespace App\Interfaces;

use App\Services\User\Create\Dto\CreateDto;
use App\Services\User\Update\Dto\UpdateDto;

interface UserRepositoryInterface
{
    public function createUser(CreateDto $dto);

    public function updateUser(UpdateDto $dto, int $userId);
    public function deleteUser($userId);
    public function index($indexId);
}
