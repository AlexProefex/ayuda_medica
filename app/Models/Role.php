<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Role extends Model
{
    use HasFactory;
    //,UsesTenantConnection;
    protected $fillable = [
        'idRol', 
        'name', 
        'state',
    ];   
    protected $primaryKey ='idRol'; 

    public function userAdmin()
    {
        return $this->hasMany(UserAdmin::class,'idRol');
    }

}
