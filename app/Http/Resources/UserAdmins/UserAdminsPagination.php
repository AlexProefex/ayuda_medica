<?php

namespace App\Http\Resources\UserAdmins;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Consultory\ConsultoryResource;
use App\Http\Resources\Specialty\SpecialtyResource;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\UserAdmins\UserAdminsResource;
use App\Http\Resources\UserAdmins\UserAdminLogin;
use Illuminate\Support\Facades\Storage;


class UserAdminsPagination extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function __construct($collection,$user)
    {
          parent::__construct($collection);
          $this->user = $user;
         // $this->consultory = $consultory;
         // $this->speciality = $speciality;
        //  $this->token = $token;
    }


    public function toArray($request)
    {
        $dataArray = [];

        $i =0;
        foreach($this->collection as $element)
        {
            $data = app()->make('stdClass');
            $data->avatar = $element->avatar;
            $data->url = Storage::disk('avatar')->temporaryUrl($element->avatar, now()->addMinutes(5));
            $dataArray[] = $data;
            $i++;
        }



  

        return $dataArray;

    // dd($this->user[0]->avatar);
        /*return [
          'abc'=> UserAdminsResource::collection($this->collection),
          //'url' => $this->whenNotNull(Storage::disk('google')->url($this->user[0]->avatar))

  
         // 'user'=> UserAdminLogin::collection($this->user),

          
        ];*/
    }
}
