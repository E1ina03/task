<?php

declare(strict_types=1);

namespace App\Http\Middleware\Requests\ProductRequests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteProductRequests extends FormRequest
{
    public const ID = "id";

    public function rules(): array
    {
        return [
            self::ID => [
                'int',
            ],
        ];
    }
    public function getId(): int
    {
        return $this->get(self::ID);
    }
}
