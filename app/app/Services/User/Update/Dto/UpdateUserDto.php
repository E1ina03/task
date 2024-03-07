<?php

namespace App\Services\User\Update\Dto;

use Spatie\LaravelData\Data;
use App\Http\Middleware\Requests\UserRequests\UpdateUserRequest;

class UpdateUserDto extends Data
{
    public int $id;
    public string $name;
    public string $email;

    public static function fromRequest(UpdateUserRequest $request): UpdateUserDto
    {
        return self::from([
            'id' => $request->getUserId(),
            'name' => $request->getName(),
            'email' => $request->getEmail(),
        ]);
    }
}
