<?php

namespace App\Http\Resources\Treatment;

use Illuminate\Http\Resources\Json\JsonResource;

class TreatmentObject extends JsonResource
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
            'id' => $this->whenNotNull($this->idTreatment),
            'attributes'=>[   
                'idTreatment' => $this->whenNotNull($this->idTreatment),
                'name' => $this->whenNotNull($this->name),     
                'price' => $this->whenNotNull($this->price)
          ]
        ];
    }
}
