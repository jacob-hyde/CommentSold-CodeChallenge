<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
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
            'product_name' => $this->product_name,
            'product_id' => $this->product_id,
            'sku' => $this->sku,
            'quantity' => $this->quantity,
            'color' => $this->color,
            'price_cents' => convertCentsToDollars($this->price_cents),
            'cost_cents' => convertCentsToDollars($this->cost_cents),
        ];
    }
}
