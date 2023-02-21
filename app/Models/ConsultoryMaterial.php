<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class ConsultoryMaterial extends Model
{
    use HasFactory;
    //, UsesTenantConnection;
    protected $fillable = [
      'idMaterialConsultory', 
      'idTreatment',
      'idMaterial', 
      'price',
      'idConsultory'
    ];   
    protected $primaryKey ='idMaterialConsultory'; 

}
