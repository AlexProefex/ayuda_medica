<?php

namespace App\Http\Controllers;
use App\Models\Patients;
use App\Models\ConventionPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Patients\PatientsCollection;
use App\Http\Resources\Patients\PatientsObject;
use App\Http\Resources\Patients\PatientsResource;
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
	  //return $this->responseMessage('success','List de Patients!',new PatientsPaginate($patients));
		return $this->responseMessage('success','List de Patients!',PatientsResource::collection($patients)->response()->getData(true));

		//UserAdminsResource::collection($useradmin)->response()->getData(true)
  }
//PatientsPaginate::collection($patients)
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
				/*->whereFullText('name','like',$text.'%')
        ->orWhere('last_name','like',$text.'%')
        ->orWhere('document_number','like',$text.'%')*/
        ->paginate(10);
				if(is_null($patients))
         return $this->responseMessage('not_found','List de Patients!',[]);
        return $this->responseMessage('success','List de Patients!',PatientsResource::collection($patients)->response()->getData(true));
    }
    else{
			//Verificar si se puede resumir este codigo llamando al metodo index cuando la page sea mayor > 2
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
		//$avatar=[]; $isNewImage=false;
		DB::beginTransaction();
		try {
			$input = $request->all();
		  $validador = PatientsValidation::validateAttributes($input,false,false);

      if($validador->valid){
      
				$patients = new Patients;
				
				//$avatar = $this->hasFileImage($request,$patients);
				$avatar = $this->hasFileImage($request,new Patients);
  
				$patients->avatar = $avatar['avatar_old'];
				//$patients->avatar = $avatar;
				$isNewImage = true;


		
				$patients->name = $input['name'];
				$patients->last_name = $input['last_name'];
				$patients->document_type = $input['document_type'];
				$patients->document_number = $input['document_number'];
				$patients->phone_number = $request->has('phone_number') == true ? $input['phone_number'] :null; 
				$patients->email = $request->has('email') == true ? $input['email'] : null;
				$patients->birthdate = $input['birthdate'];
 				$patients->diseases = $input['diseases'];
				//$patients->password = bcrypt($input['password']);
				/*if(intval($input['edad'])<18){
					$patients->tutorName = $input['tutorName'];
					$patients->tutorLastName = $input['tutorLastName'];
					$patients->relationship = $input['relationship'];
				}*/


				$patients->save();

				/*if($request->has('conventions')){
					$conventions = json_decode($input['conventions'],true);
					foreach ($conventions as $convention) {

							$conventionPatient = new ConventionPatient;
							$conventionPatient->idPatient = $patients->idPatient;
							$conventionPatient->idConvention = $convention;
							$conventionPatient->save();
					}
				}*/


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
		/*$conventions = ConventionPatient::select(
			'conventions.idConvention',
			'conventions.name')
		->join('conventions','conventions.idConvention','=','convention_patients.idConvention')
		->where('convention_patients.idPatient','=',$id)
		->where('convention_patients.status','=','Activo')
		->get();*/
		 
		$conventions = [];

		if (is_null($patients)) {
			return $this->responseMessage('not_found','User not found','');
		}
		return $this->responseMessage('success','Patient data.',PatientsCollection::make($conventions,$patients));
	}


	//Busqueda de pacientes mediante su documento de identidad
	public function findPatient($dni)
	{
		$patients = Patients::where('document_number','=',$dni)->first();
		if (is_null($patients)) {
			return $this->responseMessage('not_found','User not found','');
		}
	 	return $this->responseMessage('success','Patient data!',new PatientsObject($patients));
	}

	//Actualizar los datos de un paciente mediante su identificador
	public function update(Request $request, $id)
	{

		//dd($request->all());
		//error
		$avatar=[];
		$isNewImage=false;
		$res = app()->make('stdClass');
		$res->error = true;

		DB::beginTransaction();
		try {

			$input = $request->all();
		
      $patients = Patients::find($id);

      $document_number = $input['document_number'] == $patients->document_number? true :false;
			//$password = is_null($input['password']) ? $patients->password: $input['password'];
			//$input['password'] = is_null($input['password']) ? "-": $input['password'];
			$email = true;
      $validador = PatientsValidation::validateAttributes($input,$email,$document_number);

      if($validador->valid){


				//$avatar = $this->hasFileImage($request,$patients,"PUT");

				$isNewImage=true;
		
	

				$avatar = $this->hasFileImage($request,new Patients, "PUT");

				$patients->avatar = $avatar['avatar_new'];
			

			

				$patients->name = $input['name'];
				$patients->last_name = $input['last_name'];
				$patients->document_type = $input['document_type'];
				$patients->document_number = $input['document_number'];
				$patients->phone_number = $request->has('phone_number') == true ? $input['phone_number'] : null; 
				$patients->email = $request->has('email') == true ? $input['email'] : null;
				$patients->birthdate = $input['birthdate'];
				$patients->diseases = $input['diseases'];
				//$patients->password = $password;
				/*if(intval($input['edad'])<18){
					$patients->tutorName = $input['tutorName'];
					$patients->tutorLastName = $input['tutorLastName'];
					$patients->relationship = $input['relationship'];
				}*/
				$patients->save();

	

				/*if($request->has('conventions')){
					$conventions = json_decode($input['conventions'],true);
					$conventionPatient = ConventionPatient::where('idPatient', '=' ,$patients->idPatient)->update(['status'=> 'Inactivo']);

					foreach ($conventions as $convention) {
					 $conventionPatient = ConventionPatient::where('idConvention','=',$convention)
					 ->where('idPatient','=',$patients->idPatient)
					 ->first();

						if(!$conventionPatient){
							$conventionPatient = new ConventionPatient;
							$conventionPatient->idPatient = $patients->idPatient;
							$conventionPatient->idConvention = $convention;
						}
						$conventionPatient->status = 'Activo';
						$conventionPatient->save();
					}
				}*/
				DB::commit();
				//$this->removeImage($request,$patients,$avatar);
				$res = $this->responseMessageBody('success', 'Patients updated!',new PatientsObject($patients));
				$res->error = false;
      }	else{
				DB::rollback();
				$res = $this->responseMessageBody('rules','Campos requeridos',$validador->data);
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


	public function login(Request $request)
    {

      $res = app()->make('stdClass');
      try{
        if(Auth::guard('patient')->attempt(['email' => $request->email, 'password' => $request->password])){ 
          $auth = Auth::guard('patient')->user();
          $success['token'] =  $auth->createToken('LaravelSanctumAuth',['read:limited'])->plainTextToken;


          $res = $this->responseMessageBody('success', 'Patient logged-in!', ["auth"=>$auth,"token"=>$success['token']]);
     
        } else{ 
          $res = $this->responseMessageBody('Authorized', 'Unauthorised',['error'=>'Unauthorised','Patient'=>'credenciales incorrectas']);
        } 
      } catch(\Illuminate\Database\QueryException $e){
        $res = $this->responseMessageBody('errorTransaction', 'Peticion fallida'.$e);
      } catch (\Exception $e) {
        $res = $this->responseMessageBody('error', 'Ha ocurrido un error'.$e);
      } catch (\Throwable $e) {
        $res = $this->responseMessageBody('generalError', 'Ups ha ocurrido un error inesperado'.$e);
      } finally{

        //return UserAdmin::all();
        return $this->responseMessage($res->status,$res->title,$res->message);
      }

    }
}

