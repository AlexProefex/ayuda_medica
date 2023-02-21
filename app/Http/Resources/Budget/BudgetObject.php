<?php

namespace App\Http\Resources\Budget;

use Illuminate\Http\Resources\Json\JsonResource;

class BudgetObject extends JsonResource
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
            'id' => $this->whenNotNull($this->idBudget),
            'attributes'=>[   
                'idBudget' => $this->whenNotNull($this->idBudget),
                'idDoctor' => $this->whenNotNull($this->idDoctor),     
                'idPatient' => $this->whenNotNull($this->idPatient),
                'idConvention' => $this->whenNotNull($this->idConvention),
                'idConsultory' => $this->whenNotNull($this->idConsultory),
                'discount' => $this->whenNotNull($this->discount),
                'total' => $this->whenNotNull($this->total),
                'observation'=>  $this->whenNotNull($this->observation), 
          ]
        ];
    }
}
    