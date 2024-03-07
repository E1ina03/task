<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\CreateUserRequest;
use App\Http\Requests\UserRequests\DeleteUserRequest;
use App\Http\Requests\UserRequests\GetUserRequest;
use App\Http\Requests\UserRequests\UpdateUserRequest;
use App\Http\Resources\User\CreateUserResource;
use App\Services\User\Create\Actions\CreateUserAction;
use App\Services\User\Create\Dto\CreateUserDto;
use App\Services\User\Delete\Actions\DeleteUserAction;
use App\Services\User\Delete\Dto\DeleteUserDto;
use App\Services\User\Get\Actions\GetUserAction;
use App\Services\User\Get\Dto\GetUserDto;
use App\Services\User\Update\Actions\UpdateUserAction;
use App\Services\User\Update\Dto\UpdateUserDto;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function create(
        CreateUserRequest $request,
        CreateUserAction $registerAction
    ): CreateUserResource {
        $dto = CreateUserDto::fromRequest($request);

        $user = $registerAction->run($dto);

        return new CreateUserResource($user);
    }

    public function update(
        UpdateUserRequest $request,
        UpdateUserAction $updateAction,
    ): JsonResponse {
        $dto = UpdateUserDto::fromRequest($request);

        $user = $updateAction->run($dto);

        return new JsonResponse($user);
    }

    public function delete(
        DeleteUserRequest $deleteRequest,
        DeleteUserAction $deleteAction
    ): JsonResponse {
        $dto = DeleteUserDto::fromRequest($deleteRequest);

        $user = $deleteAction->run($dto);

        return new JsonResponse($user);
    }

    public function getUserById(
        GetUserRequest $getUserRequest,
        GetUserAction $getUserAction
    ): JsonResponse {
        $dto = GetUserDto::fromRequest($getUserRequest);

        $user = $getUserAction->run($dto);

        return new JsonResponse($user);
    }
}
