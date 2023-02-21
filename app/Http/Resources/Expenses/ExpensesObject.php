<?php

namespace App\Http\Resources\Expenses;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpensesObject extends JsonResource
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
        'id' => $this->whenNotNull($this->idExpenses),
        'attributes'=>[   
            'idExpenses' => $this->whenNotNull($this->idExpenses),
            'idUser' => $this->whenNotNull($this->idUser),
            'document' => $this->whenNotNull($this->document),
            'reason' => $this->whenNotNull($this->reason),
            'observations' => $this->whenNotNull($this->observations),
            'amount' => $this->whenNotNull($this->amount),
            'details' => $this->whenNotNull($this->details),
        ]
      ];

    }
}
