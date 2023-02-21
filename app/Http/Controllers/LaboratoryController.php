<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Laboratory\LaboratoryObject;
use App\Rules\LaboratoryValidation;

class LaboratoryController extends BaseController
{
    //Listado de todos los laboratorios
    public function index()
    {
      $laboratory = Laboratory::select('laboratories.*',
        DB::raw("COUNT(orders.idLaboratory) AS pendientes"))
        ->join('orders','orders.idLaboratory','=','laboratories.idLaboratory')
        ->where('orders.status','=','a')
        ->groupBy('orders.idLaboratory')
        ->get();

      if(is_null($laboratory))
        return $this->responseMessage('not_found','List de Laboratory!',[]);
      return $this->responseMessage('success','List de Laboratory!',LaboratoryObject::collection($laboratory));
    }

    //Registro de un nuevo laboratorio
    public function store(Request $request)
    {
      try {

        $input = $request->all();  
        $validador = LaboratoryValidation::validateAttributes($input);
        if($validador->valid){

          $laboratory = new Laboratory;
          $laboratory->business = $input['business'];
          $laboratory->name = $input['name'];
          $laboratory->email= $input['email'];
          $laboratory->laboratory_items = $input['laboratory_items'];
          $laboratory->save();

          return $this->responseMessage('success','Laboratory created!',new LaboratoryObject($laboratory));
          }

          return $this->responseMessage('rules','Campos requeridos',$validador->data);

        } catch (\Exception $e) {
            return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
        }
        catch(\Illuminate\Database\QueryException $e){
            return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado'.$e);
        }   

    }

    //Busqueda de un laboratorio mediante su identificador
    public function show($id)
    {
      $laboratory = Laboratory::all()->where('idLaboratory',$id);
      if(is_null($laboratory))
        return $this->responseMessage('not_found','List de Consultory!',"");

      return $this->responseMessage('success','List de Consultory!',LaboratoryObject::collection($laboratory));
    }

    //Actualizacion de los datos de un laboratorio mediante su identificador
    public function update(Request $request,$id)
    {
      try {

        $input = $request->all();  
        $validador = LaboratoryValidation::validateAttributes($input);
        if($validador->valid){

          $laboratory = Laboratory::find($id);
          $laboratory->business = $input['business'];
          $laboratory->name = $input['name'];
          $laboratory->email= $input['email'];
          $laboratory->laboratory_items = $input['laboratory_items'];
          $laboratory->save();

          return $this->responseMessage('success','Laboratory created!',new LaboratoryObject($laboratory));
        }
        return $this->responseMessage('rules','Campos requeridos',$validador->data);
        
      } catch (\Exception $e) {
          return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
      } catch(\Illuminate\Database\QueryException $e){
          return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado');
      }  
    }
/* 
    Funcion para modificar, misma logica Pedidos = Budget 

    public function pedidos(Request $request){

      DB::connection('tenant')->beginTransaction();
      try {
        $input = $request->all();  
        $validador = BudgetValidation::validateAttributes($input);

        if($validador[0]){

          $validadorDetail = BudgetValidation::validateDetails(json_decode($input['details'], true));
          if($validadorDetail[0]){

          $budget = new Budget;
          $payment = new Payment;
          $budget->idDoctor = $input['idDoctor'];
          $budget->idPatient = $input['idPatient'];
          $budget->idConvention = $input['idConvention'];
          $budget->idConsultory = $input['idConsultory'];
          $budget->subTotal = 0;
          $budget->total = 0;
          $budget->remainingBalance = 0;
          $budget->save();

          $total=0.00;
          $subTotal=0.00;

          $detailsBudge = json_decode($input['details'], true);

          foreach ($detailsBudge as $details) {
            $budgetDetail = new BudgetDetail;
            $budgetDetail->idBudget = $budget->idBudget;
            $budgetDetail->idTreatment = $details['idTreatment'];
            $budgetDetail->idMaterial = $details['idMaterial'];
            $budgetDetail->amount = $details['amount'];
            $budgetDetail->price = round($details['price'],2,PHP_ROUND_HALF_UP);
            $budgetDetail->subTotal = round(floatval($details['amount']) * floatval($budgetDetail->price),2, PHP_ROUND_HALF_UP);
            $budgetDetail->discount = $details['discount'];
            $budgetDetail->total = round((floatval($budgetDetail->subTotal) - round((floatval($budgetDetail->subTotal) * floatval(floatval($details['discount']) / 100)), 2, PHP_ROUND_HALF_UP)),2, PHP_ROUND_HALF_UP);
            $subTotal = round($subTotal + $budgetDetail->subTotal,2,PHP_ROUND_HALF_UP);
            $total = round($total + $budgetDetail->total,2,PHP_ROUND_HALF_UP);

            $budgetDetail->save();
          }

          //$budget = Budget::find($budget->idBudget);
          if(BudgetValidation::validatePrices($total,$input['total'])) {
             DB::connection('tenant')->rollback();
             return $this->responseMessage('rules','Failed','Precios modificados');
          }
         
          if(floatval($input['total']) === floatval($input['amount'])){
            $budget->remainingBalance = 0;
            $budget->status = 'pagado';
          }else{
            $budget->remainingBalance = floatval($input['total']) - floatval($input['amount']);
            $budget->total = $total;
          }
  
          $budget->save();
  
          $payment->idBudget = $budget->idBudget;
          $payment->currentBalance = $total;
          $payment->remainingBalance = $budget->remainingBalance;
          $payment->amount = $input['amount'];
          $payment->save();

          DB::connection('tenant')->commit();
          return $this->responseMessage('success','Budget created!', new BudgetObject($budget));
          }
        DB::connection('tenant')->rollback();
        return $this->responseMessage('rules','Campos requeridos',$validadorDetail[1]);
        } 
        DB::connection('tenant')->rollback();
        return $this->responseMessage('rules','Campos requeridos',$validador[1]);
      } catch (\Exception $e) {
        DB::connection('tenant')->rollback();
        return $this->responseMessage('error', 'Ha ocurrido un error');
      } catch(\Illuminate\Database\QueryException $e){
        DB::connection('tenant')->rollback();
        return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado');
      }
    }*/
}
