<?php

namespace App\Http\Resources\Treatment;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TreatmentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function __construct($collection,$Material)
    {
        parent::__construct($collection);
        $this->Material = $Material;
    }


    public function toArray($request)
    {
          return [
          
            'treatment' => $this->collection,
            'material' => $this->Material
            
          ];
    }
}
