<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
use App\Traits\SetDatabase;
class Convention extends Model implements Auditable
{
    use HasFactory;
    //, UsesTenantConnection;
    use \OwenIt\Auditing\Auditable;
    //use SetDatabase;
    protected $auditThreshold = 50;

    protected $fillable = [
        'idConvention', 
        'name', 
        'company_name',
        'discount',
        'status'
    ];   
    protected $primaryKey ='idConvention'; 
}
