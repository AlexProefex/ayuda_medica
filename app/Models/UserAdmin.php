<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
use App\Traits\SetDatabase;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Spatie\Multitenancy\Concerns\UsesMultitenancyConfig;
use Spatie\Multitenancy\Events\MadeTenantCurrentEvent;

class UserAdmin extends Authenticatable 
//implements Auditable
{

    use HasApiTokens, HasFactory, Notifiable;
    //,,UsesTenantConnection;
    

/*
    use DatabaseTransactions, UsesMultitenancyConfig;

    protected function connectionsToTransact()
    {
        return [
        //    $this->landlordDatabaseConnectionName(),
            $this->tenantDatabaseConnectionName(),
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        Event::listen(MadeTenantCurrentEvent::class, function () {
            $this->beginDatabaseTransaction();
        });
    }
*/

    //use \OwenIt\Auditing\Auditable;
    //use SetDatabase;
    //protected $auditThreshold = 50;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idUser',
        'name',
        'last_name',
        'document_number',
        'phone_number',
        'email',
        'idRol',
        'avatar',
        'state',
        'password',
        'date',
        'schedule',
        'username',
        'specialties',
        'location',
        'timezone',
        'observations',
        'idCategory',
        'nColegiatura',


    ];



    //protected $connectionsToTransact = ['tenant'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    /*protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/

    protected $primaryKey = 'idUser';

    public function userConsultory()
    {
        return $this->hasMany(UserConsultory::class,'idUser');
    }

    public function specialityUser()
    {
        return $this->hasMany(SpecialityUser::class,'idUser');
    }

/*
    public function allRelation()
    {
        return $this->hasManyThrough(
            SpecialityUser::class,
            Specialty::class,
            'idSpecialty', // Foreign key on the environments table...
            'idUser', // Foreign key on the deployments table...
            'idUser', // Local key on the projects table...
            'idSpecialty' // Local key on the environments table...
        );
    }
*/


}




   