<?php

namespace App\Http\Resources\Convention;

use Illuminate\Http\Resources\Json\JsonResource;

class ConventionObject extends JsonResource
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
            'id' => $this->whenNotNull($this->idConvention), 
            'attributes'=>[   
                'idConvention'=> $this->whenNotNull($this->idConvention), 
                'name' =>  $this->whenNotNull($this->name),       
                'company_name' => $this->whenNotNull($this->company_name), 
                'discount' => $this->whenNotNull($this->discount), 
                'status' => $this->whenNotNull($this->status)
          ]
        ];
    }
}
     