<?php

namespace App\Http\Resources\Appointment;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Category;

class AppointmentResource extends JsonResource
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
                'idAppointments'=> $this->whenNotNull($this->idAppointments),
                'idDoctor'=> $this->whenNotNull($this->idDoctor),
                //'idConsultory' => $this->whenNotNull($this->idConsultory),      
                'idPatient' => $this->whenNotNull($this->idPatient),
                'idSpecialty' => $this->whenNotNull($this->idSpecialty),
                'date' => $this->whenNotNull($this->date),
                'time' => $this->whenNotNull($this->time),
                //'reason_appointment' => $this->whenNotNull($this->reason_appointment),
                //'name' => $this->whenNotNull($this->name),
                'location' => $this->whenNotNull($this->location),
                'status' => $this->whenNotNull($this->status),
                'category' =>  $this->whenNotNull(Category::find($this->idCategory,['idCategory','name'])),


            ];
    }
}



