<?php

namespace App\Http\Resources\UserAdmins;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorRestrict extends JsonResource
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
            'idUser' => $this->whenNotNull($this['idUser']),
            'name' => $this->whenNotNull($this['name']),
            'last_name' => $this->whenNotNull($this['last_name']),
            'schedule' => $this->whenNotNull($this['schedule']),
            'state' => $this->whenNotNull($this['state']),
            'specialties' => $this->whenNotNull($this['specialties'])
     
          ];


    }
}

