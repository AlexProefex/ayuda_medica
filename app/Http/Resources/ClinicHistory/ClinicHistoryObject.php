<?php

namespace App\Http\Resources\ClinicHistory;

use Illuminate\Http\Resources\Json\JsonResource;

class ClinicHistoryObject extends JsonResource
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
            'id' => $this->whenNotNull($this->idClinicHistory),
            'attributes'=>[   
                'idClinicHistory' => $this->whenNotNull($this->idClinicHistory),
                'idDoctor' => $this->whenNotNull($this->idDoctor),
                //'idConsultory' => $this->whenNotNull($this->idConsultory),
                'observations' => $this->whenNotNull($this->observations)
          ]
        ];
    }
}
 