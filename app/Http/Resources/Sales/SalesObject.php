<?php

namespace App\Http\Resources\Sales;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesObject extends JsonResource
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
          'id' => $this->whenNotNull($this->idSale),
          'attributes'=>[   
              'idSale' => $this->whenNotNull($this->idSale),
              'idDoctor' => $this->whenNotNull($this->idDoctor),     
              'idPatient' => $this->whenNotNull($this->idPatient),
              'idConvention' => $this->whenNotNull($this->idConvention),
              'idConsultory' => $this->whenNotNull($this->idConsultory),
              'discount' => $this->whenNotNull($this->discount),
              'total' => $this->whenNotNull($this->total),
              'status' => $this->whenNotNull($this->status),
              'remainingBalance' => $this->whenNotNull($this->remainingBalance)
          ]
      ];
    }
}
