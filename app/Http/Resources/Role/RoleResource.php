<?php

namespace App\Http\Resources\Role;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'idRol'=> $this->whenNotNull($this->idRol),
            'name' =>  $this->whenNotNull($this->name),      
            'state' =>  $this->whenNotNull($this->state),
        ];
    }
}
