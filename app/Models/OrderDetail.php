<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class OrderDetail extends Model
{
    use HasFactory;
    //, UsesTenantConnection;
    
    protected $fillable = [
        'idOrderDetail', 
        'idOrder', 
        'name',
        'requiredAmount',
        'deliveryAmount',
        'missingAmount',
    ];   

    protected $primaryKey ='idPedido'; 

    public function orders()
    {
        return $this->belongsTo(Order::class,'idOrder');
    }


}
