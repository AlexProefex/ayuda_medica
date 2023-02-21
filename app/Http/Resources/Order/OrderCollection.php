<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
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
  
    }

    
    public function toArray($request)
    {
          return [
            'id' => $this->whenNotNull($this->idOrder),
                'attributes'=> [ $this->whenNotNull($this->collection[0]),
            ] 
          ];
    }
}
