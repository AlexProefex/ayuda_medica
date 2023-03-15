<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use App\Models\UserAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Specialty\SpecialtyResource;
use App\Http\Resources\Specialty\SpecialtyObject;
use App\Rules\SpecialtyValidation;


class SpecialtyController extends BaseController
{
    //Listado de especialidades
    public function index($id=0)
    {
      if(boolval($id))
      {
        $specialty = Specialty::Where('idCategory',$id)->get();
     
      }else{
        $specialty = Specialty::all();
      }
      if(is_null($specialty))
         return $this->responseMessage('not_found','List de Specialty!',[]);
      return $this->responseMessage('success','List de Specialty!',SpecialtyResource::collection($specialty));

    }


    public function show($id)
    {
      $specialty = Specialty::find($id);
      if (is_null($specialty)) {
        return $this->responseMessage('not_found','Specialty not found','');
      }
      return $this->responseMessage('success','Specialty data!',new SpecialtyObject($specialty));
    }



    public function store(Request $request)
    {
        try {
          
            $input = $request->all(); 
    
            $validador = SpecialtyValidation::validateAttributes($input);
    
            if($validador->valid){
              
              $specialty = new Specialty;
              $specialty->name = $input['name'];
              $specialty->idCategory = $input['idCategory'];
              $specialty->duration = $input['duration'];
              $specialty->description = $input['description'];
              $specialty->save();
        
              return $this->responseMessage('success','Specialty created!', new SpecialtyObject($specialty));
            }
            return $this->responseMessage('rules','Campos requeridos',$validador->data);
    
          } catch (\Exception $e) {
            return $this->responseMessage('errorTransaction', 'Ha ocurrido un error'.$e);
          } catch(\Illuminate\Database\QueryException $e){
            return $this->responseMessage('error', 'Upss ha ocurrido un error inesperado');
          }  
    }


    public function update(Request $request, $id)
    {
        try {

            $input = $request->all();  
            $validador = SpecialtyValidation::validateAttributes($input);
            if($validador->valid){
              $specialty = specialty::find($id);

              if(is_null($specialty)){
                return $this->responseMessage('not_found','Specialty not found','');
              }

              $specialty->name = $input['name'];
              $specialty->idCategory = $input['idCategory'];
              $specialty->duration = $input['duration'];
              $specialty->description = $input['description'];
              $specialty->save();
              return $this->responseMessage('success','specialty actualizada!',new SpecialtyObject($specialty));
            }
            return $this->responseMessage('rules','Campos requeridos',$validador->data);
    
          } catch (\Exception $e) {
            return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
          } catch(\Illuminate\Database\QueryException $e){
            return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado');
          }  
    }


}
