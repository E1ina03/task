<?php

namespace App\Services\Product\Create\Dto;

use Spatie\LaravelData\Data;
use App\Http\Middleware\Requests\ProductRequests\CreateRequests;

class CreateDto  extends Data
{

    public string $product_name;
    public string $user_id;
    public static function fromRequest(CreateRequests $request): CreateDto
    {

        return self::from([
            'product_name' => $request->getProductName(),
            'user_id' => $request->getUserId(),
        ]);
    }
}
