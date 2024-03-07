<?php

declare(strict_types=1);

namespace App\Services\Product\Get\Dto;

use App\Http\Requests\ProductRequests\GetProductRequest;
use Spatie\LaravelData\Data;

class GetProductDto extends Data
{
    public int $id;
    public string $product_name;

    public static function fromRequest(GetProductRequest $request): GetProductDto
    {
        return self::from([
            'product_id' => $request->getId(),
        ]);
    }
}
