<?php

namespace App\Http\Middleware\Requests\ProductRequests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequests extends FormRequest
{

    public const PRODUCT_NAME = 'product_name';


    public function rules(): array
    {
        return [
            self::PRODUCT_NAME => [
                'required',
                'string',
            ],
        ];
    }

    public function getProductName(): string
    {
        return $this->get(self::PRODUCT_NAME);
    }

    public function  getUserId(): int
    {
        return $this->user()->id;
    }
    }
