<?php

namespace App\Http\Resources\Budget;

use Illuminate\Http\Resources\Json\JsonResource;

class BudgetDetailObject extends JsonResource
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
            'id' => $this->whenNotNull($this->idBudgetDetail),
            'attributes'=>[   
                'idBudgetDetail' => $this->whenNotNull($this->idBudgetDetail),
                'idBudget' => $this->whenNotNull($this->idBudget),     
                'idTreatment' => $this->whenNotNull($this->idTreatment),
                'amount' => $this->whenNotNull($this->amount),
                'price' => $this->whenNotNull($this->price),
                'total' => $this->whenNotNull($this->total)
          ]
        ];
    }
}
    