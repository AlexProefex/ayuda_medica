<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenGoogle extends Model
{
    use HasFactory;

    protected $fillable = [
        'tokenId',
        'idUser', 
        'token', 

    ];   
    protected $primaryKey ='tokenId'; 

}
