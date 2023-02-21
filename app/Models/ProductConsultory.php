<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class ProductConsultory extends Model
{
    use HasFactory;
    //, UsesTenantConnection;
    //use \OwenIt\Auditing\Auditable;
    //protected $auditThreshold = 50;
    
    protected $fillable = [
        'idProducConsultory',
        'idProduct', 
        'idConsultory', 
        'amount',
    ];   
    protected $primaryKey ='idProducConsultory'; 

}

