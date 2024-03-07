<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class DeleteUserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'success' => true,
            'message' => 'You have deleted successfully!',
        ];
    }
}
