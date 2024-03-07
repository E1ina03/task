<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class GetUserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'data' =>
                [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
            ]
        ];
    }
}
