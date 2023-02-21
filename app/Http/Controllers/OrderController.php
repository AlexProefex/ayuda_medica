<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDelivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Order\OrderObject;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\Order\OrderCollection;


class OrderController extends BaseController
{
    //Listad de todas las ordenes realizadas
    public function index()
    {
      $order = Order::all();
      if(is_null($order))
        return $this->responseMessage('not_found','List de Order!',[]);

      return $this->responseMessage('success','List de Order!',OrderResource::collection($order));
    }

  
    //Registro de nuevas ordenes 
    public function store(Request $request)
    {
    //    DB::connection('tenant')->beginTransaction();
        try {
          $input = $request->all();  
  //        $validador = OrderValidation::validateAttributes($input);
  
    //      if($validador[0]){
  
         /*   $validadorDetail = OrderValidation::validateDetails(json_decode($input['details'], true));
            if($validadorDetail[0]){
  */
            $order = new Order;
            $order->idLaboratory = $input['idLaboratory'];
            $order->idUser = $input['idUser'];
            $order->idConsultory = $input['idConsultory'];
            $order->dateDelivery = $input['dateDelivery'];
            $order->status = 'pendiente';
            $order->amountRequired = $input['amountRequired'];
            $order->amountReceived = 0;
            $order->idProduct = $input['idProduct'];
            $order->save();


/*
            $detailsOrder = json_decode($input['details'], true);
  
            foreach ($detailsOrder as $details) {
              $budgetDetail = new OrderDetail;
              $budgetDetail->idOrder = $order->idOrder;
              $budgetDetail->name = $details['name'];
              $budgetDetail->requiredAmount = $details['requiredAmount'];
              $budgetDetail->deliveryAmount = $details['deliveryAmount'];
              $budgetDetail->missingAmount = $details['missingAmount'];
              $budgetDetail->save();
            }
  */
      //      DB::connection('tenant')->commit();
            return $this->responseMessage('success','Order created!', new OrderObject($order));
       //     }
        //  DB::connection('tenant')->rollback();
      //    return $this->responseMessage('rules','Campos requeridos',$validadorDetail[1]);
       //   } 
         // DB::connection('tenant')->rollback();
      //    return $this->responseMessage('rules','Campos requeridos',$validador[1]);
        } catch (\Exception $e) {
        //  DB::connection('tenant')->rollback();
          return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
        } catch(\Illuminate\Database\QueryException $e){
        //  DB::connection('tenant')->rollback();
          return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado');
        }
  
    }

    //Listado de ordenes pertenecientes a un laboratorio
    public function show($id)
    {
      $order = Order::Select('orders.*','laboratories.business','consultories.name as nameConsultory', 'user_admins.name as nameUser','user_admins.last_name as lastnameUser')
      ->join('consultories','consultories.idConsultory','=','orders.idConsultory')
      ->join('laboratories','laboratories.idLaboratory','=','orders.idLaboratory')
      ->join('user_admins','user_admins.idUser','=','orders.idUser')
      ->where('orders.idLaboratory','=',$id)
      ->get();

      return $order;

      if(is_null($order))
        return $this->responseMessage('not_found','List de Order!',"");

      return $this->responseMessage('success','List de Order!',OrderCollection::make($order));
    }

    //Actualizacion de las entregas realizadas a una determinada orden
    public function update(Request $request, $id)
    {
      DB::connection('tenant')->beginTransaction();
      try {

        $input = $request->all();  

        //$data =explode("-", $id);
        
        $idOrder = $id;
        //$idUser = $input['idUser'];

        $order = Order::find($idOrder);
        $order->status = $input['status'];
        $order->amountReceived = intval($order->amountReceived) + intval($input['amountDelivery']);
        $order->save();

        $orderDelivery = new OrderDelivery;

        $orderDelivery->idOrder = $idOrder;
        $orderDelivery->requiredAmount = $order->amountRequired;
        $orderDelivery->deliveryAmount = $input['amountDelivery'];

        $orderDelivery->missingAmount = intval($order->amountRequired) - intval($order->amountReceived);
        $orderDelivery->idUSer = $input['idUser'];
        $orderDelivery->save();

        DB::connection('tenant')->commit();

        return $this->responseMessage('success','Order updated!', new OrderObject($order));
      } catch (\Exception $e) {
        DB::connection('tenant')->rollback();
        return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
      } catch(\Illuminate\Database\QueryException $e){
       DB::connection('tenant')->rollback();
        return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado');
      }
    }


}
