<?php

declare(strict_types=1);

namespace App\Services\Product\Create\Dto;

use App\Http\Requests\ProductRequests\CreateProductRequests;
use Spatie\LaravelData\Data;

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
