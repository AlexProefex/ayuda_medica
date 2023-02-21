<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class Treatment extends Model
{
    use HasFactory;
    //,, UsesTenantConnection;
    protected $fillable = [
      'idTreatment', 
      'name', 
      'price',
      'hasMaterial',
      'isInOdontogram'
    ];   
    protected $primaryKey ='idTreatment'; 

    public function material()
    {
        return $this->hasMany(Material::class,'idTreatment');
    }

    public function consultories()
    {
        return $this->hasMany(ConsultoryTreatments::class,'idTreatment');
    }
}
   