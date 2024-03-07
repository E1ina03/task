<?php

namespace App\Services\User\Update\Dto;

use App\Http\Requests\UserRequests\UpdateUserRequest;
use Spatie\LaravelData\Data;

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
