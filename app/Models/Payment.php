<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class Payment extends Model
{
    use HasFactory;
    //, UsesTenantConnection;
    protected $fillable = [
      'idPayment', 
      'idSale', 
      'currentBalance',
      'amount',
      'remainingBalance'
    ]; 
    protected $primaryKey ='idPayment'; 
}
