<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class PedidosDetail extends Model
{
    use HasFactory;
    //, UsesTenantConnection;

    protected $fillable = [
        'idPedidoDetails', 
        'idPedido', 
        'idProduct',
        'amountDelivery',
        'amountRemaining'
    ];   

    protected $primaryKey ='idPedidoDetails'; 

    public function pedidos()
    {
        return $this->belongsTo(Pedidos::class,'idPedido');
    }



}
