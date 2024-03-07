<?php

declare(strict_types=1);

namespace App\Http\Middleware\Requests\UserRequests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteUserRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            //
        ];
    }

    public function getUserId(): int
    {
        return $this->user()->id;
    }
}
