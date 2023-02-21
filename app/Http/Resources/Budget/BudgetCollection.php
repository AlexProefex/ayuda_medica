<?php

namespace App\Http\Resources\Budget;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BudgetCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function __construct($collection,$budget,$budgetDetail)
    {
        parent::__construct($collection);
           $this->budget = $budget;
        $this->budgetDetail = $budgetDetail;
    }


    public function toArray($request)
    {
          return [
         
              'budget' => $this->budget,
              'details' => $this->budgetDetail
         
          ];
    }
}
