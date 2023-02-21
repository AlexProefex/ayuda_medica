<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ProductConsultory;
use Illuminate\Support\Facades\DB;

class ProductResource extends JsonResource
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
   
                'idProduct' => $this->whenNotNull($this->idProduct),
                'name' => $this->whenNotNull($this->name),     
                'brand' => $this->whenNotNull($this->brand),
                'unit' => $this->whenNotNull($this->unit),
                'amount' => 
                $this->whenNotNull(
                    ProductConsultory::where('idProduct',$this->idProduct)
                    ->select(DB::raw("SUM(amount) AS amount"))
                    ->pluck('amount')
                    ->first()),
                'consultories' => 
                $this->whenNotNull(
                ProductConsultory::where('product_consultories.idProduct',$this->idProduct)
                ->select('product_consultories.idConsultory','consultories.name')
                ->join('consultories','consultories.idConsultory','=','product_consultories.idConsultory')
                ->get()),
          
        ];
    }
}
