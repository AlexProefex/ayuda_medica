<?php

namespace App\Http\Resources\Patients;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PatientsPaginate extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return ['data' => $this->collection];
        dd($this);
        return [
            "data"=> [
                'idPatient'=> $this->whenNotNull($this->idPatient),
                'name' =>  $this->whenNotNull($this->name),    
                'last_name' =>  $this->whenNotNull($this->last_name),
                'document_type' => $this->whenNotNull($this->document_type),
                'document_number' => $this->whenNotNull($this->document_number),
                'phone_number' => $this->whenNotNull($this->phone_number),
                'email' => $this->whenNotNull($this->email),
                'avatar' => $this->whenNotNull($this->avatar),
                'birthdate'=> $this->whenNotNull($this->birthdate),
                'diseases' => $this->whenNotNull($this->diseases),
             
            
            ],
      ];
    }
}

