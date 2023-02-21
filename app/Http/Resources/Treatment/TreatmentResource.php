<?php

namespace App\Http\Resources\Treatment;

use Illuminate\Http\Resources\Json\JsonResource;

class TreatmentResource extends JsonResource
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
         
                'idTreatment' => $this->whenNotNull($this->idTreatment),
                'name' => $this->whenNotNull($this->name),     
                'price' => $this->whenNotNull($this->price),
                'hasMaterial' => $this->whenNotNull($this->hasMaterial)
         
          
        ];
    }
}
