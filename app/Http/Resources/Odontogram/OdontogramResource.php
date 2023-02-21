<?php

namespace App\Http\Resources\Odontogram;

use Illuminate\Http\Resources\Json\JsonResource;

class OdontogramResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

/*    public $object;

    public function __construct($collection,$object)
   {
      parent::__construct($collection);
      //$this->object = $object;
   }
*/

    public function toArray($request)
    {
       return [
              
                'idOdontogram' => $this->whenNotNull($this->idOdontogram),
                'idPatient' => $this->whenNotNull($this->idPatient),
                'dataOdontogram' => $this->whenNotNull($this->dataOdontogram), 
                'date'=> $this->whenNotNull($this->date),
                'status'=> $this->whenNotNull($this->status),
                
        ];
    }
}
