<?php

namespace App\Http\Requests\CompanyRequests;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;

class DeleteCompanyRequest extends FormRequest
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

    public function companyId(): int
    {
        return $this->get(self::ID);
    }
}
