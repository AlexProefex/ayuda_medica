<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
use App\Traits\SetDatabase;
class Patients extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;

    // UsesTenantConnection;
   // use \OwenIt\Auditing\Auditable;
    //use SetDatabase;
   // protected $auditThreshold = 50;

    protected $fillable = [
        'idPatient', 
        'name', 
        'last_name',
        'document_type',
        'document_number',
        'phone_number',
        'email',
        'avatar',
        'gender',
        'birthdate',
        'diseases',
        'password'
    ];   

    protected $hidden = [
        'password',
    ];

    protected $primaryKey ='idPatient'; 

    public function budget()
    {
        return $this->hasMany(Budget::class,'idPatient');
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class,'idPatient');
    }

    public function clinicHistory()
    {
        return $this->hasMany(ClinicHistory::class,'idPatient');
    }

    public function odontogram()
    {
        return $this->hasMany(Odontogram::class,'idPatient');
    }
}

