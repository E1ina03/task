<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UpdateResource;
use App\Services\User\Update\Dto\UpdateDto;
use App\Services\User\Update\Actions\UpdateAction;
use App\Http\Middleware\Requests\UserRequests\UpdateRequest;

class UpdateUserController extends Controller
{
    public function update(
        UpdateRequest $request,
        UpdateAction $updateAction,
    ): UpdateResource {

        $dto = UpdateDto::fromRequest($request);

        $user = $updateAction->run($dto);

        return new UpdateResource($user);
    }
}
