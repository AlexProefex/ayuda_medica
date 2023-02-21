<?php

namespace App\Http\Resources\Specialty;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Category;

class SpecialtyObject extends JsonResource
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
            'id' => $this->whenNotNull($this->idSpecialty),
            'attributes'=>[   
                'idSpecialty'=> $this->whenNotNull($this->idSpecialty),
                'name' =>  $this->whenNotNull($this->name),
                'category' =>  $this->whenNotNull(Category::find($this->idCategory,['idCategory','name'])),
                'duration' =>  $this->whenNotNull($this->duration),
                'description' =>  $this->whenNotNull($this->description),      
                'status' =>  $this->whenNotNull($this->status),
          ]
        ];
    }
}

