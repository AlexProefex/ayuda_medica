<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Audit extends Model implements \OwenIt\Auditing\Contracts\Audit
{
    use \OwenIt\Auditing\Audit;
    
    //,use UsesTenantConnection;

    /**
     * {@inheritdoc}
     */
    protected $guarded = [];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'old_values'   => 'json',
        'new_values'   => 'json',
        // Note: Please do not add 'auditable_id' in here, as it will break non-integer PK models
    ];

    public function getSerializedDate($date)
    {
        return $this->serializeDate($date);
    }
}
