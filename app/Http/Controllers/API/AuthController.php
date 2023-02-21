<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Validator;

class AuthController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 

            $auth = Auth::user(); 
            //return $auth;
            $success['token'] =  $auth->createToken('LaravelSanctumAuth')->plainTextToken; 
            $success['name'] =  $auth->name;
   
            return $this->handleResponse($success, 'User logged-in!');
        } 
        else{ 
            return $this->handleError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

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
        $user = User::create($input);
        $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->handleResponse($success, 'User successfully registered!');
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
        $user = User::where('id','=',$input['id'])->update($input);
        if($user==1){
            $success=User::findOrFail($input['id']);
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
