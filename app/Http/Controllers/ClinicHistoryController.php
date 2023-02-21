<?php

namespace App\Http\Controllers;

use App\Models\ClinicHistory;
use App\Models\Patients;
use Illuminate\Http\Request;
use App\Http\Resources\ClinicHistory\ClinicHistoryObject;
use App\Http\Resources\ClinicHistory\ClinicHistoryCollection;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Rules\ClinicHistoryValidation;

class ClinicHistoryController extends BaseController
{
 
    //Registro de una historia clinica
    public function store(Request $request)
    {

      try {
          
        $input = $request->all(); 

        $validador = ClinicHistoryValidation::validateAttributes($input);

        if($validador->valid){
          
          $clinicHistory = new ClinicHistory;
          $clinicHistory->idDoctor = $input['idDoctor'];
          //$clinicHistory->idConsultory = $input['idConsultory'];
          $clinicHistory->idPatient = $input['idPatient'];
          $clinicHistory->observations = $input['observations'];
          $clinicHistory->save();
    
          return $this->responseMessage('success','History created!', new ClinicHistoryObject($clinicHistory));
        }
        return $this->responseMessage('rules','Campos requeridos',$validador->data);

      } catch (\Exception $e) {
        return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
      } catch(\Illuminate\Database\QueryException $e){
        return $this->responseMessage('error', 'Upss ha ocurrido un error inesperado');
      }
    }
    
    //Obtener las historias clinicas del paciente neduabte el identificador del paciente
    public function show($id)
    {
      $patients = Patients::find($id);
      $clinicHistory = ClinicHistory::select(
        'clinic_histories.idClinicHistory',
        'clinic_histories.idDoctor',
        //'clinic_histories.idConsultory',
        'clinic_histories.created_at as date',
        'user_admins.name as nameDoctor',
        'user_admins.last_name as lastNameDoctor',
        //'consultories.name as nameConsultory',
        'clinic_histories.observations')
      ->join('user_admins','user_admins.idUser','=','clinic_histories.idDoctor')
      //->join('consultories','consultories.idConsultory','=','clinic_histories.idConsultory')
      ->where('clinic_histories.idPatient','=',$id)
      ->orderBy('clinic_histories.updated_at', 'desc')
      ->orderBy('clinic_histories.idClinicHistory', 'desc')
      ->get();

      if(is_null($clinicHistory)||is_null($patients))
        return $this->responseMessage('not_found','List de Clinic History!',[]);

      return $this->responseMessage('success','List de Treatment!',ClinicHistoryCollection::make($clinicHistory,$patients,$clinicHistory));
    }

}
