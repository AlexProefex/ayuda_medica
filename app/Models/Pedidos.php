<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class Pedidos extends Model
{
    use HasFactory;
    //, UsesTenantConnection;

    protected $fillable = [
        'idPedido', 
        'idUsuario', 
        'dateDelivery'
    ];   

    protected $primaryKey ='idPedido'; 

    public function pedidosdetail()
    {
        return $this->hasMany(PedidosDetail::class,'idPedido');
    }
}