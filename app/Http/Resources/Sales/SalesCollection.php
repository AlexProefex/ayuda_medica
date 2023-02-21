<?php

namespace App\Http\Resources\Sales;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SalesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function __construct($collection,$sales,$salesDetail)
    {
        parent::__construct($collection);
           $this->sales = $sales;
        $this->salesDetail = $salesDetail;
    }

    public function toArray($request)
    {
        return [
          'sales' => $this->sales,
          'details' => $this->salesDetail
        ];
    }
}

