<?php

namespace App\Http\Resources\Role;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleObject extends JsonResource
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
            'id' => $this->whenNotNull($this->idRol),
            'attributes'=>[   
                'idRol'=> $this->whenNotNull($this->idRol),
                'name' =>  $this->whenNotNull($this->name),      
                'state' =>  $this->whenNotNull($this->state),
            ]
        ];
        
    }
}
