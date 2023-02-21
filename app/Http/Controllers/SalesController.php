<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\SalesDetail;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Sales\SalesObject;
use App\Http\Resources\Sales\SalesCollection;
use App\Rules\SalesValidation;
use App\Traits\RoundedFunctions;
class SalesController extends BaseController
{
  use RoundedFunctions;

  //Listado de ventas
    public function index()
    {
      $sales = Sales::select(
        'sales.idSales',
        'patients.idPatient',
        'patients.name',
        'patients.last_name',
        'sales.idDoctor',
        'user_admins.name as nameDoctor',
        'user_admins.last_name as lastNameDoctor',
        'consultories.idConsultory',
        'consultories.name as nameConsultorio',
        'sales.total',
        'sales.status',
        'sales.created_at as date')
      ->join('patients','patients.idPatient','=','sales.idPatient')
      ->join('user_admins','user_admins.idUser','=','sales.idDoctor')
      ->join('consultories','consultories.idConsultory','=','sales.idConsultory')
      ->orderBy('sales.updated_at', 'desc')
			->orderBy('sales.idSales', 'desc')
      ->get();
      if(is_null($sales))
        return $this->responseMessage('not_found','List de sales!',[]);
      return $this->responseMessage('success','List de sales!',$sales);
    }

    //Registro de una nueva venta
    public function store(Request $request)
    {
      DB::connection('tenant')->beginTransaction();
      try {
        $input = $request->all();  
        $validador = SalesValidation::validateAttributes($input);

        if($validador->valid){

          $validadorDetail = SalesValidation::validateDetails(json_decode($input['details'], true));
          if($validadorDetail->valid){

          $sales = new Sales;
          $payment = new Payment;
          $sales->idDoctor = $input['idDoctor'];
          $sales->idPatient = $input['idPatient'];
          $sales->idConvention = $input['idConvention'];
          $sales->idConsultory = $input['idConsultory'];
          $sales->total = 0;
          $sales->remainingBalance = 0;
          $sales->elements = $input['elements'];
          $sales->save();

          $total=0.00;
  

          $detailSales = json_decode($input['details'], true);

          foreach ($detailSales as $details) {
            $salesDetail = new SalesDetail;
            $salesDetail->idSale = $sales->idSale;
            $salesDetail->idTreatment = $details['idTreatment'];
            $salesDetail->idMaterial = $details['idMaterial'];
            $salesDetail->amount = $details['amount'];
            $salesDetail->price = $this->twoDecimal($details['price']);
            $salesDetail->subTotal = $this->twoDecimal(floatval($details['amount']) * floatval($salesDetail->price));
            $salesDetail->discount = $details['discount'];
            $salesDetail->total = $this->twoDecimal(floatval($salesDetail->subTotal) - $this->twoDecimal(floatval($salesDetail->subTotal) * floatval($details['discount']) / 100));
            $total = $this->twoDecimal($total + $salesDetail->total);
            $salesDetail->save();
          }

          if(SalesValidation::validatePrices($this->twoDecimal($total),$this->twoDecimal($input['total']))) {
             DB::connection('tenant')->rollback();
             return $this->responseMessage('rules','Failed','Precios modificados');
          }
         
          if($this->twoDecimal($input['total']) === $this->twoDecimal($input['amount'])){
            $sales->remainingBalance = 0;
            $sales->status = 'pagado';
          }else{
            $sales->remainingBalance = $this->twoDecimal($input['total']) - $this->twoDecimal($input['amount']);
            $sales->total = $total;
          }
  
          $sales->save();
  
          $payment->idSale = $sales->idSale;
          $payment->currentBalance = $total;
          $payment->remainingBalance = $sales->remainingBalance;
          $payment->amount = $this->twoDecimal($input['amount']);
          $payment->save();

          DB::connection('tenant')->commit();
          return $this->responseMessage('success','Sales created!', new SalesObject($sales));
          }
        DB::connection('tenant')->rollback();
        return $this->responseMessage('rules','Campos requeridos',$validadorDetail->data);
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
    
       //Pagar la cuota de la venta
       public function payFee(Request $request){
        DB::connection('tenant')->beginTransaction();
        try {
          $input = $request->all();  
          $validador = SalesValidation::validateAttributesPayFee($input);
          if($validador->valid){
  
            $sales = Sales::find($input['idSale']);
    
            $payment = new Payment;
            $payment->idSale = $input['idSale'];
            $payment->currentBalance = $sales->remainingBalance;
            $payment->amount = $this->twoDecimal($input['amount']);
            $payment->remainingBalance = $this->twoDecimal((floatval($sales->remainingBalance) - floatval($input['amount'])));
            $sales->remainingBalance = $this->twoDecimal((floatval($sales->remainingBalance) - floatval($input['amount'])));
    
            if($sales->remainingBalance <= 0){
              $sales->status = 'pagado';
            }
    
            $payment->save();
            $sales->save();
    
            DB::connection('tenant')->commit();
    
            return $this->responseMessage('success','Pago agregado!', new SalesObject($sales));
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

    //Obtener todos los datos de un venta  mediante el identficador de la venta
    public function show($id)
    {
      $sales = Sales::select(
        'sales.idSale',
        'patients.idPatient',
        'patients.name',
        'patients.last_name',
        'sales.idDoctor',
        'user_admins.name as nameDoctor',
        'user_admins.last_name as lastNameDoctor',
        'consultories.idConsultory',
        'consultories.name as nameConsultorio',
        'sales.total',
        'sales.status',
        'sales.created_at as date',
        'sales.elements')
      ->join('patients','patients.idPatient','=','sales.idPatient')
      ->join('user_admins','user_admins.idUser','=','sales.idDoctor')
      ->join('consultories','consultories.idConsultory','=','sales.idConsultory')
      ->where('sales.idPatient','=',$id)
      ->get();

      if(is_null($sales))
        return $this->responseMessage('not_found','List de Sales!',"");
      return $this->responseMessage('success','List de Sales!',$sales);
    }

        //Obtener todos los datos de un venta (cabecera y cuerpo) mediante el identficador de la venta
    public function salesDetails($id)
    {
      $sales = Sales::select(
        'sales.idSale',
        'sales.idDoctor',
        'sales.idPatient',
        'sales.idConvention',
        'sales.idConsultory',
        'sales.total',
        'sales.status',
        'sales.remainingBalance',
        'sales.created_at as date',
        'patients.idPatient',
        'patients.name',
        'patients.last_name',
        'user_admins.name as nameDoctor',
        'user_admins.last_name as lastNameDoctor',
        'consultories.name as nameConsultorio',
        'sales.elements')
      ->join('patients','patients.idPatient','=','sales.idPatient')
      ->join('user_admins','user_admins.idUser','=','sales.idDoctor')
      ->join('consultories','consultories.idConsultory','=','sales.idConsultory')
      ->where('sales.idSale','=',$id)
      ->get();

      $salesDetail = SalesDetail::select(
        'sales_detail.idSaleDetail',
        'sales_detail.idSale',
        'sales_detail.idTreatment',
        'sales_detail.idMaterial',
        'sales_detail.amount',
        'sales_detail.price',
        'sales_detail.subTotal',
        'sales_detail.discount',
        'sales_detail.total',
        'treatments.name',
        'materials.name as materialName')
      ->join('sales','sales.idSale','=','sales_detail.idSale')
      ->join('treatments','treatments.idTreatment','=','sales_detail.idTreatment')
      ->leftJoin('materials','materials.idMaterial','=','sales_detail.idMaterial')
      ->where('sales.idSale','=',$id)
      ->get();
        
      if(is_null($salesDetail)||is_null($sales))
        return $this->responseMessage('not_found','List de Sales!',"");
      return $this->responseMessage('success','List de Sales!',SalesCollection::make($sales,$sales,$salesDetail));
    }


    public function view()
    {
      dd(\Auth::user()->getUserInfo());
      $user = \Auth::user()->getUserInfo();
   
      return view("test.test", ["user"=>$user]);

    }
}
