<?php

namespace App\Http\Middleware\Requests\CompanyRequests;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;

class GetCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', [Company::class]);
    }

    public const ID = 'id';

    public function rules()
    {
        return [
            self::ID => [
                'int',
            ],
        ];
    }

    public function getCompanyId(): int
    {
        return $this->get(self::ID);
    }
}
