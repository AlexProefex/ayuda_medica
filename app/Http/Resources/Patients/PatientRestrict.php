<?php

namespace App\Http\Resources\Patients;

use App\Models\Patients;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class PatientRestrict extends JsonResource
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
            'id' => $this->whenNotNull($this->idPatient),
            'attributes'=>[   
                'idPatient'=> $this->whenNotNull($this->idPatient),
                'name' =>  $this->whenNotNull($this->name),      
                'last_name' =>  $this->whenNotNull($this->last_name),
                'document_type' => $this->whenNotNull($this->document_type),
                'document_number' => $this->whenNotNull($this->document_number),
            ]
        ];
               
    }
}



