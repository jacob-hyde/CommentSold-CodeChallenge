<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_name' => $this->product_name,
            'description' => $this->description,
            'brand' => $this->brand,
            'style' => $this->style,
            'product_type' => $this->product_type,
            'shipping_price' => $this->shipping_price,
            'note' => $this->note,
        ];
    }
}
