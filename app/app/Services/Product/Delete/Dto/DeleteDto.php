<?php

namespace App\Services\Product\Delete\Dto;

use App\Http\Middleware\Requests\ProductRequests\DeleteRequests;
use Spatie\LaravelData\Data;

class DeleteDto extends Data
{
    public int $id;

    public static function fromRequest(DeleteRequests $request): DeleteDto
    {
        return self::from([
            'id' => $request->getId(),
        ]);
    }
}
