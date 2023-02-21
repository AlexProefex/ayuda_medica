<?php

namespace App\Http\Controllers;

use App\Models\Consultory;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Consultory\ConsultoryObject;
use App\Rules\ConsultoryValidation;
use App\Traits\ConsultoryPricesTrait;

class ConsultoryController extends BaseController
{

    use ConsultoryPricesTrait;
  
    //Obtener todos los consultorios
    public function index()
    {
      $consultory = Consultory::orderBy('consultories.updated_at', 'desc')
      ->orderBy('consultories.idConsultory', 'desc')
      ->get();
      if(is_null($consultory))
        return $this->responseMessage('not_found','List de Consultory!',[]);
      return $this->responseMessage('success','List de Consultory!',ConsultoryObject::collection($consultory));
    }

    //Obtener todos los consultorios activos
    public function getActiveConsultory()
    {
      $consultory = Consultory::orderBy('consultories.updated_at', 'desc')
      ->where('consultories.status','=','Activo')
      ->orderBy('consultories.idConsultory', 'desc')
      ->get();
      if(is_null($consultory))
        return $this->responseMessage('not_found','List de Consultory!',[]);
      return $this->responseMessage('success','List de Consultory!',ConsultoryObject::collection($consultory));
    }

    //Registrar un nuevo consultorios
    public function store(Request $request)
    {
      try {
        $input = $request->all();
        $validador = ConsultoryValidation::validateAttributes($input);
        if($validador->valid){

          if($input['idConsultory']==-1||$input['idConsultory']=="-1"){
            $res = $this->setInitialPricesConsultory($input);
          }
          else if ($input['idConsultory']==0||$input['idConsultory']=="0") {
            $res = $this->setBasePricesConsultory($input);
          }
          else if (intval($input['idConsultory'])>=0) {
            $res = $this->setPricesByConsultory($input);
          }
          else{
            return $this->responseMessage('success','no se encontro','');
          }

          if($res->valid)
            return $this->responseMessage('success','Consultory created!',new ConsultoryObject($res->consultory));
          else
            return $this->responseMessage('errorTransaction','Ha ocurrido un error');

        }
        return $this->responseMessage('rules','Campos requeridos',$validador->data);
      } catch (\Exception $e) {
        return $this->responseMessage('errorTransaction','Ha ocurrido un error');
      } catch(\Illuminate\Database\QueryException $e){
        return $this->responseMessage('error','Ups ha ocurrido un error inesperado');
      }          
    }

    //Obtener los datos de un consultorio por su identificador
    public function show($id)
    {
      $consultory = Consultory::find($id);
      if (is_null($consultory)) {
        return $this->responseMessage('not_found','Consultory not found','');
      }
      return $this->responseMessage('success','Consultory data!',new ConsultoryObject($consultory));
    }

    //Actualizar un consultorio mediante su identificador
    public function update(Request $request, $id)
    {
      try {

        $input = $request->all();  
        $validador = ConsultoryValidation::validateAttributes($input);
        if($validador->valid){

          $consultory = Consultory::find($id);
          $consultory->name = $input['name'];
          $consultory->idManager = $input['idManager'];
          $consultory->start_time = $input['start_time'];
          $consultory->end_time = $input['end_time'];
          $consultory->status = $input['status'];
          $consultory->save();
          return $this->responseMessage('success','Consultory created!',new ConsultoryObject($consultory));
        }

        return $this->responseMessage('rules','Campos requeridos',$validador->data);
          
      } catch (\Exception $e) {
        return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
      } catch(\Illuminate\Database\QueryException $e){
        return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado');
      }   
    }

}
