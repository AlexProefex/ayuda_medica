<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Budget;
use App\Models\BudgetDetail;
use App\Models\Odontogram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Budget\BudgetObject;
use App\Http\Resources\Budget\BudgetCollection;
use App\Rules\BudgetValidation;
use App\Traits\RoundedFunctions;

class BudgetController extends BaseController
{

    use RoundedFunctions;

    //Listado de todos los presupuestos 
    public function index()
    {
      $budget=Budget::select(
        'budgets.idBudget',
        'patients.idPatient',
        'patients.name',
        'patients.last_name',
        'budgets.idDoctor',
        'user_admins.name as nameDoctor',
        'user_admins.last_name as lastNameDoctor',
        'consultories.idConsultory',
        'consultories.name as nameConsultorio',
        'budgets.total',
        'budgets.observation',
        'budgets.created_at as date')
      ->join('patients','patients.idPatient','=','budgets.idPatient')
      ->join('user_admins','user_admins.idUser','=','budgets.idDoctor')
      ->join('consultories','consultories.idConsultory','=','budgets.idConsultory')
      ->orderBy('budgets.updated_at', 'desc')
      ->orderBy('budgets.idBudget', 'desc')
      ->get();
      if(is_null($budget))
        return $this->responseMessage('not_found','List de Budget!',[]);
      return $this->responseMessage('success','List de Budget!',$budget);
    }

    //Registro de un nuevo presupuesto
    public function store(Request $request)
    {
      DB::connection('tenant')->beginTransaction();
      try {
        $input = $request->all();  
        $validador = BudgetValidation::validateAttributes($input);

        if($validador->valid){
        
          if($request->has('idOdontogram')){
        
            $odontogram = Odontogram::find($input['idOdontogram']);
            $odontogram->status = "realizado";
            $odontogram->save();
          }

          //$validadorDetail = BudgetValidation::validateDetails(json_decode($input['details'], true));
          //if($validadorDetail->valid){

          $budget = new Budget;
   
          $budget->idDoctor = $input['idDoctor'];
          $budget->idPatient = $input['idPatient'];
          $budget->idConvention = $input['idConvention'];
          $budget->idConsultory = $input['idConsultory'];
          $budget->total = 0;
          $budget->elements = $input['elements'];
          $budget->observation = $request->has('observation')?$input['observation']:"";
          $budget->save();
          $total=0.00;
          
          $detailsBudge = json_decode($input['details'], true);

          foreach ($detailsBudge as $details) {
            $budgetDetail = new BudgetDetail;
            $budgetDetail->idBudget = $budget->idBudget;
            $budgetDetail->idTreatment = $details['idTreatment'];
            $budgetDetail->idMaterial = $details['idMaterial'];
            $budgetDetail->amount = $details['amount'];
            $budgetDetail->price = $this->twoDecimal($details['price']);
            $budgetDetail->subTotal = $this->twoDecimal($details['amount']) * $this->twoDecimal($budgetDetail->price);
            $budgetDetail->discount = $details['discount'];
            $budgetDetail->total = $this->twoDecimal($budgetDetail->subTotal) - $this->twoDecimal($this->twoDecimal($budgetDetail->subTotal) * floatval($details['discount']) / 100);

            $total = $this->twoDecimal($total + $budgetDetail->total);
            $budgetDetail->save();
          }

          if(BudgetValidation::validatePrices($this->twoDecimal($total),$this->twoDecimal($input['total']))) {
             DB::connection('tenant')->rollback();
             return $this->responseMessage('rules','Failed','Precios modificados');
          }
          $budget->total = $total;
          $budget->save();

          DB::connection('tenant')->commit();
          return $this->responseMessage('success','Budget created!', new BudgetObject($budget));
          //}
        //DB::connection('tenant')->rollback();
        //return $this->responseMessage('rules','Campos requeridos',$validadorDetail->data);
        } 
        DB::connection('tenant')->rollback();
        return $this->responseMessage('rules','Campos requeridos',$validador->data);
      } catch (\Exception $e) {
        DB::connection('tenant')->rollback();
        return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
      } catch(\Illuminate\Database\QueryException $e){
        DB::connection('tenant')->rollback();
        return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado');
      }
    }


    //Consulta de un presupuesto mediante su identificador 
    public function show($id)
    {
      $budget=Budget::select(
        'budgets.idBudget',
        'patients.idPatient',
        'patients.name',
        'patients.last_name',
        'budgets.idDoctor',
        'user_admins.name as nameDoctor',
        'user_admins.last_name as lastNameDoctor',
        'consultories.idConsultory',
        'consultories.name as nameConsultorio',
        'budgets.total',
        'budgets.observation',
        'budgets.created_at as date',
        'budgets.elements')
      ->join('patients','patients.idPatient','=','budgets.idPatient')
      ->join('user_admins','user_admins.idUser','=','budgets.idDoctor')
      ->join('consultories','consultories.idConsultory','=','budgets.idConsultory')
      ->where('budgets.idPatient','=',$id)
      ->get();

      if(is_null($budget))
        return $this->responseMessage('not_found','List de Budget!',"");
      return $this->responseMessage('success','List de Budget!',$budget);
    }

    //Busqueda de completa de todos los datos asociados a un presupuestos (cabecera y cuerpo)
    public function budgetDetails($id)
    {
      $budget = Budget::select(
        'budgets.idBudget',
        'budgets.idDoctor',
        'budgets.idPatient',
        'budgets.idConvention',
        'budgets.idConsultory',
        'budgets.total',
        'budgets.observation',
        'budgets.created_at as date',
        'patients.idPatient',
        'patients.name',
        'patients.last_name',
        'user_admins.name as nameDoctor',
        'user_admins.last_name as lastNameDoctor',
        'consultories.name as nameConsultorio',
        'budgets.elements')
      ->join('patients','patients.idPatient','=','budgets.idPatient')
      ->join('user_admins','user_admins.idUser','=','budgets.idDoctor')
      ->join('consultories','consultories.idConsultory','=','budgets.idConsultory')
      ->where('budgets.idBudget','=',$id)
      ->get();

      $budgetDetail = BudgetDetail::select(
        'budget_details.idBudgetDetail',
        'budget_details.idBudget',
        'budget_details.idTreatment',
        'budget_details.idMaterial',
        'budget_details.amount',
        'budget_details.price',
        'budget_details.subTotal',
        'budget_details.discount',
        'budget_details.total',
        'treatments.name',
        'materials.name as materialName')
      ->join('budgets','budgets.idBudget','=','budget_details.idBudget')
      ->join('treatments','treatments.idTreatment','=','budget_details.idTreatment')
      ->leftJoin('materials','materials.idMaterial','=','budget_details.idMaterial')
      ->where('budgets.idBudget','=',$id)
      ->get();
        
      if(is_null($budgetDetail)||is_null($budget))
        return $this->responseMessage('not_found','List de Budget!',"");
      return $this->responseMessage('success','List de Budget!',BudgetCollection::make($budget,$budget,$budgetDetail));
    }


}
