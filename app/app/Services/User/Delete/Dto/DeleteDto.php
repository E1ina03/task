<?php

namespace App\Services\User\Delete\Dto;

use App\Http\Middleware\Requests\UserRequests\DeleteRequest;
use Spatie\LaravelData\Data;

class DeleteDto extends Data
{
    public int $id;

    public static function fromRequest(DeleteRequest $request): DeleteDto
    {
        return self::from([
            'id' => $request->getUserId(),
        ]);
    }
}
