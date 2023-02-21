<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
use App\Traits\SetDatabase;
class Appointment extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    //,,UsesTenantConnection;
    //use SetDatabase;

    protected $auditThreshold = 50;

    protected $fillable = [
        'idAppointments',
        'idCategory',
        'location',
        'idDoctor', 
        'idPatient',
        'idSpecialty',
        'date',
        'time',
        'observation',
        'status'
    ];   
    protected $primaryKey ='idAppointments'; 


}


