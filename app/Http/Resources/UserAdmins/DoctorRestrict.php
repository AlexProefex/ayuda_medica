<?php

namespace App\Http\Resources\UserAdmins;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\UserAdmin;


class DoctorRestrict extends JsonResource
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
            'idUser' => $this->whenNotNull($this['idUser']),
            'name' => $this->whenNotNull($this['name']),
            'last_name' => $this->whenNotNull($this['last_name']),
            'schedule' => $this->whenNotNull($this['schedule']),
            'state' => $this->whenNotNull($this['state']),
            'timezone' => $this->whenNotNull($this['timezone']),
            'specialty' => $this->whenNotNull($this['specialty']),
            'idCategory' => $this->whenNotNull($this['idCategory']),
            'nColegiatura' => $this->whenNotNull($this['nColegiatura']),
            'observations' => $this->whenNotNull($this['observations']),
            'avatar' => $this->whenNotNull(Storage::disk('avatar')->url(Str::lower(class_basename(new UserAdmin)).'/'.$this['observations'])),
     
          ];


    }
}

