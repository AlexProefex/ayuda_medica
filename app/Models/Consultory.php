<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
use App\Traits\SetDatabase;
class Consultory extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    //,UsesTenantConnection;
    //use SetDatabase;
    protected $auditThreshold = 50;

    protected $fillable = [
        'idConsultory', 
        'name', 
        'idManager',
        'start_time',
        'end_time',
        'status'
    ];   
    protected $primaryKey ='idConsultory'; 

}
