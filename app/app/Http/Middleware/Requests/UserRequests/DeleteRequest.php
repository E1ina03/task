<?php

namespace App\Http\Middleware\Requests\UserRequests;


use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
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
