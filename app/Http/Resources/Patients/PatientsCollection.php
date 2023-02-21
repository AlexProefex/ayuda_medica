<?php

namespace App\Http\Resources\Patients;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Patients\PatientsResource;
use App\Http\Resources\Patients\PatientsConvention;

class PatientsCollection extends ResourceCollection
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
      'id'=> $this->patients->idPatient,
        'attributes'=>
          new PatientsResource($this->patients),
          'conventions' => PatientsConvention::collection($this->collection)
      ];
    }
}
