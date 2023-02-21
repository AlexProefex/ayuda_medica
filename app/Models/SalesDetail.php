<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class SalesDetail extends Model
{
    use HasFactory;
    //,, UsesTenantConnection;

    protected $fillable = [
        'idSaleDetail', 
        'idSale', 
        'idTreatment',
        'idMaterial',
        'amount',
        'price',
        'subTotal',
        'discount',
        'total',
    ];   
    protected $primaryKey ='idSaleDetail'; 

    public function sales()
    {
        return $this->belongsTo(Sales::class,'idSale');
    }
}
