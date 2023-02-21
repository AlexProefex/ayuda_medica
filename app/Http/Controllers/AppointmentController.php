<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patients;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Appointment\AppointmentCollection;
use App\Http\Resources\Appointment\AppointmentResource;
use App\Http\Resources\Appointment\AppointmentObject;
use App\Rules\AppointmentValidation;

class AppointmentController extends BaseController
{
  
    //Consulta de todas las citas medicas reservadas
    public function index()
    {
        $appointment = Appointment::select(
          'appointments.idAppointments',
          'appointments.date',
          'appointments.time',
          'appointments.idCategory',
          'appointments.location',
          'patients.name',
          'patients.last_name',
          'appointments.idDoctor',
          'appointments.status',
          'appointments.idSpecialty')
        ->join('patients','patients.idPatient','=','appointments.idPatient')
        ->where('appointments.status','=','reservado')
        ->orderBy('appointments.updated_at', 'desc')
        ->orderBy('appointments.idAppointments', 'desc')
        ->get();

        if(is_null($appointment))
          return $this->responseMessage('not_found','List de Appointment!',"[]");
        return $this->responseMessage('success','List de Appointment!',AppointmentResource::collection($appointment));

   
    }

    //Registro de citas medicas
    public function store(Request $request)
    {
      try {
        $input = $request->all();  
        $validador = AppointmentValidation::validateAttributes($input);
        if($validador->valid){

          $appointment = new Appointment;
          $appointment->idCategory = $input['idCategory'];
          $appointment->location = $input['location'];
          $appointment->idDoctor = $input['idDoctor'];
          $appointment->idPatient = $input['idPatient'];
          $appointment->idSpecialty = $input['idSpecialty'];
          $appointment->date = $input['date'];
          $appointment->time = $input['time'];
          $appointment->observation = $input['observation'];
          $appointment->status = 'reservado';
          $appointment->save(); 


          return $this->responseMessage('success','Appointment created!',new AppointmentObject($appointment));
        }
        return $this->responseMessage('rules','Campos requeridos',$validador->data);

      }catch (\Exception $e) {
            return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
      }catch(\Illuminate\Database\QueryException $e){
            return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado'.$e);
      }  
        
    }

    //Listado de citas medicas con los datos del paciente a quien le pertenece
    public function show($id)
    {
      $appointment = Appointment::select(
          'appointments.idDoctor',
          'appointments.idAppointments',
          'appointments.idPatient',
          'appointments.idSpecialty',
          'appointments.date',
          'appointments.time',
          'appointments.observation',
          'appointments.location',
          'appointments.idSpecialty',
          'specialties.name as specialty',
          'appointments.status'
      )
      ->join('specialties','appointments.idSpecialty','=','specialties.idSpecialty')
      ->where('appointments.idAppointments','=',$id)
      ->get();


      $patients = Patients::select(
          'appointments.idAppointments',
          'patients.name',
          'patients.last_name',
          'patients.email',
          'patients.document_number',
          'patients.phone_number'
      )
      ->join('appointments','appointments.idPatient','=','patients.idPatient')
      ->where('appointments.idAppointments','=',$id)
      ->get();

      if (is_null($appointment)||is_null($patients)) {
        return $this->responseMessage('not_found','Appointment|Patients not found','[]');
      }
      return $this->responseMessage('success','Appointment data!',AppointmentCollection::make($appointment,$patients));
    }


    //Actualizacion de citas medicas y su estado 
    public function update(Request $request, $id)
    {
      try {

        $input = $request->all();  
        $validador = AppointmentValidation::validateAttributes($input,false);
        if($validador->valid){

          $appointment = Appointment::find($id);
          $appointment->idCategory = $input['idCategory'];
          $appointment->location = $input['location'];
          $appointment->idDoctor = $input['idDoctor'];
          $appointment->idPatient = $input['idPatient'];
          $appointment->idSpecialty = $input['idSpecialty'];
          $appointment->date = $input['date'];
          $appointment->time = $input['time'];
          $appointment->observation = $input['observation'];
          $appointment->status = $input['status'];

          $appointment->save();
          
          return $this->responseMessage('success','Appointment created!',new AppointmentObject($appointment));
          }
        return $this->responseMessage('rules','Campos requeridos',$validador->data);

      } catch (\Exception $e) {
        return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
      } catch(\Illuminate\Database\QueryException $e){
        return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado');
      }  
    }

}
