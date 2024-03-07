<?php

namespace App\Services\Company\Update\Dto;

use App\Http\Requests\CompanyRequests\UpdateCompanyRequest;
use Spatie\LaravelData\Data;

class UpdateCompanyDto extends Data
{
    public int $id;

    public ?string $name;

    public ?string $phone;

    public static function fromRequest(UpdateCompanyRequest $request): UpdateCompanyDto
    {
        return self::from([
            'id'=> $request->getCompanyId(),
            'name' => $request->getCompanyName(),
            'phone' => $request->getPhone()
        ]);
    }
}
