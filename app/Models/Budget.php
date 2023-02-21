<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
use App\Traits\SetDatabase;
class Budget extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    //UsesTenantConnection;
    //use SetDatabase;
    protected $auditThreshold = 50;

    protected $fillable = [
      'idBudget',
      'idDoctor', 
      'idPatient', 
      'idConvention',
      'idConsultory',
      //'subTotal',
      'total',
      //'status',
      'observation',
      'elements'
    ];   
    protected $primaryKey ='idBudget'; 
/*
    public function budgetPayment()
    {
        return $this->hasMany(Payment::class,'idBudget');
    }
*/
    public function budgetDetail()
    {
        return $this->hasMany(BudgetDetail::class,'idBudget');
    }


}


