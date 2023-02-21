<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderObject extends JsonResource
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
            'id' => $this->whenNotNull($this->idOrder),
            'attributes'=>[   
                'idOrder' => $this->whenNotNull($this->idOrder),
                'idLaboratory' => $this->whenNotNull($this->idLaboratory),     
                'idUser' => $this->whenNotNull($this->idUser),
                'idConsultory' => $this->whenNotNull($this->idConsultory),
                'dateDelivery' => $this->whenNotNull($this->dateDelivery),
                'amountDelivery' => $this->whenNotNull($this->amountDelivery),
                'idProduct' => $this->whenNotNull($this->idProduct),
        
          ]
        ];
        
        return parent::toArray($request);
    }
}
