<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class BudgetDetail extends Model
{
    use HasFactory;
    //, UsesTenantConnection;

    protected $fillable = [
        'idBudgetDetail', 
        'idBudget', 
        'idTreatment',
        'idMaterial',
        'amount',
        'price',
        'subTotal',
        'discount',
        'total',
    ];   
    protected $primaryKey ='idBudgetDetail'; 

    public function budget()
    {
        return $this->belongsTo(Budget::class,'idBudget');
    }


}
          