<?php

namespace App\Http\Resources\UserAdmins;


use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Specialty\SpecialtyResource;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\UserAdmins\UserAdminLogin;

class UserAdminsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function __construct($collection,$user,$speciality,$token)
    {
          parent::__construct($collection);
          $this->user = $user;
          $this->speciality = $speciality;
          $this->token = $token;
    }


    public function toArray($request)
    {
        return [
          'rol'=> RoleResource::collection($this->collection),
          'user'=> UserAdminLogin::collection($this->user),
          'specialties'=> SpecialtyResource::collection($this->speciality),
          'token'=> $this->whenNotNull($this->token)
        ];
    }
}
