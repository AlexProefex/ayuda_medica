<?php

namespace App\Http\Resources\UserAdmins;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Consultory\ConsultoryResource;
use App\Http\Resources\Specialty\SpecialtyResource;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\UserAdmins\UserAdminsResource;
use App\Http\Resources\UserAdmins\UserAdminLogin;

class UserSpecialtyResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function __construct($collection,$user,$speciality)
    {
        parent::__construct($collection);
        $this->user = $user;
        $this->speciality = $speciality;

    }
 
    public function toArray($request)
    {
        return [
            'user'=> UserAdminsResource::collection($this->user),
            'specialties'=> SpecialtyResource::collection($this->speciality),
          ];
    }
}
