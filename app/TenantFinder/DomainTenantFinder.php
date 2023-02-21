<?php

namespace App\TenantFinder;

use Illuminate\Http\Request;
use Spatie\Multitenancy\Models\Concerns\UsesTenantModel;
use Spatie\Multitenancy\Models\Tenant;
use Spatie\Multitenancy\TenantFinder\TenantFinder;

class DomainTenantFinder extends TenantFinder
{
    use UsesTenantModel;

    public function findForRequest(Request $request):?Tenant
    {
        //dd($request->header()['domain'][0]);
        try{
            $host = $request->header()['domain'][0];
            //$host = "domain1";
            //$host = $request->getHost();
            //dd($this->getTenantModel()::whereDomain($host)->first());
            return $this->getTenantModel()::whereDomain($host)->first();
        }catch(\Throwable $e){
            return null;
        }
    }
}