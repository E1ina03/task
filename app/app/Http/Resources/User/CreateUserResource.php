<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class CreateUserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'success' => true,
            'message' => 'You have registered successfully!',
            'user' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'role_name' => $request->role_name,
                'enable' => $this->enable,
            ],
        ];
    }
}
