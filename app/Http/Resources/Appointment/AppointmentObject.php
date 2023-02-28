<?php

namespace App\Http\Resources\Appointment;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentObject extends JsonResource
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
            'id' => $this->whenNotNull($this->idAppointments),
            'attributes'=>[   
                'idAppointments'=> $this->whenNotNull($this->idAppointments),
                'idDoctor'=> $this->whenNotNull($this->idDoctor),
                //'idConsultory' => $this->whenNotNull($this->idConsultory),      
                'idPatient' => $this->whenNotNull($this->idPatient),
                'date' => $this->whenNotNull($this->date),
                'time' => $this->whenNotNull($this->time),
                'idSpecialty' => $this->whenNotNull($this->idSpecialty),
                //'reason_appointment' => $this->whenNotNull($this->reason_appointment),
                'status' => $this->whenNotNull($this->status),
                'observation' => $this->whenNotNull($this->observation),
             
           
              ]
        ];
    }
}


