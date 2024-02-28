<?php

namespace App\Services\User\Index\Dto;

use App\Http\Middleware\Requests\UserRequests\IndexRequest;
use Spatie\LaravelData\Data;

class IndexDto extends Data
{
    public string $user;

    public static function fromRequest(IndexRequest $request): IndexDto
    {
        return self::from([
            'user' => $request->getUserId(),
        ]);
    }
}
