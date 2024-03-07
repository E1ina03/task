<?php

declare(strict_types=1);

namespace App\Http\Middleware\Requests\UserRequests;

use Illuminate\Foundation\Http\FormRequest;

class GetUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }

    public function getUserId()
    {
        return $this->user()->id;
    }
}
