<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Expenses\ExpensesObject;
use App\Rules\ExpensesValidation;
use Illuminate\Http\Request;

class ExpensesController extends BaseController
{   
    //Listados todos los egresos
    public function index()
    {
      $expenses = Expenses::orderBy('expenses.updated_at', 'desc')
      ->orderBy('expenses.idExpenses', 'desc')
      ->get();

      if(is_null($expenses))
        return $this->responseMessage('not_found','List de Expenses!',[]);

      return $this->responseMessage('success','List de Expenses!',ExpensesObject::collection($expenses));
    }


    //Registrar un nuevo egreso
    public function store(Request $request)
    {
      try {

        $input = $request->all();  
        $validador = ExpensesValidation::validateAttributes($input);
        if($validador[0]){

          $expenses = new Expenses;
          $expenses->idUser = $input['idUser'];
          $expenses->document = $input['document'];
          $expenses->reason = $input['reason'];
          $expenses->observations = $input['observations'];
          $expenses->amount = $input['amount'];
          $expenses->details = $input['details'];
          $expenses->save();

          return $this->responseMessage('success','Expenses created!',new ExpensesObject($expenses));
          }

          return $this->responseMessage('rules','Campos requeridos',$validador[1]);

        } catch (\Exception $e) {
            return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
        } catch(\Illuminate\Database\QueryException $e){
            return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado');
        }   
    }

    //Obtener los datos de un egreso mediante su identificador
    public function show($id)
    {
      $expenses = Expenses::find($id);
      if(is_null($expenses))
        return $this->responseMessage('not_found','List de Expenses!',"");

      return $this->responseMessage('success','List de Expenses!',new ExpensesObject($expenses));
    }

    //Actualizar los datos de un egreso por medio de su identificador
    public function update(Request $request, $id)
    {
      try {

        $input = $request->all();  
        $validador = ExpensesValidation::validateAttributes($input);
        if($validador[0]){

          $expenses = Expenses::find($id);
          $expenses->idUser = $input['idUser'];
          $expenses->document = $input['document'];
          $expenses->reason = $input['reason'];
          $expenses->observations = $input['observations'];
          $expenses->amount = $input['amount'];
          $expenses->details = $input['details'];
          $expenses->save();

          return $this->responseMessage('success','Expenses created!',new ExpensesObject($expenses));
          }

          return $this->responseMessage('rules','Campos requeridos',$validador[1]);

        } catch (\Exception $e) {
            return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
        }
        catch(\Illuminate\Database\QueryException $e){
            return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado');
        }   
    }

}
