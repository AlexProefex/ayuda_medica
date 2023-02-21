<?php

namespace App\Http\Controllers;

//use App\Models\Inventory;
use App\Models\Product;
use App\Models\Kardex;
use App\Models\ProductConsultory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Product\ProductObject;
use App\Http\Resources\Product\ProductResource;
use App\Rules\InventoryValidation;
use Illuminate\Support\Facades\Log;
use App\Traits\ResponseMessageTrait;

class InventoryController extends BaseController
{

  use ResponseMessageTrait;
    //Listado de los productos y sus invtarios asociados
    public function index()
    {
      $product = Product::Select(
        'idProduct',
        'name',
        'brand',
        'unit')
      ->orderBy('updated_at', 'desc')
      ->orderBy('idProduct', 'desc')
      ->get();
      if(is_null($product))
        return $this->responseMessage('not_found','List de Inventory!',[]);
      return $this->responseMessage('success','List de Inventory!',ProductResource::collection($product));
    }

    //Registrar un nuevo producto y su inventario asociado
    public function store(Request $request)
    {
      DB::connection('tenant')->beginTransaction();
      try {
        $input = $request->all();  
        $validador = InventoryValidation::validateAttributes($input);
        if($validador->valid){

          $product = new Product;
          $product->name = trim($input['name']);
          $product->brand = $input['brand'];
          $product->status = 'activo';
          $product->unit = $input['unit'];
          $product->save();

          $consultories = json_decode($input['consultories'],true);

          foreach ($consultories as $consultory) {

            $productConsultory = new ProductConsultory;
            $productConsultory->idProduct = $product->idProduct;
            $productConsultory->idConsultory = $consultory['idConsultory'];
            $productConsultory->amount = $consultory['amount'];
            $productConsultory->save();

            $kardex = new Kardex;
            $kardex->idProduct = $product->idProduct;
            $kardex->stockCurrent = 0;
            $kardex->amount = $consultory['amount'];
            $kardex->stockRemaining = $consultory['amount'];
            $kardex->type = 'ingreso';
            $kardex->idUser = $input['idUserAuth'];
            $kardex->idConsultory = $consultory['idConsultory'];
            
            $kardex->save();
          }

          DB::connection('tenant')->commit();
          $res = $this->responseMessageBody('success','Inventory created!',new ProductObject($product));
        } else {
          DB::connection('tenant')->rollback();
          $res = $this->responseMessageBody('rules','Campos requeridos',$validador->data);
        }

    
      } catch(\Illuminate\Database\QueryException $e){
        DB::connection('tenant')->rollback();
        $res = $this->responseMessageBody('errorTransaction', 'Peticion fallida'.$e);
      } catch (\Exception $e) {
        DB::connection('tenant')->rollback();
        $res = $this->responseMessageBody('error', 'Ha ocurrido un error'.$e);
      } catch (\Throwable $e) {
        DB::connection('tenant')->rollback();
        $res = $this->responseMessageBody('generalError', 'Ups ha ocurrido un error inesperado'.$e);
      } finally{
        return $this->responseMessage($res->status,$res->title,$res->message);
      }
    }

    //Listado de todos los datos de un producto mediante su identificador
    public function show($id)
    {
      $product = Product::Select(
        'idProduct',
        'name',
        'brand',
        'unit')
      ->where('idProduct','=',$id)
      ->orderBy('updated_at', 'desc')
      ->orderBy('idProduct', 'desc')
      ->get();

      if(is_null($product))
        return $this->responseMessage('not_found','List de Inventory!',"");
      return $this->responseMessage('success','List de Inventory!',ProductObject::collection($product));
    }

    //Atualizar la cantidad del producto segun corresponda ingreso o salida
    public function update(Request $request,  $id)
    {
      DB::connection('tenant')->beginTransaction();
      try {
        $input = $request->all();  
        $validador = InventoryValidation::validateInvetoryUpdate($input);
        if($validador->valid){

          $consultories = json_decode($input['consultories'],true);

          foreach ($consultories as $consultory) {
    
            if($consultory['amount']!==0){
              $product = ProductConsultory::where('idProduct',$id)
              ->where('idConsultory',$consultory['idConsultory'])
              ->first();
              $kardex = new Kardex;
              $kardex->idProduct = $product->idProduct;
              $kardex->stockCurrent = $product->amount;
              $kardex->amount = $consultory['amount'];
              $kardex->stockRemaining = $this->CalcularStock($input['type'],$kardex->stockCurrent,$consultory['amount']);
              $kardex->type = $input['type'];
              $kardex->idUser = $input['idUserAuth'];
              $kardex->idConsultory = $consultory['idConsultory'];
        
              $kardex->save();

              $product->amount = $kardex->stockRemaining;
              $product->save();
            }
          }
          DB::connection('tenant')->commit();
          $res = $this->responseMessageBody('success','Invetory updated!',new ProductObject(Product::find($product->idProduct)));
        } else {
          DB::connection('tenant')->rollback();
          $res = $this->responseMessageBody('rules','Campos requeridos', $validador->data);
        }
      } catch(\Illuminate\Database\QueryException $e){
        DB::connection('tenant')->rollback();
        $res = $this->responseMessageBody('errorTransaction', 'Peticion fallida');
      } catch (\Exception $e) {
        DB::connection('tenant')->rollback();
        $res = $this->responseMessageBody('error', 'Ha ocurrido un error');
      } catch (\Throwable $e) {
        DB::connection('tenant')->rollback();
        $res = $this->responseMessageBody('generalError', 'Ups ha ocurrido un error inesperado');
      } finally{
        return $this->responseMessage($res->status,$res->title,$res->message);
      }

    }

