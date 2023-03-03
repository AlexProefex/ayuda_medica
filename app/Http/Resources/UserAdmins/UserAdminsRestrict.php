<?php

namespace App\Http\Resources\UserAdmins;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAdminsRestrict extends JsonResource
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
            'id' => $this->whenNotNull($this->idUser),
            'attributes'=>[   
                'idUser'=> $this->whenNotNull($this->idUser),
                'name' =>  $this->whenNotNull($this->name),      
                'last_name' =>  $this->whenNotNull($this->last_name),
                'document_number' => $this->whenNotNull($this->document_number),
                'phone_number' => $this->whenNotNull($this->phone_number),
                'email' => $this->whenNotNull($this->email),
              ]
          ];
    }
}
