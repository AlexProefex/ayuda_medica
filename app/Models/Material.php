<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class Material extends Model
{
    use HasFactory;
    //, UsesTenantConnection;
    protected $fillable = [
      'idMaterial', 
      'idTreatment',
      'name', 
      'price',
    ];   
    protected $primaryKey ='idMaterial'; 

    public function treatment()
    {
        return $this->belongsTo(Treatment::class,'idTreatment');
    }

    public function consultories()
    {
        return $this->hasMany(ConsultoryMaterial::class,'idMaterial');
    }


}
