<?php

namespace App\Services\Product\Update\Dto;

use Spatie\LaravelData\Data;
use App\Http\Middleware\Requests\ProductRequests\UpdateRequests;

class UpdateDto extends Data
{
    public int $id;
    public string $product_name;

    public static function fromRequest(UpdateRequests $request): UpdateDto
    {
        return self::from([
            'id' => $request->getId(),
            'product_name' => $request->getProductName(),
        ]);
    }
}
