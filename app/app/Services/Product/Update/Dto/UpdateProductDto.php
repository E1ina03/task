<?php

declare(strict_types=1);

namespace App\Services\Product\Update\Dto;

use Spatie\LaravelData\Data;
use App\Http\Middleware\Requests\ProductRequests\UpdateProductRequests;

class UpdateProductDto extends Data
{
    public int $id;
    public string $product_name;

    public static function fromRequest(UpdateProductRequests $request): UpdateProductDto
    {
        return self::from([
            'id' => $request->getId(),
            'product_name' => $request->getProductName(),
        ]);
    }
}