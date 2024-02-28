<?php

namespace App\Http\Controllers\Product;

use App\Http\Middleware\Requests\ProductRequests\DeleteRequests;
use App\Services\Product\Delete\Actions\DeleteActions;
use App\Services\Product\Delete\Dto\DeleteDto;
use Illuminate\Http\Resources\Json\JsonResource;

class DeleteProductController
{
    public function delete(
        DeleteRequests $updateRequest,
        DeleteActions $updateAction,
    ): JsonResource {

        $dto = DeleteDto::fromRequest($updateRequest);


        $product = $updateAction->run($dto);

        return new JsonResource($product);
    }
}
