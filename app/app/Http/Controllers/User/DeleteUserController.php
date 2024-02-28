<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Middleware\Requests\UserRequests\DeleteRequest;
use App\Http\Resources\User\DeleteResource;
use App\Services\User\Delete\Actions\DeleteAction;
use App\Services\User\Delete\Dto\DeleteDto;

class DeleteUserController extends Controller
{
    public function delete(
        DeleteRequest $deleteRequest,
        DeleteAction $deleteAction
    ): DeleteResource {
        $dto = DeleteDto::fromRequest($deleteRequest);

        $user = $deleteAction->run($dto);

        return new DeleteResource($user);
    }
}
