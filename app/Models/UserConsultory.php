<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class UserConsultory extends Model
{
    use HasFactory;
    //,,UsesTenantConnection;

    protected $fillable = [
    'idUserConsultory', 
    'idUser', 
    'idConsultory',
    'status',
    ];   
    protected $primaryKey ='idUserConsultory'; 

    public function user()
    {
        return $this->belongsTo(UserAdmin::class,'idUser');
    }


}
