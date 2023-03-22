<?php

namespace App\Http\Resources\UserAdmins;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Models\UserAdmin;
use Illuminate\Support\Str;
class UserAdminLogin extends JsonResource
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
            'idUser'=> $this->whenNotNull($this->idUser),
            'name' =>  $this->whenNotNull($this->name),      
            'last_name' =>  $this->whenNotNull($this->last_name),
            'document_number' => $this->whenNotNull($this->document_number),
            'phone_number' => $this->whenNotNull($this->phone_number),
            'email' => $this->whenNotNull($this->email),
            'idRol' => $this->whenNotNull($this->idRol),
            'avatar' => $this->whenNotNull($this->avatar),
            'date' => $this->whenNotNull($this->date),
            'schedule' => $this->whenNotNull($this->schedule),
            'location' => $this->whenNotNull($this->location),
            'timezone' => $this->whenNotNull($this->timezone),
            'observations' => $this->whenNotNull($this->observations),
            'state' => $this->whenNotNull($this->state),
            'nColegiatura' => $this->whenNotNull($this->nColegiatura),
            'idCategory' => $this->whenNotNull($this->idCategory),
            'document_type'=> $this->whenNotNull($this->document_type),
            //'url' => $this->whenNotNull(Storage::disk('avatar')->url($this->avatar))
            'url' => $this->whenNotNull(Storage::disk('avatar')->url(Str::lower(class_basename(new UserAdmin)).'/'.$this->avatar))
        ];
    }
}


