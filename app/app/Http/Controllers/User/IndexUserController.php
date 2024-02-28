<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\Index\Dto\IndexDto;
use App\Http\Resources\User\IndexResource;
use App\Services\User\Index\Actions\IndexAction;
use App\Http\Middleware\Requests\UserRequests\IndexRequest;

class IndexUserController extends Controller
{
    public function index(
        IndexRequest $indexRequest,
        IndexAction $indexAction
    ): IndexResource
    {
        $dto = IndexDto::fromRequest($indexRequest);

        $user = $indexAction->run($dto);

        return new IndexResource($user);
    }
}
