<?php

namespace App\Http\Resources\Payment;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentObject extends JsonResource
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
            'id' => $this->whenNotNull($this->idPayment),
            'attributes'=>[   
                'idPayment'=> $this->whenNotNull($this->idPayment),
                'idBudget' =>  $this->whenNotNull($this->idBudget),      
                'currentBalance' =>  $this->whenNotNull($this->currentBalance),
                'amount' => $this->whenNotNull($this->amount),
                'remainingBalance' => $this->whenNotNull($this->remainingBalance)
            ]
        ];
             
    }
}
