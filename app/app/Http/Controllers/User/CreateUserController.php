<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\Create\Dto\CreateDto;
use App\Http\Resources\User\CreateResource;
use App\Services\User\Create\Actions\CreateAction;
use App\Http\Middleware\Requests\UserRequests\CreateRequest;

class CreateUserController extends Controller
{
    public function create(
        CreateRequest $request,
        CreateAction $registerAction
    ): CreateResource {
        $dto = CreateDto::fromRequest($request);

        $user = $registerAction->run($dto);

        return new CreateResource($user);
    }
}
