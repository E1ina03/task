<?php

declare(strict_types=1);

namespace App\Services\User\Get\Dto;

use App\Http\Requests\UserRequests\GetUserRequest;
use Spatie\LaravelData\Data;

class GetUserDto extends Data
{
    public int $userId;

    public static function fromRequest(GetUserRequest $request): GetUserDto
    {

        return self::from([
            'userId' => $request->getUserId(),
        ]);
    }
}
