<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class OrderDelivery extends Model
{
    use HasFactory;
    //, UsesTenantConnection;

    protected $fillable = [
        'idOrderDelivery', 
        'idOrder',
        'requiredAmount', 

        'deliveryAmount',
        'missingAmount',
        'idUSer',
    ];    
     
  
    protected $primaryKey ='idOrder'; 



}
