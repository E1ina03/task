<?php

namespace App\Http\Middleware\Requests\UserRequests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const PASSWORD = 'password';
    public const ROLE_NAME = 'role_name';
    public const ENABLE = 'enable';
    public function rules(): array
    {
        return [
            self::NAME => [
                'required',
                'string',
            ],

            self::EMAIL => [
                'required',
                'string',
                'unique:users',
            ],

            self::PASSWORD => [
                'required',
                'string',
                'min:8',
            ],

            self::ROLE_NAME => [
                'required',
                'string',
            ],

            self::ENABLE => [
                'required',
                'boolean',
            ],
        ];
    }

    public function getName(): string
    {
        return $this->get(self::NAME);
    }

    public function getEmail(): string
    {
        return $this->get(self::EMAIL);
    }

    public function getPassword(): string
    {
        return $this->get(self::PASSWORD);
    }

    public function getRoleName(): string
    {
        return $this->get(self::ROLE_NAME);
    }

    public function getEnable(): bool
    {
        return $this->get(self::ENABLE);
    }
    public function getRoleId(): int
    {
        $role = Role::where('name', $this->get(self::ROLE_NAME))->first();

        if (!$role)
        {
            abort(422, "Role with name '{$this->get(self::ROLE_NAME)}' not found.");
        }
        return $role->id;
    }
}
