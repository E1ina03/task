<?php

declare(strict_types=1);

namespace App\Services\Product\Create\Dto;

use Spatie\LaravelData\Data;
use App\Http\Middleware\Requests\ProductRequests\CreateProductRequests;

class CreateProductDto  extends Data
{

    public string $product_name;
    public int $user_id;
    public static function fromRequest(CreateProductRequests $request): CreateProductDto
    {

        return self::from([
            'product_name' => $request->getProductName(),
            'user_id' => $request->getUserId(),
        ]);
    }
}
