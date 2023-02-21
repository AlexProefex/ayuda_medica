<?php

namespace App\Http\Resources\Patients;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientsConvention extends JsonResource
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
      //'idPatient'=> $this->whenNotNull($this->idPatient),
      'idConvention'=> $this->whenNotNull($this->idConvention),
      'name'=> $this->whenNotNull($this->name)
      ];
  
    }
}
