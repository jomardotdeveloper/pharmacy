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
            "id" => $this->id,
            "name" => $this->name,
            "full_name" => $this->full_name,
            "category" => $this->category->name,
            "stocks" => $this->item_stocks,
            "info" => [
                "description" => $this->description,
                "measurement" => $this->measurement,
                "variant" => $this->variant
            ],
            "cost" => [
                "pc" => $this->cost_per_pc,
                "bundle" => $this->cost_per_bundle,
                "half" => $this->cost_per_half
            ],
            "quantity" => [
                "bundle" => $this->quantity_per_bundle,
                "half" => $this->quantity_per_half
            ]
        ];
    }
}
