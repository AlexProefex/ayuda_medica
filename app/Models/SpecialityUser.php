<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class SpecialityUser extends Model
{
    use HasFactory;
    //,,UsesTenantConnection;

    protected $fillable = [
        'idSpecialityUser',
        'idSpecialty', 
        'idUser', 
        'status',
    ];   

    protected $primaryKey ='idSpecialityUser'; 

    public function userAdmin()
    {
        return $this->belongsTo(UserAdmin::class,'idUser');
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class,'idUser');
    }

}
