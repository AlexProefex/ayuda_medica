<?php
namespace App\Resolvers;

use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\UserAdmin;


class UserResolver implements \OwenIt\Auditing\Contracts\UserResolver
{
    /**
     * {@inheritdoc}
     */
    public static function resolve()
    {
    
      $personalAccessToken = \App\Models\PersonalAccessToken::class;
      $hashedTooken = Request()->bearerToken();
      $token = $personalAccessToken::findToken($hashedTooken);
      $userAdmin = $token->tokenable;
      return UserAdmin::find($userAdmin->idUser);

    }
}
