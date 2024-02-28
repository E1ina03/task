<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Services\Product\Update\Dto\UpdateDto;
use App\Services\Product\Update\Actions\UpdateAction;
use App\Http\Middleware\Requests\ProductRequests\UpdateRequests;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateProductController extends Controller
{
    public function update(
        UpdateRequests $updateRequest,
        UpdateAction $updateAction,
    ): JsonResource {

        $dto = UpdateDto::fromRequest($updateRequest);


       $product = $updateAction->run($dto);

        return new JsonResource($product);
    }
}
