<?php

declare(strict_types=1);

namespace App\Services\Product\Delete\Dto;

use App\Http\Requests\ProductRequests\DeleteProductRequests;
use Spatie\LaravelData\Data;

class DeleteProductDto extends Data
{
    public int $id;

    public static function fromRequest(DeleteProductRequests $request): DeleteProductDto
    {
        return self::from([
            'id' => $request->getId(),
        ]);
    }
}
