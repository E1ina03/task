<?php

namespace App\Services\User\Delete\Dto;

use App\Http\Middleware\Requests\UserRequests\DeleteUserRequest;
use Spatie\LaravelData\Data;

class DeleteUserDto extends Data
{
    public int $id;

    public static function fromRequest(DeleteUserRequest $request): DeleteUserDto
    {
        return self::from([
            'id' => $request->getUserId(),
        ]);
    }
}
