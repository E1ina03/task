<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UpdateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'success' => true,
            'message' => 'You have updated successfully!',
        ];
    }
}
