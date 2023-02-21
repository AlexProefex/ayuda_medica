<?php

namespace App\Http\Resources\Sales;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesResource extends JsonResource
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
        'idSale' => $this->whenNotNull($this->idSale),
        'idDoctor' => $this->whenNotNull($this->idDoctor),     
        'idPatient' => $this->whenNotNull($this->idPatient),
        'idConvention' => $this->whenNotNull($this->idConvention),
        'idConsultory' => $this->whenNotNull($this->idConsultory),
        'total' => $this->whenNotNull($this->total),
        'status' => $this->whenNotNull($this->status)
      ];
    }
}
