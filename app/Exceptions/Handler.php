<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use App\Http\Controllers\API\BaseController as BaseController;
use Spatie\Multitenancy\Exceptions\NoCurrentTenant;
use Exception;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {

        $this->renderable(function (AuthenticationException $e) {
            $unauthenticated =  BaseController::handleNoAuthorizedMidle('Unauthorised',['error'=>'Unauthorised','user'=>'invalid token']);
            return $unauthenticated;
        });

        $this->renderable(function (NoCurrentTenant $e) {
            $unauthenticated =  BaseController::handleNoAuthorizedMidle('Unauthorised',['error'=>'Unauthorised','user'=>'Invalid client']);
            return $unauthenticated;
        });

        $this->reportable(function (Throwable $e) {
            //
        });



    }
/*
    protected function unauthenticated($request, AuthenticationException $exception){
       //dd($exception);
        if ($exception instanceof \Illuminate\Session\ModelNotFoundException) {            
            return  BaseController::handleNoAuthorizedMidle('Unauthorised',['error'=>'Unauthorised','user'=>'token expired']);
        }
        $unauthenticated =  BaseController::handleNoAuthorizedMidle('Unauthorised',['error'=>'Unauthorised','user'=>'credenciales incorrectas']);
        return $unauthenticated;
    }
*/
}
