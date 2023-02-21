<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ProductConsultory;
use Illuminate\Support\Facades\DB;
class ProductObject extends JsonResource
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
            'id' => $this->whenNotNull($this->idProduct),
            'attributes'=>[   
                'idProduct' => $this->whenNotNull($this->idProduct),
                'name' => $this->whenNotNull($this->name),     
                'brand' => $this->whenNotNull($this->brand),
                'unit' => $this->whenNotNull($this->unit),
                'consultories' => 
                $this->whenNotNull(
                ProductConsultory::where('product_consultories.idProduct',$this->idProduct)
                ->select('consultories.idConsultory','consultories.name','product_consultories.amount')
                ->join('consultories','consultories.idConsultory','=','product_consultories.idConsultory')
                ->get()),
          ]
        ];
    }
}
