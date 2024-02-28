<?php

namespace App\Services\Product\Read\Dto;

use App\Http\Middleware\Requests\ProductRequests\ReadRequest;
use Spatie\LaravelData\Data;

class ReadDto extends Data
{
    public int $id;
    public string $product_name;

    public static function fromRequest(ReadRequest $request): ReadDto
    {
        return self::from([
            'id' => $request->getId(),
        ]);
    }
}
