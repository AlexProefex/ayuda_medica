<?php

namespace App\Http\Resources\Sales;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesDetailObject extends JsonResource
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
            'id' => $this->whenNotNull($this->idSalesDetail),
            'attributes'=>[   
                'idSalesDetail' => $this->whenNotNull($this->idSalesDetail),
                'idSale' => $this->whenNotNull($this->idSale),     
                'idTreatment' => $this->whenNotNull($this->idTreatment),
                'amount' => $this->whenNotNull($this->amount),
                'price' => $this->whenNotNull($this->price),
                'total' => $this->whenNotNull($this->total)
          ]
        ];
    }
}
