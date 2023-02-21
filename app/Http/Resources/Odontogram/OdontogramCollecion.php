<?php

namespace App\Http\Resources\Odontogram;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OdontogramCollecion extends ResourceCollection
{

 //   private $id;

   public function __construct($collection,$collection2)
   {
      parent::__construct($collection);
      $this->collection2 = $collection2;
   }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
           return [
                'odontogram'=> OdontogramResource::collection($this->collection)[0],
                'hystory_dates'=>OdontogramResource::collection($this->collection2)
          ];
    }
    
}
