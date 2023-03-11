<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MeetController;
use App\Http\Controllers\UserAdminsController;
use App\Http\Controllers\SEOController;
//use SEO;



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






Route::get('/',[SEOController::class,'index']);
Route::get('/medical-consent',[SEOController::class,'medical_consent']);
Route::get('/term-conditions',[SEOController::class,'term_conditions']);
Route::get('/privacy-policy',[SEOController::class,'privacy_policy']);



Route::post('/token',[MeetController::class,'showview']);
Route::get('/token',[MeetController::class,'showview']);

Route::get('/showCalendar/{token}',[MeetController::class,'showCalendar']); 



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
