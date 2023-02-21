<?php

namespace App\Http\Resources\UserAdmins;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserUpdate extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function __construct($collection,$consultory,$speciality)
    {
          parent::__construct($collection);
          $this->consultory = $consultory;
          $this->speciality = $speciality;
    
    }

    
 
    public function toArray($request)
    {
        return [
          'consultories'=> $this->whenNotNull($this->consultory),
          'specialties'=> $this->whenNotNull($this->speciality)
        ];
    }
}
