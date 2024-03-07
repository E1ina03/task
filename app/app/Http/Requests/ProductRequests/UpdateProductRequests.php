<?php

declare(strict_types=1);

namespace App\Http\Requests\ProductRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequests extends FormRequest
{
    public const ID = "id";

    public const PRODUCT_NAME = 'product_name';

    public function rules(): array
    {
        return [
            self::PRODUCT_NAME => [
                'required',
                'string',
            ],
            self::ID => [
                'int',
            ],
        ];
    }

    public function getId(): int
    {
        return $this->get(self::ID);
    }

    public function getProductName(): string
    {
        return $this->get(self::PRODUCT_NAME);
    }
}
