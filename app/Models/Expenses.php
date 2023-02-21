<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class Expenses extends Model
{
    use HasFactory;
    //, UsesTenantConnection;

    protected $fillable = [
      'idExpenses', 
      'idUser', 
      'document',
      'reason',
      'observations',
      'amount',
      'details'
    ];   
    protected $primaryKey ='idExpenses'; 
/*
    protected $casts = [
      'details' => 'json'
    ]
*/
    public function details(): Attribute
    {
      return new Attribute (
        get: function ($details, $attributes){
          return json_decode($details);
        },
        set: function ($details, $attributes){
          return json_encode($details);
      });

    }
}