    //Registrar un nuevo producto y su inventario asociado
    public function addConsultoryProduct(Request $request)
    {
      DB::connection('tenant')->beginTransaction();
      try {
          $input = $request->all();  
          $consultories = json_decode($input['consultories'],true);
          $validador = InventoryValidation::validateExistConsultory($consultories,$input['idProduct']);

          if($validador->valid){

            foreach ($consultories as $consultory) {
  
              $productConsultory = new ProductConsultory;
              $productConsultory->idProduct = $input['idProduct'];
              $productConsultory->idConsultory = $consultory['idConsultory'];
              $productConsultory->amount = $consultory['amount'];
              $productConsultory->save();
  
              $kardex = new Kardex;
              $kardex->idProduct = $input['idProduct'];
              $kardex->stockCurrent = 0;
              $kardex->amount = $consultory['amount'];
              $kardex->stockRemaining = $consultory['amount'];
              $kardex->type = 'ingreso';
              $kardex->idUser = $input['idUserAuth'];
              $kardex->idConsultory = $consultory['idConsultory'];
              $kardex->save();
  
            }
  
            DB::connection('tenant')->commit();
            $res = $this->responseMessageBody('success','Inventory created!',new ProductObject(Product::find($input['idProduct'])));
          } else {
            DB::connection('tenant')->rollback();
            $res = $this->responseMessageBody('rules','Campos requeridos', $validador->data);
          }
      } catch(\Illuminate\Database\QueryException $e){
        DB::connection('tenant')->rollback();
        $res = $this->responseMessageBody('errorTransaction', 'Peticion fallida');
      } catch (\Exception $e) {
        DB::connection('tenant')->rollback();
        $res = $this->responseMessageBody('error', 'Ha ocurrido un error');
      } catch (\Throwable $e) {
        DB::connection('tenant')->rollback();
        $res = $this->responseMessageBody('generalError', 'Ups ha ocurrido un error inesperado');
      } finally{
        return $this->responseMessage($res->status,$res->title,$res->message);
      }
    }

    //Calcular el nuevo stock del ingreso o salida
    public function CalcularStock($typo, $actual, $nuevo){
      if($typo == 'ingreso')
        return intval($actual) + intval($nuevo);
      return intval($actual) - intval($nuevo);
    }


}




//Log file Example
/*
public function update(Request $request,  $id)
{

  //$log = base_path().'/logs';

  DB::connection('tenant')->beginTransaction();
  try {
  $input = $request->all();  
  $validador = InventoryValidation::validateInvetoryUpdate($input);
  if($validador->valid){
  

    $consultories = json_decode($input['consultories'],true);

    foreach ($consultories as $consultory) {
      //$product = Product::find($id);
      if($consultory['amount']!==0){
        $product = ProductConsultory::where('idProduct',$id)
        ->where('idConsultory',$consultory['idConsultory'])
        ->first();
        $kardex = new Kardex;
        $kardex->idProduct = $product->idProduct;
        $kardex->stockCurrent = $product->amount;
        $kardex->amount = $consultory['amount'];
        $kardex->stockRemaining = $this->CalcularStock($input['type'],$kardex->stockCurrent,$consultory['amount']);
        $kardex->type = $input['type'];
        $kardex->idUser = $input['idUserAuth'];
        $kardex->idConsultory = $consultory['idConsultory'];
        $kardex->save();


        $product->amount = $kardex->stockRemaining;
        $product->save();

      }
      //Crear su propia tabla para almacenamiento por consultorio

    //  $product = Product::where('idProduct ',$id)
   ///   DB::raw('SUM(price) as total_sales')

      

    }





      $file = 'test.txt';

      if(!is_file($file)){
          $contents = 'This is a test!';           // Some simple example content.
          file_put_contents($file, $contents);     // Save our content to the file.
      }


    DB::connection('tenant')->commit();
 //   $productos='Product/product';
      Log::info('',['title'=>'Inventory',
                  'message'=>'Updated product: '.$product.' by User id: '.$input['idUser']]);

    Log::build([
      'driver' => 'single',
      'path' => storage_path('logs/'.$productos.'.log'),
    ])->info('Something happened!');
                  
                  
    //Log::channel('actions')->info('Updated product: '.$product.' by User id: '.$input['idUser']);
    // app('log')->channel('daily:product')->debug('Produt');
//FAlta esto
      return $this->responseMessage('success','Invetory updated!',new ProductObject(Product::find($product->idProduct)));
    }
    DB::connection('tenant')->rollback();
    return $this->responseMessage('rules','Campos requeridos', $validador->data);
  } catch (\Exception $e) {
    DB::connection('tenant')->rollback();
    return $this->responseMessage('errorTransaction', 'Ha ocurrido un error'.$e);
  } catch(\Illuminate\Database\QueryException $e){
    DB::connection('tenant')->rollback();
    return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado'.$e);
  }  
}

public function CalcularStock($typo, $actual, $nuevo){
  if($typo == 'ingreso')
    return intval($actual) + intval($nuevo);
  else
    return intval($actual) - intval($nuevo);
}
*/