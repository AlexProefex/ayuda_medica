<?php

namespace App\Http\Controllers;
use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Patients\PatientsCollection;
use App\Http\Resources\Patients\PatientsObject;
use App\Http\Resources\Patients\PatientsResource;
use App\Http\Resources\Patients\PatientRestrict;
use App\Rules\PatientsValidation;
use App\Traits\HasFileImage;
use App\Traits\ResponseMessageTrait;

class PatientsController extends BaseController
{
	//sda
	use HasFileImage;
	use ResponseMessageTrait;

	//Listado de todos los pacientes 
	public function index()
  {
	  $patients = Patients::orderBy('updated_at', 'desc')
		->orderBy('idPatient', 'desc')
	  ->paginate(10);
		if(is_null($patients))
      return $this->responseMessage('not_found','List de Patients!',[]);
		return $this->responseMessage('success','List de Patients!',PatientsResource::collection($patients)->response()->getData(true));
	
  }

	//Busqueda de pacientes por una palabra determinada
	public function findPatientPaginate($text="")
	{
    if($text!=""){
      $patients = Patients::select('*')
        ->where('name','like','%'.$text.'%')
        ->orWhere('last_name','like','%'.$text.'%')
        ->orWhere('document_number','like','%'.$text.'%')
				->orderBy('updated_at', 'desc')
				->orderBy('idPatient', 'desc')
        ->paginate(10);
				if(is_null($patients))
         return $this->responseMessage('not_found','List de Patients!',[]);
        return $this->responseMessage('success','List de Patients!',PatientsResource::collection($patients)->response()->getData(true));
    }
    else{
      $patients = Patients::orderBy('updated_at', 'desc')
			->orderBy('idPatient', 'desc')
      ->paginate(10);
			if(is_null($patients))
         return $this->responseMessage('not_found','List de Patients!',[]);
      return $this->responseMessage('success','List de Patients!',PatientsResource::collection($patients)->response()->getData(true));
	  }
	}

	//Registro de un nuevo paciente
	public function store(Request $request)
	{
		$res = app()->make('stdClass');
		$res->error = true;
		$avatar=[]; $isNewImage=false;
		DB::beginTransaction();
		try {
			$input = $request->all();
		  $validador = PatientsValidation::validateAttributes($input,false);

      if($validador->valid){
      
				$patients = new Patients;
				$avatar = $this->hasFileImage($request,new Patients);
				$patients->avatar = $avatar['avatar_old'];
				$isNewImage = true;
				$patients->name = $input['name'];
				$patients->last_name = $input['last_name'];
				$patients->document_type = $input['document_type'];
				$patients->document_number = $input['document_number'];
				$patients->phone_number = $input['phone_number']; 
				$patients->email =  $input['email'];
				$patients->birthdate = $input['birthdate'];
 				$patients->diseases = $input['diseases'];
				$patients->save();

				DB::commit();
				$res = $this->responseMessageBody('success', 'User Patients created!!',new PatientsObject($patients));
				$res->error = false;
			}else{
				$res = $this->responseMessageBody('rules', 'Campos requeridos', $validador->data);
				$res->error = true;
			}

		} catch(\Illuminate\Database\QueryException $e){
			$res = $this->responseMessageBody('errorTransaction', 'Peticion fallida'.$e);
			$res->error = true;
		} catch (\Exception $e) {
			$res = $this->responseMessageBody('error', 'Ha ocurrido un error'.$e);
			$res->error = true;
		} catch (\Throwable $e) {
			$res = $this->responseMessageBody('generalError', 'Ups ha ocurrido un error inesperado'.$e);
			$res->error = true;
		} finally{
			if($res->error){
				DB::rollback();
			}
			if($res->error && $isNewImage)
			{
				$patients = new Patients;
				$this->removeImagePost($request,$patients,$avatar);
			}
	
			return $this->responseMessage($res->status,$res->title,$res->message);
		}
	}

	//Obtener todos los datos de un paciente mediante el identificador del paciente
	public function show($id)
	{
		$patients = Patients::find($id);
		if (is_null($patients)) {
			return $this->responseMessage('not_found','User not found','');
		}
		return $this->responseMessage('success','Patient data.',new PatientsObject($patients));
	}


	//Busqueda de pacientes mediante su documento de identidad
	public function findPatient($dni="0")
	{
		$patients = Patients::where('document_number','=',$dni)->first();
		if (is_null($patients)) {
			return $this->responseMessage('not_found','User not found','');
		}
	 	return $this->responseMessage('success','Patient data!',new PatientsObject($patients));
	}


	public function getPatientByDni($dni)
	{
		$patients = Patients::where('document_number','=',$dni)->first();
		if (is_null($patients)) {
			return $this->responseMessage('not_found','User not found','');
		}
	 	return $this->responseMessage('success','Patient data!',new PatientRestrict($patients));
	}

	//Actualizar los datos de un paciente mediante su identificador
	public function update(Request $request, $id)
	{

		$res = app()->make('stdClass');
		$res->error = true;
		$avatar=[]; $isNewImage=false;

		DB::beginTransaction();
		try {

			$input = $request->all();
		
      $patients = Patients::find($id);


			if (is_null($patients)) {
				$res = $this->responseMessageBody('not_found','Patients not found','');
				$res->error = true;
			}
			else{
				
				$document_number = $input['document_number'] == $patients->document_number? true :false;


	
				$validador = PatientsValidation::validateAttributes($input,$document_number);
	
				if($validador->valid){
	
	
					$isNewImage=true;		
					$avatar = $this->hasFileImage($request,$patients, "PUT");
					$patients->avatar = $avatar['avatar_new'];
	
					$patients->name = $input['name'];
					$patients->last_name = $input['last_name'];
					$patients->document_type = $input['document_type'];
					$patients->document_number = $input['document_number'];
					$patients->phone_number = $input['phone_number']; 
					$patients->email =  $input['email'];
					$patients->birthdate = $input['birthdate'];
					$patients->diseases = $input['diseases'];
					$patients->save();
	
					DB::commit();
					
					$this->removeImage($request,$patients,$avatar);
					$res = $this->responseMessageBody('success', 'Patients updated!',new PatientsObject($patients));
					$res->error = false;
				}	else{
					DB::rollback();
					$res = $this->responseMessageBody('rules','Campos requeridos',$validador->data);
					$res->error = true;
				}
			}

    } catch(\Illuminate\Database\QueryException $e){
			$res = $this->responseMessageBody('errorTransaction', 'Peticion fallida'.$e);
			$res->error = true;
		} catch (\Exception $e) {
			$res = $this->responseMessageBody('error', 'Ha ocurrido un error'.$e);
			$res->error = true;
		} catch (\Throwable $e) {
			$res = $this->responseMessageBody('generalError', 'Ups ha ocurrido un error inesperado'.$e);
			$res->error = true;
		} finally{
			if($res->error && $isNewImage)
			{
				$this->restoreImage($request,$avatar,new Patients);
			}
			if($res->error){
				DB::rollback();
			}
			return $this->responseMessage($res->status,$res->title,$res->message);
		}
	}

}

