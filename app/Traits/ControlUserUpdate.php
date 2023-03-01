<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use App\Models\SpecialityUser;
use App\Models\UserConsultory;
use Illuminate\Support\Carbon;


trait ControlUserUpdate {

  //Listado y validacion de la cistas medicas asociados a su consultroio y especialidad de un determinado doctor 
	public function controlappointment($idUser,$request){
    try {
      $specialty = $this->appointmentSpecialty($request->all(),$idUser);
      $consultory = $this->appointmentConsultory($request->all(),$idUser);
      return ['specialty' => $specialty,'consultory' => $consultory];
    } catch (\Throwable $e) {
      return ['specialty' => [],'consultory' => []];
    }
	}


  //Listado de las citas medicas con estado reservado con respecto a una determinada especialidad
  private function appointmentSpecialty($input,$idUser,$specialty = []){
    try {
      $specialtiesUser = SpecialityUser::select('idSpecialty')
      ->where('idUser','=',$idUser)
      ->where('status','=','Activo')
      ->get()
      ->pluck('idSpecialty')
      ->toArray();
     
      if($specialtiesUser != []){
        $specialties = json_decode($input['specialties'],true);
        $specialtyDanger = array_diff($specialtiesUser, $specialties);
        foreach ($specialtyDanger as $idSpecialty) {
          $appointment = Appointment::select( DB::raw("COUNT(appointments.idAppointments) AS pendientes"))
          ->where('appointments.status','=','reservado')
          ->where('appointments.idDoctor','=',$idUser)
          ->where('appointments.date','>=',Carbon::now()->toDateString())
          ->where('appointments.idSpecialty','=',$idSpecialty)
          ->first();
          if($appointment->pendientes>0){
            $specialty[] =  $idSpecialty;
          }
        }
      }
      return $specialty;
    } catch (\Throwable $e) {
      return $specialty;
    }
  }  
  //Listado de las citas medicas con estado reservado con respecto a un determinado consultorio
  private function appointmentConsultory($input,$idUser,$consultory =[]){
    try {
      $userConsultory = UserConsultory::select('idConsultory')
      ->where('idUser','=',$idUser)
      ->where('status','=','Activo')
      ->get()
      ->pluck('idConsultory')
      ->toArray();
      if($userConsultory!= []){
        $consultories = json_decode($input['consultories'],true);
        $consultoryDanger = array_diff($userConsultory, $consultories);
        foreach ($consultoryDanger as $idConsultory) {
          $appointment = Appointment::select( DB::raw("COUNT(appointments.idAppointments) AS pendientes"))
          ->where('appointments.status','=','reservado')
          ->where('appointments.idDoctor','=', $idUser)
          ->where('appointments.date','>=', Carbon::now()->toDateString())
          ->where('appointments.idConsultory','=',$idConsultory)
          ->first();
          if($appointment->pendientes>0){
            $consultory[] =  $idConsultory;
          }
        }
      }
      return $consultory;
    } catch (\Throwable $e) {
      return $consultory;
    }

  }
  //Un consultorio Listado de las citas medicas con estado reservado con respecto a un determinado consultorio
  public function appointmentConsultoryOne($input,$idUser,$consultory = 0){
    try {
          $appointment = Appointment::select( DB::raw("COUNT(appointments.*) AS pendientes"))
          ->where('appointments.status','=','reservado')
          ->where('appointments.idDoctor','=', $idUser)
          ->where('appointments.date','>=', Carbon::now()->toDateString())
          //->where('appointments.idConsultory','=',$input['idConsultory'])
          ->first();
  
          if($appointment->pendientes>0){
            $consultory = $input['idConsultory'];
          }

          return ['consultory' => $consultory];
    } catch (\Exception $e) {
          return ['consultory' => 0];
    }
  

  }

}

