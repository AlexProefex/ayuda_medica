<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\UserAdmin;
use App\Models\Specialty;
use App\Models\SpecialityUser;
use App\Models\PersonalAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\UserAdmins\UserAdminsObject;
use App\Http\Resources\UserAdmins\UserAdminsCollection;
use App\Http\Resources\UserAdmins\DoctorResource;
use App\Http\Resources\UserAdmins\DoctorRestrict;
use App\Http\Resources\UserAdmins\UserAdminsResource;
use App\Http\Resources\UserAdmins\UserAdminsResourceSpecialty;
use App\Http\Resources\UserAdmins\UserAdminsRestrict;

use App\Rules\UserValidation;
use App\Traits\ControlUserUpdate;
use App\Traits\HasFileImage;
use App\Traits\ResponseMessageTrait;

class UserAdminsController extends BaseController
{
    use ControlUserUpdate;
    use HasFileImage;
    use ResponseMessageTrait;

    //Autentitifcacion de Usuario
    public function login(Request $request)
    {

      $res = app()->make('stdClass');
      try{
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){ 
          $auth = Auth::guard('admin')->user();
          $success['token'] =  $auth->createToken('LaravelSanctumAuth',['read:limited'])->plainTextToken;
          $useradmin = $this->getUserAdmin($auth->idUser);
          $role = $this->getRoleidUser($auth->idRol);
          $speciality = $this->getEspecialityUser($auth->idUser);
          $res = $this->responseMessageBody('success', 'User logged-in!', UserAdminsCollection::make(collection:$role,user:$useradmin,speciality:$speciality,token:$success['token']));
     
        } else{ 
          $res = $this->responseMessageBody('Authorized', 'Unauthorized',['error'=>'Unauthorized','user'=>'credenciales incorrectas']);
        } 
      } catch(\Illuminate\Database\QueryException $e){
        $res = $this->responseMessageBody('errorTransaction', 'Peticion fallida'.$e);
      } catch (\Exception $e) {
        $res = $this->responseMessageBody('error', 'Ha ocurrido un error'.$e);
      } catch (\Throwable $e) {
        $res = $this->responseMessageBody('generalError', 'Ups ha ocurrido un error inesperado');
      } finally{
        return $this->responseMessage($res->status,$res->title,$res->message);
      }

    }

    //Autentificacion de usuario mediante el Token
    public function getUserbyToken($hashedTooken){
      $res = app()->make('stdClass');
      try {
        $personalAccessToken = new PersonalAccessToken;
        $token = $personalAccessToken::findToken($hashedTooken);
        $user = $token->tokenable;
        $useradmin = $this->getUserAdmin($user->idUser);
        $role = $this->getRoleidUser($user->idRol);
        $speciality = $this->getEspecialityUser($user->idUser);
        $res = $this->responseMessageBody('success','User logged-in.', UserAdminsCollection::make(collection:$role,user:$useradmin,speciality:$speciality,token:$hashedTooken));
      } catch (\Exception $e) {
        $res = $this->responseMessageBody('Authorized','Unauthorized.', ['error'=>'Unauthorized','user'=>'credenciales incorrectas']);
      } catch(\Illuminate\Database\QueryException $e){
        $res = $this->responseMessageBody('errorTransaction', 'Peticion fallida');
      } catch (\Throwable $e) {
        $res = $this->responseMessageBody('generalError', 'Ups ha ocurrido un error inesperado');
      } finally {
        return $this->responseMessage($res->status,$res->title,$res->message);
      }
    }
    //Borrado del token  generado en la autentificacion de usuario 
    public function logout($hashedTooken){
      $res = app()->make('stdClass');
      try {
        $personalAccessToken = new PersonalAccessToken;
        $token = $personalAccessToken::findToken($hashedTooken);
        if(is_null($token)){
          $res = $this->responseMessageBody('Authorized','Unauthorized.', ['error'=>'Unauthorized']);
        } else{
          $user = $token->tokenable;
          $user->tokens()->delete();
          $res = $this->responseMessageBody('success','Logout success','');
        }
      } catch (\Exception $e) {
        $res = $this->responseMessageBody('Authorized','Unauthorized.', ['error'=>'Unauthorized']);
      } catch(\Illuminate\Database\QueryException $e){
        $res = $this->responseMessageBody('Authorized','Unauthorized.', ['error'=>'Unauthorized']);
      } catch (\Throwable $e) {
        $res = $this->responseMessageBody('generalError', 'Ups ha ocurrido un error inesperado');
      } finally {
        return $this->responseMessage($res->status,$res->title,$res->message);
      }
    }

    //Listado de todos los usuarios
    public function index()
    {
      $useradmin = UserAdmin::select(
        'user_admins.name',
        'user_admins.last_name',
        'user_admins.document_number',
        'user_admins.phone_number',
        'user_admins.email',
        'user_admins.state',
        'user_admins.idRol',
        'user_admins.date',
        'user_admins.avatar',
        'user_admins.idUser',
        'user_admins.schedule',
        'user_admins.location',
        'user_admins.timezone',
        'user_admins.observations',
        'user_admins.idCategory',
        'user_admins.nColegiatura',
        'user_admins.document_type',
        'roles.name as roleName')
      ->join('roles','roles.idRol','=','user_admins.idRol')
      ->orderBy('user_admins.updated_at', 'desc')
		  ->orderBy('user_admins.idUser', 'desc')
      ->paginate(10);
  
      if(is_null($useradmin))
        return $this->responseMessage('not_found','List de Usuarios!',[]);
      return $this->responseMessage('success','List de Admins!', UserAdminsResource::collection($useradmin)->response()->getData(true));
    }
    
    //Listado de todos los usuarios con el estado activo
    public function getUserAll()
    {
      $useradmin = UserAdmin::select(
        'user_admins.name',
        'user_admins.last_name',
        'user_admins.document_number',
        'user_admins.phone_number',
        'user_admins.email',
        'user_admins.state',
        'user_admins.idRol',
        'user_admins.date',
        'user_admins.avatar',
        'user_admins.idUser',
        'user_admins.schedule',
        'user_admins.location',
        'user_admins.timezone',
        'user_admins.observations',
        'user_admins.document_type',
        'roles.name as roleName')
      ->join('roles','roles.idRol','=','user_admins.idRol')
      ->where('user_admins.state','Activo')
      ->orderBy('user_admins.updated_at', 'desc')
		  ->orderBy('user_admins.idUser', 'desc')
      ->get();

      if(is_null($useradmin))
        return $this->responseMessage('not_found','List de Usuarios!',[]);
       return $this->responseMessage('success','List de Admins!', UserAdminsResourceSpecialty::collection($useradmin));
    }

    //Busqueda de los usuarios segun una palabra 

    /*
    public function findUser($text="")
    { 
      if($text!=""){
        $useradmin = UserAdmin::select(
          'user_admins.name',
          'user_admins.last_name',
          'user_admins.document_number',
          'user_admins.phone_number',
          'user_admins.email',
          'user_admins.state',
          'user_admins.idRol',
          'user_admins.date',
          'user_admins.avatar',
          'user_admins.idUser',
          'user_admins.schedule',
          'user_admins.location',
          'user_admins.timezone',
          'user_admins.observations')
          ->join('roles','roles.idRol','=','user_admins.idRol')
          ->where('user_admins.name','like','%'.$text.'%')
          ->orWhere('user_admins.last_name','like','%'.$text.'%')
          ->orWhere('user_admins.document_number','like','%'.$text.'%')
          ->orderBy('user_admins.updated_at', 'desc')
          ->orderBy('user_admins.idUser', 'desc')
          ->paginate(10);

          if(is_null($useradmin))
            return $this->responseMessage('not_found','List de Usuarios!',[]);
          return $this->responseMessage('success','List de Admins!',UserAdminsResource::collection($useradmin)->response()->getData(true));
      }
      else{
        $useradmin = UserAdmin::select(
          'user_admins.name',
          'user_admins.last_name',
          'user_admins.document_number',
          'user_admins.phone_number',
          'user_admins.email',
          'user_admins.state',
          'user_admins.idRol',
          'user_admins.date',
          'user_admins.avatar',
          'user_admins.idUser',
          'user_admins.schedule',
          'user_admins.location',
          'user_admins.timezone',
          'user_admins.observations')
        ->join('roles','roles.idRol','=','user_admins.idRol')
        ->orderBy('user_admins.updated_at', 'desc')
        ->orderBy('user_admins.idUser', 'desc')
        ->paginate(10);
        if(is_null($useradmin))
          return $this->responseMessage('not_found','List de Usuarios!',[]);
        return $this->responseMessage('success','List de Admins!',UserAdminsResource::collection($useradmin)->response()->getData(true));
      }
    
    }
  */

    public function findUserDni($dni="0")
    { 
      $userAdmin = UserAdmin::where('document_number','=',$dni)->first();
      if (is_null($userAdmin)) {
        return $this->responseMessage('not_found','User not found','');
      }
       return $this->responseMessage('success','User data!',new UserAdminsRestrict($userAdmin));
    }

    //Registro de usuarios y sus propiedades consultorio, especialdad
    public function store(Request $request)
    {
      $res = app()->make('stdClass');
      $avatar=[]; $isNewImage=false;
      DB::beginTransaction();
      try {
        $input = $request->all();  
        $validador = UserValidation::validateAttributes($input,false,false, password : true);
        if($validador->valid){

          $avatar = $this->hasFileImage($request,new UserAdmin);
          $isNewImage = true;
          $useradmin = $this->setDataUserAdminwithValue(new UserAdmin,$input);
       
          if($useradmin){
            $useradmin->avatar = $avatar['avatar_old'];
          
            $useradmin->state = 'Activo';
            $useradmin->password = bcrypt($input['password']);
            $useradmin->save();
  
            if($request->has('specialties')){
              $specialties = json_decode($input['specialties'],true);
              foreach ($specialties as $speciality) {
                $specialityUser = $this->setUserEspecialty($useradmin,$speciality);
                $specialityUser->save();
              }
            }
            DB::commit();
            $res = $this->responseMessageBody('success', 'User created!',new UserAdminsObject($useradmin));
            $res->error = false;
          }
          else{
            $res = $this->responseMessageBody('error', 'Ha ocurrido un error');
            $res->error = true;

          }
        } 
        else{
          $res = $this->responseMessageBody('rules', 'Campos requeridos',$validador->data);
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
      } finally {
        if($res->error){
          DB::rollback();
        }
        if($res->error && $isNewImage)
        {
          $useradmin = new UserAdmin;
          $this->removeImagePost($request,$useradmin,$avatar);
        }
        return $this->responseMessage($res->status,$res->title,$res->message);
      }

    }

    public function registroVoluntario(Request $request)
    {
      $res = app()->make('stdClass');
      $avatar=[]; $isNewImage=false;
      DB::beginTransaction();
      try {
        $input = $request->all();  
        $validador = UserValidation::validateAttributes($input,false,false,password : true);
        if($validador->valid){

          //$avatar = $this->hasFileImage($request,new UserAdmin, yes);
          $avatar = $this->hasFileImage($request,new UserAdmin);

          $isNewImage = true;

          $useradmin = $this->setDataUserAdminwithValue(new UserAdmin,$input);
          if($useradmin){
            $useradmin->avatar = $avatar['avatar_old'];
          
            $useradmin->state = 'Activo';
            $useradmin->idRol = 2;
            $useradmin->password = bcrypt($input['password']);
            $useradmin->save();
  
            if($request->has('specialties')){
              $specialties = json_decode($input['specialties'],true);
              foreach ($specialties as $speciality) {
                $specialityUser = $this->setUserEspecialty($useradmin,$speciality);
                $specialityUser->save();
              }
            }
            DB::commit();
            $res = $this->responseMessageBody('success', 'User created!',new UserAdminsObject($useradmin));
            $res->error = false;
          }
          else{
            $res = $this->responseMessageBody('error', 'Ha ocurrido un error');
            $res->error = true;

          }
        } 
        else{
          $res = $this->responseMessageBody('rules', 'Campos requeridos',$validador->data);
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
      } finally {
        if($res->error){
          DB::rollback();
        }
        if($res->error && $isNewImage)
        {
          $useradmin = new UserAdmin;
          $this->removeImagePost($request,$useradmin,$avatar);
        }
        return $this->responseMessage($res->status,$res->title,$res->message);
      }

    }

    //Busqueda de usuario por id
    public function show($id)
    {
      try {

        $useradmin = $this->getUserAdmin($id);
  
        if($useradmin=='[]'||$useradmin==[])
          return  $this->responseMessage('not_found','User not found!','');

        $role = $this->getRoleidUser($useradmin[0]['idRol']);
        $speciality = $this->getEspecialityUser($id);

        return $this->responseMessage('success','User!',UserAdminsCollection::make(collection:$role,user:$useradmin,speciality:$speciality,token:null));

      } catch (\Throwable $e) {
        return  $this->responseMessage('generalError', 'Ups ha ocurrido un error inesperado'.$e);
      } 

    }

    //Listado de doctores
    public function getDoctor()
    {
      $users = UserAdmin::select(
        DB::raw("CONCAT(user_admins.last_name,' ',user_admins.name) AS username"),
        'user_admins.idUser',
        'user_admins.schedule',
        'user_admins.avatar',
        'user_admins.document_type',
        'user_admins.state')
        ->where('user_admins.idRol','=',2)
        ->where('user_admins.state','=','Activo')
        ->orderBy('user_admins.idUser','desc')
        ->get();
        $doctors = array();
      
        foreach ($users as $user) {
          $specialidad = UserAdmin::select(
            'specialties.idSpecialty',
            'specialties.name as specialty')
            ->join('speciality_users','speciality_users.idUser','=','user_admins.idUser')
            ->join('specialties','specialties.idSpecialty','=','speciality_users.idSpecialty')
            ->where('user_admins.idUser','=',$user->idUser)
            ->where('speciality_users.status','=','Activo')
            ->orderBy('user_admins.idUser','asc')
            ->get();

            if($specialidad ==[] || $specialidad == "[]")
            $specialidad = NULL;

            $doctors[] = array(
              'idUser' => $user->idUser,
              'username' => $user->username,
              'schedule' => $user->schedule,
              "state" =>  $user->state,
              "specialties" =>  $specialidad,
              
            ); 
        }
        if(is_null($users))
          return $this->responseMessage('not_found','Listado!',[]);
        return $this->responseMessage('success','Listado!',DoctorResource::collection($doctors));
    }


    public function getDoctorForAppointments()
    {
      $users = UserAdmin::select(
        'last_name', 
        'name',
        'idUser',
        'schedule',
        'state',
        'timezone',
        'idCategory',
        'nColegiatura',
        'avatar',
        'observations',
        'document_type',
        )
        ->where('user_admins.idRol','=',2)
        ->where('user_admins.state','=','Activo')
        ->orderBy('user_admins.idUser','desc')
        ->get();
        $doctors = array();



      
        foreach ($users as $user) {
          $specialidad = UserAdmin::select(
            'specialties.idSpecialty',
            'specialties.name as specialty')
            ->join('speciality_users','speciality_users.idUser','=','user_admins.idUser')
            ->join('specialties','specialties.idSpecialty','=','speciality_users.idSpecialty')
            ->where('user_admins.idUser','=',$user->idUser)
            ->where('speciality_users.status','=','Activo')
            ->orderBy('user_admins.idUser','asc')
            ->get();

            if($specialidad ==[] || $specialidad == "[]")
            $specialidad = [];

            $doctors[] = array(
              'idUser' => $user->idUser,
              'name' => $user->name,
              'last_name' => $user->last_name,
              'schedule' => $user->schedule,
              "state" =>  $user->state,
              "timezone" =>  $user->timezone,
              "specialty" =>  $specialidad,
              "idCategory" =>  $user->idCategory,
              "nColegiatura" =>  $user->nColegiatura,
              "observations" =>  $user->observations,
              "avatar" => $user->avatar,
            ); 
        }
        if(is_null($users))
          return $this->responseMessage('not_found','Listado!',[]);
        return $this->responseMessage('success','Listado!',DoctorRestrict::collection($doctors));
    }

    //Actualizar usuario y sus propiedades consultorio, especialdad
    public function update(Request $request, $id)
    {
      $res = app()->make('stdClass');
      $avatar=[]; $isNewImage=false;
      DB::beginTransaction();
      try {
        $input = $request->all();
        $useradmin = UserAdmin::find($id);
        $document_number = $input['document_number'] == $useradmin->document_number ? true : false;
        $email = $input['email'] == $useradmin->email ? true : false;
        $state = true;

        $validador = UserValidation::validateAttributes($input,$email,$document_number,$state);

        if($validador->valid){

          
          $avatar = $this->hasFileImage($request,$useradmin,"PUT");
          $isNewImage=true;
          $useradmin = $this->setDataUserAdminwithValue($useradmin,$input);
          if($useradmin){

   
            $useradmin->avatar = $avatar['avatar_new'];
            $useradmin->state = $input['state'];
            $useradmin->password = $input['password'] !="" ? bcrypt($input['password']) : $useradmin->password;
            $useradmin->save();
  
            if($request->has('specialties')){
              $specialties = json_decode($input['specialties'],true);
              $specialityUser = SpecialityUser::where('idUser', '=' ,$useradmin->idUser)->update(['status'=> 'Inactivo']);
    
              foreach ($specialties as $speciality) {
               $specialityUser = SpecialityUser::where('idSpecialty', '=',$speciality)
               ->where('idUser','=',$useradmin->idUser)
               ->first();
    
                if(!$specialityUser){
                  $specialityUser = $this->setUserEspecialty($useradmin,$speciality);
                }
                $specialityUser->status = 'Activo';
                $specialityUser->save();
              }
            }
  
            DB::commit();
            $res = $this->responseMessageBody('success', 'User updated!',new UserAdminsObject($useradmin));
            $this->removeImage($request,$useradmin,$avatar);
            $res->error = false;
          }
          else{
            $res = $this->responseMessageBody('error', 'Ha ocurrido un error');
            $res->error = true;
          }
        }
        else{
          $res = $this->responseMessageBody('rules', 'Campos requeridos!',$validador->data);
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
      } finally {
        if($res->error && $isNewImage)
        {
          $this->restoreImage($request,$avatar,new UserAdmin);
        }
        if($res->error){
          DB::rollback();
        }
        return $this->responseMessage($res->status,$res->title,$res->message);
      }

    }

    public function updateSchedule(Request $request, $id)
    {
      $res = app()->make('stdClass'); 
      DB::beginTransaction();
      try {
        $input = $request->all();

        $validador = UserValidation::validateSchedule($input);
        if($validador->valid){
            $useradmin = UserAdmin::find($id);
            if(is_null($useradmin))
            {
              $res = $this->responseMessageBody('success', 'Usuario no encontrado','');
              $res->error = true;
            }
            else{
              $useradmin->schedule = $input['schedule'];
              $useradmin->save();
              DB::commit();
              $res = $this->responseMessageBody('success', 'User updated!',new UserAdminsObject($useradmin));
              $res->error = false;
            }
        }
        else{
          $res = $this->responseMessageBody('rules', 'Campos requeridos!',$validador->data);
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
      } finally {

        if($res->error){
          DB::rollback();
        }
        return $this->responseMessage($res->status,$res->title,$res->message);
      }

    }

    //Verifica si  un consultorio tiene una cita pendiente a partir de la fecha acutal del sistema
    public function ruleToscheduleDoctor(Request $request, $id){
      try {
        $res = $this->appointmentConsultoryOne($request,$id);
        if($res['consultory'] != 0){
          return $this->responseMessage('rules','campos con citas reservadas',true);
        }
        return $this->responseMessage('rules','campos con citas reservadas',false);
      }catch (\Throwable $e) {
        return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
      }
    }

    //Obtiene los roles de un usuario
    private function getRoleidUser($idRol){
      $role = Role::select('idRol','name')
      ->where('idRol','=',$idRol)
      ->get();
      return $role;
    }

    //Obtiene las especialidades de un usuario
    private function getEspecialityUser($idUser){
      $speciality = Specialty::select(
        'specialties.idSpecialty',
        'specialties.name')
      ->join('speciality_users','speciality_users.idSpecialty','=','specialties.idSpecialty')
      ->where('speciality_users.status','=','Activo')
      ->where('speciality_users.idUser','=',$idUser)
      ->get();
      return $speciality;
    }

    //Obtiene los datos Personalizados de un usuario 
    private function getUserAdmin($idUser){
      $useradmin = UserAdmin::select(
        'idUser',
        'name',
        'last_name',
        'document_number',
        'phone_number',
        'email',
        'idRol',
        'date',
        'avatar',
        'schedule',
        'state',
        'location',
        'timezone',
        'observations',
        'idCategory',
        'nColegiatura',
        'document_type'
        )
      ->where('idUser','=',$idUser)
      ->get();

      /*if (is_null($useradmin)) {
        return [];
      }*/
      return $useradmin;
    }

    private function setDataUserAdminwithValue($useradmin,$input){
      try{
        $useradmin->name = $input['name'];
        $useradmin->last_name = $input['last_name'];
        $useradmin->document_number = $input['document_number'];
        $useradmin->phone_number = $input['phone_number'];
        $useradmin->email= $input['email'];
        $useradmin->idRol= $input['idRol'];
        $useradmin->date= $input['date'];
        $useradmin->schedule = $input['schedule'];
        $useradmin->location = $input['location'];
        $useradmin->timezone = $input['timezone'];
        $useradmin->observations = $input['observations'];
        $useradmin->idCategory = $input['idCategory'];
        $useradmin->nColegiatura = $input['nColegiatura'];
        $useradmin->document_type = $input['document_type'];
        

        return $useradmin;
      } catch (\Throwable $e) { 
        return null;
      }
    }


    private function setUserEspecialty($useradmin,$speciality){
      $specialityUser = new SpecialityUser;
      $specialityUser->idUser = $useradmin->idUser;
      $specialityUser->idSpecialty = $speciality;
      $specialityUser->status = 'Activo';
      return $specialityUser;
    }
    
}
