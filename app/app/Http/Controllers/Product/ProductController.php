<?php

declare(strict_types=1);

namespace App\Http\Controllers\Product;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\Product\Get\Dto\GetProductDto;
use App\Services\Product\Update\Dto\UpdateProductDto;
use App\Services\Product\Create\Dto\CreateProductDto;
use App\Services\Product\Delete\Dto\DeleteProductDto;
use App\Http\Resources\Product\CreateProductResource;
use App\Services\Product\Get\Actions\GetProductActions;
use App\Services\Product\Update\Actions\UpdateProductAction;
use App\Services\Product\Create\Actions\CreateProductAction;
use App\Services\Product\Delete\Actions\DeleteProductActions;
use App\Http\Middleware\Requests\ProductRequests\GetProductRequest;
use App\Http\Middleware\Requests\ProductRequests\DeleteProductRequests;
use App\Http\Middleware\Requests\ProductRequests\UpdateProductRequests;
use App\Http\Middleware\Requests\ProductRequests\CreateProductRequests;

class ProductController extends Controller
{
    public function create(
        CreateProductRequests $requests,
        CreateProductAction $createAction,
    ): CreateProductResource {
        $dto = CreateProductDto::fromRequest($requests);

        $product = $createAction->run($dto);

        return new CreateProductResource($product);
    }

    public function update(
        UpdateProductRequests $updateRequest,
        UpdateProductAction $updateAction,
    ): JsonResponse {
        $dto = UpdateProductDto::fromRequest($updateRequest);

        $product = $updateAction->run($dto);

        return new JsonResponse($product);
    }

    public function delete(
        DeleteProductRequests $updateRequest,
        DeleteProductActions $updateAction,
    ): JsonResource {
        $dto = DeleteProductDto::fromRequest($updateRequest);

        $product = $updateAction->run($dto);

        return new JsonResource($product);
    }

    public function getProduct(
        GetProductRequest $requests,
        GetProductActions $createAction,
    ): JsonResponse {
        $dto = GetProductDto::fromRequest($requests);

        $product = $createAction->run($dto);

        return new JsonResponse($product);
    }
}
