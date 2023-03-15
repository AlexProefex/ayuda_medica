<?php

namespace App\Http\Resources\Specialty;

use Illuminate\Http\Resources\Json\JsonResource;


class SpecialtyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'idSpecialty'=> $this->whenNotNull($this->idSpecialty),
            'name' =>  $this->whenNotNull($this->name),
            'idCategory' =>  $this->whenNotNull($this->idCategory),
            'duration' =>  $this->whenNotNull($this->duration),
            'description' =>  $this->whenNotNull($this->description),      
            'status' =>  $this->whenNotNull($this->status),
        ];
    }
}


