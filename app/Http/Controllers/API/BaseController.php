<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{


    public function responseMessage($message,$msg,$result=[])
    {
    
        if($message=="success"){
            return $this->handleResponse($msg,$result);
        }
        else if($message=="rules"){
             return $this->handleRules($msg,$result);
        }
        else if($message=="not_found"){
            return $this->handleNotfound($msg,$result);
        }
         else if($message=="Authorized"){
            return $this->handleNoAuthorized($msg,$result);
        }
        else if($message=="errorTransaction"){
            return $this->handleErrorTransaction($msg,$result);
        }
        else if($message=="error"){
            return $this->handleError($msg,$result);
        }
        else{
            return $this->handleGeneralError($msg,$result);
        }
    }

    //Respuesta Satisfactoria
    public function handleResponse($msg,$result)
    {
      
     
    	$res = [
            'success' => true,
            'message' => $msg,
            'data'  => $result
        ];
        //'data'  => $result->resource, Get Paginate
     
        return response()->json($res, 200);
    }
     //Respuesta sin registros
    public function handleNotfound($msg,$result)
    {
        $res = [
            'success' => true,
            'message' => $msg,
            'data'    => $result,
       
        ];
        return response()->json($res, 200);
    }
   
    //Respuesta con incumplimiento de validacion
    public function handleRules($msg,$result)
    {
        $res = [
            'success' => false,
            'message' => $msg,
            'errors'    => $result,
       
        ];
        return response()->json($res, 200);
    }

    //Respuesta con errores
    public function handleErrorTransaction($msg,$errorMsg = [],$code = 400)
    {
    	$res = [
            'success' => false,
            'message' => $msg,
        ];
        if(!empty($errorMsg)){
            $res['data'] = $errorMsg;
        }
        return response()->json($res, $code);
    }

    //Respuesta con errores
    public function handleError($msg,$errorMsg = [],$code = 406)
    {
    	$res = [
            'success' => false,
            'message' => $msg,
        ];
        if(!empty($errorMsg)){
            $res['data'] = $errorMsg;
        }
        return response()->json($res, $code);
    }

     //Respuesta sin authorizacion
     public function handleNoAuthorized($msg,$errorMsg = [],$code = 401)
    {
        $res = [
            'success' => false,
            'message' => $msg,
        ];
        if(!empty($errorMsg)){
            $res['data'] = $errorMsg;
        }
        return response()->json($res, $code);
    }

    public static function handleNoAuthorizedMidle($msg,$errorMsg = [],$code = 401)
    {
        $res = [
            'success' => false,
            'message' => $msg,
        ];
        if(!empty($errorMsg)){
            $res['data'] = $errorMsg;
        }
        return response()->json($res, $code);
    }

    //Respuesta General Error

    public static function handleGeneralError($msg,$errorMsg = [],$code = 500)
    {
        $res = [
            'success' => false,
            'message' => $msg,
        ];
        if(!empty($errorMsg)){
            $res['data'] = $errorMsg;
        }
        return response()->json($res, $code);
    }


}
