<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class CreateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_name' => $this->product_name,

        ];
    }
}
