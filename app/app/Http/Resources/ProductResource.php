<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request):  array
    {
        return [
            'id' => $this->id,
            'product_name' => $this->product_name,
            'user_id'=>$this->user_id
        ];
    }
}
