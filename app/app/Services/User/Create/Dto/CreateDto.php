<?php

namespace App\Services\User\Create\Dto;

use App\Http\Middleware\Requests\UserRequests\CreateRequest;
use Spatie\LaravelData\Data;

class CreateDto extends Data
{
    public string $name;
    public string $email;
    public string $password;
    public int $role_id;
    public bool $enable;

    public static function fromRequest(CreateRequest $request): CreateDto
    {
        return self::from([
            'name' => $request->getName(),
            'email' => $request->getEmail(),
            'password' => bcrypt($request->getPassword()),
            'role_id' => $request->getRoleId(),
            'enable' =>$request->getEnable()
        ]);
    }
}
