<?php

namespace App\Services\Company\Delete\Dto;

use App\Http\Middleware\Requests\CompanyRequests\DeleteCompanyRequest;
use Spatie\LaravelData\Data;

class DeleteCompanyDto  extends Data
{
    public int $id;

    public static function fromRequest(DeleteCompanyRequest $request): DeleteCompanyDto
    {
        return self::from([
            'id' => $request->companyId(),
        ]);
    }
}
