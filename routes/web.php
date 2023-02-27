<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MeetController;
use App\Http\Controllers\UserAdminsController;
use SEO;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|ggfgd
*/



Route::get('/test', function () {
    return view('test.test');
});

Route::get('/privacy-policy', function () {
    SEO::setTitle('Politicas de privacidad');
    SEO::setDescription('Politicas de privacidad de Proefex');
    SEO::opengraph()->setUrl('https://proyectosproefex.com');
    SEO::setCanonical('https://proyectosproefex.com');
    SEO::opengraph()->addProperty('type', 'articles');
    SEO::twitter()->setSite('@proyectosproefex');
    return view('privacy-policy');
});


Route::get('/term-conditions', function () {
    SEO::setTitle('Terminos y condiciones');
    SEO::setDescription('Terminos y condiciones de Proefex');
    SEO::opengraph()->setUrl('https://proyectosproefex.com');
    SEO::setCanonical('https://proyectosproefex.com');
    SEO::opengraph()->addProperty('type', 'articles');
    SEO::twitter()->setSite('@proyectosproefex');
    return view('term-conditions');
});


Route::get('/medical-consent', function () {
    SEO::setTitle('Consentimiento Medico');
    SEO::setDescription('Terminos y condiciones de Proefex - ayuda medica');
    SEO::opengraph()->setUrl('https://proyectosproefex.com');
    SEO::setCanonical('https://proyectosproefex.com');
    SEO::opengraph()->addProperty('type', 'articles');
    SEO::twitter()->setSite('@proyectosproefex');
    return view('medical-consent');
});



Route::post('/token',[MeetController::class,'showview']);
Route::get('/token',[MeetController::class,'showview']);

Route::get('/', function () {

    SEO::setTitle('Proyectos Proefex');
    SEO::setDescription('website listing proefex projects where you will find the details of each of them, both new and old');
    SEO::opengraph()->setUrl('https://proyectosproefex.com');
    SEO::setCanonical('https://proyectosproefex.com');
    SEO::opengraph()->addProperty('type', 'articles');
    SEO::twitter()->setSite('@proyectosproefex');
    return view('index');

});

Route::get('/form', function () {
    return view('test.form-appointment');

});


Route::get('/cal',[MeetController::class,'index']);


/*

Route::get('/', function () {
    return view('index');

});
/*
Route::get('/ff', function () {
    return view('carruselMain');

});
*/

Route::get('{slug}', function() {
    return view('errors.404');
})->where('slug', '([A-Za-z0-9\-\/]+)');


 
Route::controller(UserAdminsController::class)->group(function() {
    Route::get('user', 'index');
    /*Route::get('user/{id}', 'show');
    Route::get('find-user/{text?}','findUser');
    Route::get('token/{hashedTooken}', 'getUserbyToken');
    Route::get('doctor','getDoctor');
    Route::get('get-image-user/{name}','getImageUsers');
    Route::get('get-user','getUserAll');
    Route::put('user/{id}', 'update');
    Route::put('validate-consultory/{id}', 'ruleToscheduleDoctor');*/
    Route::post('user', 'store');

    
});
//

/*
Route::post('login', [UserAdminsController::class, 'login'])->name('login');
*//*Route::get('vista',[SalesController::class,'view']);
Route::resource('user',UserAdminsController::class,['except' => [ 'create','destroy','edit']]);
*/


//Route::get('send-mail', [ContactController::class, 'sendDemoMail']);
