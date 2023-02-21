<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\UserAdmin;
use Validator;

class UserAdminController extends BaseController
{



    public function login(Request $request)
    {
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){ 
         
            $auth =Auth::guard('admin')->user();
            $success['token'] =  $auth->createToken('LaravelSanctumAuth')->plainTextToken; 
            $success['name'] =  $auth->name;
   
            return $this->handleResponse($success, 'User logged-in!');
        } 
        else{ 
            return $this->handleError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
/*
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->handleError($validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = UserAdmin::create($input);
        $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->handleResponse($success, 'User successfully registered!');
    }*/

    public function register(Request $request)
    {/*
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->handleError($validator->errors());       
        }*/


         try {
            $input = $request->all();  
            $useradmin = new UserAdmin;
            $useradmin->fill([
                'name' => $input['name'],
                'last_name' => $input['last_name'],
                'document_number' => $input['document_number'],
                'phone_number' => $input['phone_number'],
                'email'=> $input['email'],
                'idRol'=> $input['idRol'],
                'avatar'=> $input['avatar'],
                'specialty'=> $input['specialty'],
                'state'=> 'Activo',
                'password'=> bcrypt($input['password'])
             ]);

            $useradmin->save();
            $success['token'] =  $useradmin->createToken('LaravelSanctumAuth')->plainTextToken;
            $success['name'] =  $useradmin->name;


            return $this->handleResponse($success, 'User successfully registered!');

            //return $this->responseMessage('success','Consultory created!',new ConsultoryObject($useradmin));
        } catch (Exception $e) {
            return $this->responseMessage('error', $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado'.$e);
        }          


   /*

        $input['password'] = bcrypt($input['password']);
        $user = UserAdmin::create($input);
        $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->handleResponse($success, 'User successfully registered!');

*/

    }


    public function update(Request $request)
    {

        //return $request;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->handleError($validator->errors());       
        }
   
        $input = $request->except('confirm_password');;
        $input['password'] = bcrypt($input['password']);
        $user = UserAdmin::where('id','=',$input['id'])->update($input);
        if($user==1){
            $success=UserAdmin::findOrFail($input['id']);
            return $this->handleResponse($success, 'User successfully updated..!');
        }
        else{
            return $this->handleError($validator->errors());   
        }
       // $user->tokens()->delete();
      //  $request->user()->currentAccessToken()->delete();
      //  $user->tokens()->where('id', $tokenId)->delete();
        //$success['token'] =  $user->createToken('KiruDent')->plainTextToken;
        //$success['name'] =  $user->name;
   
        
    }
}
