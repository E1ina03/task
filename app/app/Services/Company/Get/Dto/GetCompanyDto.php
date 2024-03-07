<?php

namespace App\Services\Company\Get\Dto;

use App\Http\Middleware\Requests\CompanyRequests\GetCompanyRequest;
use Spatie\LaravelData\Data;

class GetCompanyDto extends Data
{
    public int $id;

    public static function fromRequest(GetCompanyRequest$request): GetCompanyDto
    {
        return self::from([
            'id' => $request->getCompanyId(),
        ]);
    }
}
