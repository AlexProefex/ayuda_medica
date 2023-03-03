<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\UserAdminsController;
//use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\OdontogramController;
use App\Http\Controllers\ConsultoryController;
use App\Http\Controllers\ConventionController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\ClinicHistoryController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\CategoryController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
use App\Http\Controllers\MeetController;


Route::post('/token',[MeetController::class,'showview']);




Route::post('/', function () {
    return view('index');

});


Route::post('/cal',[MeetController::class,'index']);




//Route::middleware('tenant')->group(function() {

  Route::post('login', [UserAdminsController::class, 'login'])->name('login');
 // Route::post('loginPatient', [PatientsController::class, 'login'])->name('login');
  Route::post('voluntary', [UserAdminsController::class, 'registroVoluntario']);
  

  Route::get('logout/{hashedTooken}', [UserAdminsController::class,'logout']);
  Route::get('patients-document/{dni}', [PatientsController::class,'getPatientByDni']);
  Route::post('appointment', [AppointmentController::class,'store']);
  Route::get('specialty', [SpecialtyController::class,'index']);
  Route::get('category', [CategoryController::class,'index']);
  Route::get('list-doctors', [UserAdminsController::class,'getDoctorForAppointments']);


  


  Route::middleware('auth:sanctum')->group( function () {
  
        
    Route::controller(AppointmentController::class)->group(function() {
      Route::get('appointment', 'index');
      Route::get('appointment/{id}', 'show');
      Route::put('appointment/{id}', 'update');
      Route::get('hello/{id}', 'show');
      Route::get('appointment-doctor/{id}', 'appointmentByDoctor');
      Route::put('appointment-status/{id}', 'appointmentStatus');
      
    });
    



    Route::controller(UserAdminsController::class)->group(function() {
      Route::get('user', 'index');
      Route::get('user/{id}', 'show');
      Route::get('find-user/{dni}','findUserDni');
      Route::get('token/{hashedTooken}', 'getUserbyToken');
      Route::get('doctor','getDoctor');
      Route::get('get-image-user/{name}','getImageUsers');
      Route::get('get-user','getUserAll');
      Route::put('user/{id}', 'update');
      Route::put('validate-consultory/{id}', 'ruleToscheduleDoctor');
      Route::post('user', 'store');
      Route::post('schedule/{id}','updateSchedule');
      
    });
    


    Route::controller(PatientsController::class)->group(function() {
      Route::get('patients', 'index');
      Route::get('patients/{id}', 'show');
      Route::get('get-image-patients/{name}','getImagePatients');
      Route::get('find-patient/{dni}','findPatient');
      Route::get('searchPatient/{text?}','findPatientPaginate');
      Route::put('patients/{id}', 'update');
      Route::post('patients', 'store');
    });
  
  

    /*
    Route::controller(SalesController::class)->group(function() {
      Route::get('sales', 'index');
      Route::get('sales/{id}', 'show');
      Route::get('sales-details/{id}', 'salesDetails');
      Route::put('sales/{id}', 'update');
      Route::post('sales', 'store');
      Route::post('pay-fee','payFee'); 
    });
    */
    /*Route::controller(OdontogramController::class)->group(function() {
      Route::get('odontogram/{id}', 'show');
      Route::get('find-odontogram/{id}/{date}','getByDate');
      Route::post('odontogram', 'store');
    });*/

    Route::controller(CategoryController::class)->group(function() {
      Route::post('category', 'store');
      Route::put('category/{id}', 'update');
      Route::get('category/{id}', 'show');
    });
  
  
    /*Route::controller(TreatmentController::class)->group(function() {
      Route::get('treatments', 'index');
      Route::get('treatments/{id}', 'show');
      Route::get('missingTreatment/{idConsultory}','missingTreatment');
      Route::post('treatments', 'store');
      Route::post('update-prices', 'updatePrices');
    });*/

    /*Route::controller(ConventionController::class)->group(function() {
      Route::get('convention', 'index');
      Route::get('convention/{id}', 'show');
      Route::get('convention-active','getActiveConvention');
      Route::post('convention', 'store');
      Route::post('discount-treatments', 'discountTreatmentConvention');
      Route::put('convention/{id}', 'update');
      
    });*/


    Route::controller(SpecialtyController::class)->group(function() {

      Route::get('specialty/{id}', 'show');
      /*Route::get('convention/{id}', 'show');
      Route::get('convention-active','getActiveConvention');*/
      Route::post('specialty', 'store');/*
      Route::post('discount-treatments', 'discountTreatmentConvention');
      */Route::put('specialty/{id}', 'update');
      
    });
  
  
    //Route::apiResource('consultorys',ConsultoryController::class,['except' => ['destroy']]);
    //Route::apiResource('convention',ConventionController::class,['except' => ['destroy']]);
    Route::apiResource('clinic-history',ClinicHistoryController::class,['except' => ['destroy','index','update']]);
    //Route::apiResource('expenses', ExpensesController::class,['except' => ['destroy']]);
    //Route::apiResource('budget',BudgetController::class,['except' => ['destroy','update']]);
    //Route::apiResource('inventory',InventoryController::class,['except' => ['destroy']]);
    //Route::apiResource('order', OrderController::class,['except' => ['destroy']]);
    //Route::apiResource('laboratory',LaboratoryController::class,['except' => ['destroy']]);
    //Route::apiResource('pedido',PedidosController::class);

    Route::controller(RoleController::class)->group(function() {
      Route::get('role', 'index');
      Route::get('role/{id}', 'show');
      Route::post('role', 'store');
      Route::put('role/{id}', 'update');
    });
    //Route::get('specialty', [SpecialtyController::class,'index']); 
    //Route::get('budget-details/{id}', [BudgetController::class,'budgetDetails']); 
    //Route::get('consultorys-active', [ConsultoryController::class,'getActiveConsultory']); 
  
    //Route::post('inventory/add-consultory', [InventoryController::class,'addConsultoryProduct']); 
  

  //});
    

  //Ruta de prueba
  //Route::post('insertTreatment',[TreatmentController::class,'insertTreatment']);
  //Route::post('uploadImage',[UserAdminsController::class,'uploadImage']);
  //Route::get('hola',[UserAdminsController::class,'hola']);
  
  /*
  Route::get('{slug}', function() {
      return view('errors.404');
  })->where('slug', '([A-Za-z0-9\-\/]+)');
  */

});



Route::fallback(function () {
    return view('errors.404');
});


