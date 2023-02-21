<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class Order extends Model
{
    use HasFactory;
    //, UsesTenantConnection;
    protected $fillable = [
      'idOrder', 
      'idLaboratory',
      'idUser', 
      'idConsultory',
      'dateDelivery',
      'status',
      'amountReceived',
      'amountRequired',
      'idProduct'

    ];   
   

    protected $primaryKey ='idOrder'; 

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class,'idOrder');
    }

}
