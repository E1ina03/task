<?php

namespace App\Services\Company\Create\Dto;


use App\Http\Middleware\Requests\CompanyRequests\CreateCompanyRequest;
use Spatie\LaravelData\Data;

class CreateCompanyDto extends Data
{
    public string $name;

    public string $status;

    public int $phone;

    public static function fromRequest(CreateCompanyRequest $request): CreateCompanyDto
    {
        return self::from([
            'name' => $request->getCompanyName(),
            'status' => $request->getStatus(),
            'phone' => $request->getPhone()
        ]);
    }
}
