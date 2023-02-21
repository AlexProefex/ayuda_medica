<?php

namespace App\Http\Resources\Inventory;

use Illuminate\Http\Resources\Json\JsonResource;

class InventoryObject extends JsonResource
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
            'id' => $this->whenNotNull($this->idInventory),
            'attributes'=>[   
                'idInventory' => $this->whenNotNull($this->idInventory),
                'product' => $this->whenNotNull($this->product),     
                'brand' => $this->whenNotNull($this->brand),
                'amount' => $this->whenNotNull($this->amount),
                'unit' => $this->whenNotNull($this->unit),
                'idConsultory' => $this->whenNotNull($this->idConsultory),
                'name' => $this->whenNotNull($this->name),
        
          ]
        ];
    }
}
