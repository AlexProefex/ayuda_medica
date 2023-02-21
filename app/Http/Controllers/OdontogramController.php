<?php

namespace App\Http\Controllers;
use App\Models\Odontogram;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Odontogram\OdontogramCollecion;
use App\Http\Resources\Odontogram\OdontogramObject;
use App\Rules\OdontogramValidation;

class OdontogramController extends BaseController
{
    //Registro de un nuevo odontograma
    public function store(Request $request)
    {
      try {
        $input = $request->all();   
        $validador = OdontogramValidation::validateAttributes($input);
        if($validador->valid){

          $odontogram = new Odontogram;
          $odontogram->idPatient = $input['idPatient'];
          $odontogram->dataOdontogram = $input['dataOdontogram'];
          $odontogram->date = $input['date'];
          $odontogram->dateOdontogram = $input['date'].'-'.$input['idPatient'];
          $odontogram->save();

          return $this->responseMessage('success','Odontograma created!',new OdontogramObject($odontogram));
        }
        return $this->responseMessage('rules','Campos requeridos',$validador->data);
      } catch (\Exception $e) {
        return $this->responseMessage('errorTransaction', 'Ha ocurrido un error'.$e);
      } catch(\Illuminate\Database\QueryException $e){
        return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado');
      }
    }

    //Busqueda de las fechas de los odontogramas asociados a un paciente por medio del identificador del paciente
    public function show($id)
    {
      $odontogramDates = Odontogram::select('idOdontogram','date')
      ->where('idPatient','=',$id)
      ->orderBy('updated_at', 'desc')
      ->orderBy('idOdontogram', 'desc')
      ->get();
      $odontogram = Odontogram::where('idPatient', $id)
      ->orderBy('idOdontogram', 'desc')->take(1)->get();
      if (is_null($odontogram)||($odontogram)==[]||($odontogram)=="[]") {
          return $this->responseMessage('not_found','Odontograma not found!',[]);
      }
      return $this->handleResponse('Odontograma retrieved.',OdontogramCollecion::make($odontogram,$odontogramDates));
    }

    //Busqueda de todos los datos de un odontograma pertenecientes a una fecha determinada y el identificador del paciente
    public function getByDate($id,$date)
    {
      $odontogram = Odontogram::where('idPatient', $id)
      ->where('date', $date)
      ->orderBy('idOdontogram', 'desc')->take(1)->get();
      if (is_null($odontogram)) {
          return $this->responseMessage('not_found','Odontograma not found!',"");
      }
      return $this->handleResponse('Odontograma retrieved.',OdontogramObject::collection($odontogram));
    }


}
