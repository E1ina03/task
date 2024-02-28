<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Requests\ProductRequests\ReadRequest;

use App\Services\Product\Read\Actions\ReadActions;
use App\Services\Product\Read\Dto\ReadDto;
use Illuminate\Http\Resources\Json\JsonResource;

class ReadProductController extends Controller
{
    public function read(
        ReadRequest $requests,
        ReadActions $createAction,
    ): JsonResource
    {


        $dto = ReadDto::fromRequest($requests);

        $product = $createAction->run($dto);

        return new JsonResource($product);
    }
}
