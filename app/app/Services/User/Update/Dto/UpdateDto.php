<?php

namespace App\Services\User\Update\Dto;

use Spatie\LaravelData\Data;
use App\Http\Middleware\Requests\UserRequests\UpdateRequest;

class UpdateDto extends Data
{
    public int $id;
    public string $name;
    public string $email;

    public static function fromRequest(UpdateRequest $request): UpdateDto
    {
        return self::from([
            'id' => $request->getUserId(),
            'name' => $request->getName(),
            'email' => $request->getEmail(),
        ]);
    }
}
