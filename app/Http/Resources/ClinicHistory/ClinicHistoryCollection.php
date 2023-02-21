<?php

namespace App\Http\Resources\ClinicHistory;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Patients\PatientsResource;

class ClinicHistoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function __construct($collection,$patient,$clinicHistory)
    {
        parent::__construct($collection);
        $this->patient = $patient;
        $this->clinicHistory = $clinicHistory;
    }

    public function toArray($request)
    {
        return [
         
              'patient' => new PatientsResource($this->patient),
              'clinicHistory' => $this->clinicHistory
         
          ];
    }
}
