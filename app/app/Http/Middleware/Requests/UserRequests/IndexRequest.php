<?php

namespace App\Http\Middleware\Requests\UserRequests;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
