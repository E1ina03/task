<?php

namespace App\Http\Requests\CompanyRequests;


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

    public const PHONE = 'phone';

    public function rules()
    {
        return [
            self::NAME => [
                'string',
            ],

            self::PHONE => [
                'min:8',
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
    $phone = $this->get('phone');
    $pattern = '/[a-zA-Zа-яА-Я]/u';
        if (preg_match($pattern, $phone)) {
            throw new \Exception('phone number must contain only numbers');
        }
        return $phone;
    }
}

