<?php

namespace App\Http\Controllers;

use App\Models\Convention;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Convention\ConventionObject;
use App\Rules\ConventionValidation;

class ConventionController extends BaseController
{

    //Listaro todos los convenios
    public function index()
    {
        $convention = Convention::orderBy('conventions.updated_at', 'desc')
        ->orderBy('conventions.idConvention', 'desc')
        ->get();
        if(is_null($convention))
          return $this->responseMessage('not_found','List de Convetion!',[]);
        return $this->responseMessage('success','List de Convention!',ConventionObject::collection($convention));
    }

    //Listar todos los convenios con estado activo
    public function getActiveConvention()
    {
        $convention = Convention::orderBy('conventions.updated_at', 'desc')
        ->where('conventions.status','=','Activo')
        ->orderBy('conventions.idConvention', 'desc')
        ->get();
        if(is_null($convention))
          return $this->responseMessage('not_found','List de Convetion!',[]);
        return $this->responseMessage('success','List de Convention!',ConventionObject::collection($convention));
    }

    //Registrar un nuevo convenio
    public function store(Request $request)
    {
      try {
          $input = $request->all();  
          $validador = ConventionValidation::validateAttributes($input,true);
          if($validador->valid){

            $convention = new Convention;
            $convention->name = $input['name'];
            $convention->company_name = $input['company_name'];
            $convention->discount = "";
            $convention->save();

            return $this->responseMessage('success','Convention created!',new ConventionObject($convention));
          }
          return $this->responseMessage('rules','Campos requeridos',$validador->data);

      } catch (\Exception $e) {
          return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
      }
      catch(\Illuminate\Database\QueryException $e){
          return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado');
      }      
    }

    //Registrar los descuentos asociados a un convenio
    public function discountTreatmentConvention(Request $request)
    {
      try {
        $input = $request->all();  
        $validador = ConventionValidation::validateDisscount($input);
        if($validador->valid){
          $convention = Convention::find($input['idConvention']);
          $convention->discount = $input['discount'];
          $convention->save();
          return $this->responseMessage('success','Convention!',new ConventionObject($convention));
        }
        return $this->responseMessage('rules','Campos requeridos',$validador->data);
      } catch (\Exception $e) {
        return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
      }
      catch(\Illuminate\Database\QueryException $e){
        return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado');
      }    

    }

    //Obtener los datos de un convenio mediante su identificador
    public function show($id)
    {
        $convention = Convention::find($id);
        if (is_null($convention)) {
          return $this->responseMessage('not_found','Convention not found','');
        }
        return $this->responseMessage('success','Convention data!',new ConventionObject($convention));
    }

    //Actualizar los datos de un convenio
    public function update(Request $request,$id)
    {
         try {
          $input = $request->all();  
          $validador = ConventionValidation::validateAttributes($input,false);
          
          if($validador->valid){
            $convention = Convention::find($id);
            $convention->name = $input['name'];
            $convention->company_name = $input['company_name'];
            $convention->status = $input['status'];
            $convention->save();
            return $this->responseMessage('success','Consultory created!',new ConventionObject($convention));
          }
          return $this->responseMessage('rules','Campos requeridos',$validador->data);

        } catch (\Exception $e) {
            return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
        }
        catch(\Illuminate\Database\QueryException $e){
            return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado');
        } 
    }

}
