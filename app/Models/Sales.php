<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class Sales extends Model
{
    use HasFactory;
    //,, UsesTenantConnection;

    protected $fillable = [
        'idSale',
        'idDoctor', 
        'idPatient', 
        'idConvention',
        'idConsultory',
        //'subTotal',
        'total',
        'status',
        'remainingBalance',
        'elements'
      ];   
      protected $primaryKey ='idSale'; 
  
      public function salesPayment()
      {
          return $this->hasMany(Payment::class,'idSale');
      }
  
      public function salesDetail()
      {
          return $this->hasMany(SalesDetail::class,'idSale');
      }
}
