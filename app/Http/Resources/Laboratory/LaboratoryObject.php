<?php

namespace App\Http\Resources\Laboratory;

use Illuminate\Http\Resources\Json\JsonResource;

class LaboratoryObject extends JsonResource
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
            'id' => $this->whenNotNull($this->idLaboratory),
            'attributes'=>[   
                'idLaboratory' => $this->whenNotNull($this->idLaboratory),
                'business' => $this->whenNotNull($this->business),     
                'name' => $this->whenNotNull($this->name),
                'orders' => $this->whenNotNull($this->orders),
                'pendientes' => $this->whenNotNull($this->pendientes),
                'email' => $this->whenNotNull($this->email),
                'laboratory_items' => $this->whenNotNull($this->laboratory_items),
          ]
        ];
    }
}
        