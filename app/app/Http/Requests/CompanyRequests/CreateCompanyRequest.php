<?php

namespace App\Http\Requests\CompanyRequests;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', [Company::class]);
    }

    public const NAME = 'name';

    public const STATUS = 'status';

    public const PHONE = 'phone';

    public function rules()
    {
        return [
            self::NAME => [
                'required',
                'string',
            ],
            self::STATUS => [
                'required',
                'string',
            ],
            self::PHONE => [
                'required',
                'int',
            ],
        ];
    }

    public function getCompanyName(): string
    {
        return $this->get(self::NAME);
    }

    public function getStatus(): string
    {
        return $this->get(self::STATUS);
    }

    public function getPhone(): string
    {
        return $this->get(self::PHONE);
    }

}
