<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\UserAdminsController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\ClinicHistoryController;



  Route::post('login', [UserAdminsController::class, 'login'])->name('login');

  Route::controller(UserAdminsController::class)->group(function() {
    Route::get('logout/{hashedTooken}', 'logout');
    Route::get('list-doctors', 'getDoctorForAppointments');
    Route::post('voluntary', 'registroVoluntario');
  });

  Route::controller(PatientsController::class)->group(function() {
    Route::get('patients-document/{dni}', 'getPatientByDni');
    Route::post('patients', 'store');
  });


  Route::post('appointment', [AppointmentController::class,'store']);
  Route::get('specialty', [SpecialtyController::class,'index']);
  Route::get('specialty/{id?}', [SpecialtyController::class,'index']);


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
      Route::get('find-user/{dni}','  ');
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

    });

    Route::controller(SpecialtyController::class)->group(function() {
      Route::get('specialty/detail/{id}', 'show');
      Route::post('specialty', 'store');
      Route::put('specialty/{id}', 'update');
      
    });

    Route::apiResource('clinic-history',ClinicHistoryController::class,['except' => ['destroy','index','update']]);

    Route::controller(RoleController::class)->group(function() {
      Route::get('role', 'index');
      Route::get('role/{id}', 'show');
      Route::post('role', 'store');
      Route::put('role/{id}', 'update');
    });



});



Route::fallback(function () {
    return view('errors.404');
});


