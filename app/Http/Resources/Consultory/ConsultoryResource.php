<?php

namespace App\Http\Resources\Consultory;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\UserAdmin;
class ConsultoryResource extends JsonResource
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
      
                'idConsultory' => $this->whenNotNull($this->idConsultory),
                'name' => $this->whenNotNull($this->name),     
                'idManager' => $this->whenNotNull($this->idManager),
                'start_time' => $this->whenNotNull($this->start_time),
                'end_time' => $this->whenNotNull($this->end_time),
                'status' => $this->whenNotNull($this->status),
                'manager' => $this->whenNotNull(UserAdmin::select('name','last_name')->where('idUser',$this->idManager)->first())

        ];
    }
}
