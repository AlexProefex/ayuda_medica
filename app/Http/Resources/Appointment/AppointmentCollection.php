<?php

namespace App\Http\Resources\Appointment;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Patients\PatientsResource;

class AppointmentCollection extends ResourceCollection
{

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function __construct($collection,$patients)
    {
          parent::__construct($collection);
          $this->patients = $patients;
    }

    public function toArray($request)
    {
         return [
                   'Appointment'=>AppointmentResource::collection($this->collection)[0],
                   'Patient'=>PatientsResource::collection($this->patients)[0],
              
          ];
    }
}
