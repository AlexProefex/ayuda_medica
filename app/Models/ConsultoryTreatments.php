<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class ConsultoryTreatments extends Model
{     
    use HasFactory;
    //, UsesTenantConnection;
    protected $fillable = [
        'idConsultoryTreatments', 
        'idTreatment',
        'idConsultory', 
        'price',
        'discount'
    ];   
    protected $primaryKey ='idConsultoryTreatments'; 

}
