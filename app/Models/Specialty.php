<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class Specialty extends Model
{
    use HasFactory;
    //,,UsesTenantConnection;

    protected $fillable = [
        'idSpecialty', 
        'name', 
        'idCategory',
        'duration',
        'description',
        'status'
    ];   
    protected $primaryKey ='idSpecialty'; 


    public function userSpecialty()
    {
        return $this->hasMany(SpecialityUser::class,'idSpecialty');
    }




}



