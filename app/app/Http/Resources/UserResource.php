<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     * @property int $id
     */
    public function toArray($request):array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role_name,
            'products' => $this->whenLoaded('products'),
        ];
    }
}
