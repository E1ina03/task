<?php

declare(strict_types=1);

namespace App\Http\Requests\UserRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public const NAME = 'name';
    public const EMAIL = 'email';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::NAME => 'string',
            self::EMAIL => 'string|email|unique:users,email,' . auth()->id(),
        ];
    }

    public function getName(): ?string
    {
        return $this->input(self::NAME);
    }

    public function getEmail(): ?string
    {
        return $this->input(self::EMAIL);
    }

    public function getUserId(): int
    {
        return $this->user()->id;
    }
}
