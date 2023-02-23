<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class AppServiceProvider extends ServiceProvider
{
    
    //,use UsesTenantConnection;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    { 
        JsonResource::withoutWrapping();


        Sanctum::usePersonalAccessTokenModel(\App\Models\PersonalAccessToken::class);
        Sanctum::authenticateAccessTokensUsing(
    
            static function (PersonalAccessToken $accessToken, bool $is_valid) {
                if (!$accessToken->can('read:limited')) {
                    return $is_valid;
                }
        
                return $is_valid && $accessToken->created_at->gt(now()->subMinutes(60*12));
            }
        );

    }
}
