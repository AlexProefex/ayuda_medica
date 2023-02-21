<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class Laboratory extends Model
{
    use HasFactory;
    protected $fillable = [
        'idLaboratory', 
        'business', 
        'name',
        'orders',
        'pendientes',
        'email',
        'laboratory_items',

    ];   
    protected $primaryKey ='idLaboratory'; 
}


