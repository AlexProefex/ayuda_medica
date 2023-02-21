<?php

namespace App\Http\Resources\Pedidos;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\UserAdmin;
use App\Models\SpecialityUser;
use App\Models\Specialty;


//use App\Models\S;
class Pedidos extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $this->speciality = Specialty::where('speciality_users.idUser',$this->idUser)
        ->join('speciality_users','speciality_users.idSpecialty','=','specialties.idSpecialty')
        ->select('specialties.idSpecialty','specialties.name')
        ->get();

        if($this->speciality=='[]')
         $this->speciality=NULL;

        return [
            'idUser' =>  $this->whenNotNull($this->idUser),
            'name' =>  $this->whenNotNull($this->name),
            'schedule' =>  $this->whenNotNull($this->schedule),
            'specialties' =>   $this->whenNotNull($this->speciality)
 
           //'specialties' => UserAdmin::where('idUser',$this->idUser)->first()->specialityUser
        ];


    }
}
