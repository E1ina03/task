<?php

declare(strict_types=1);

namespace App\Http\Requests\ProductRequests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequests extends FormRequest
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
