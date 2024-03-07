<?php

namespace App\Http\Middleware\Requests\CompanyRequests;


use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', [Company::class]);
    }

    public const ID = 'id';
    public const NAME = 'name';



    public function rules()
    {
        return [
            self::NAME => [
                'string',
            ],

            self::ID => [
                'int',
            ],
        ];
    }

    public function getCompanyId(): int
    {
        return $this->get(self::ID);
    }

    public function getCompanyName(): ?string
    {
        return $this->get('name');
    }

    public function getPhone(): ?string
    {
        return $this->get('phone');
    }
}
