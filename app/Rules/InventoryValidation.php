<?php

namespace App\Rules;

use Validator;
use Illuminate\Contracts\Validation\Rule;
use App\Models\ProductConsultory;

class InventoryValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public function __construct()
    {
        //
   
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }

    //Validacion general de los campos requeridos para el registro de un inventario
    public static  function validateAttributes($data){
      $res = app()->make('stdClass');
      $res->valid = true;

      $rules = [
        'name' => 'required|unique:App\Models\Product,name',
        'brand' => 'required',
        'unit' => 'required',
        'idUserAuth' => 'required',
        'consultories' => 'required'
      ];
      
      $messages=[
        'name.required'=>'El nombre del producto es requerido',
        'brand.required'=>'El nombre de la marca es requerido',
        'unit.required'=>'La unidad es requerido',
        'idUserAuth.required'=>'El usuario es requerido',
        'name.unique' => 'Ya existe un producto con ese nombre',
        'consultories.required' => 'Debe seleccionar por lo menos un consultorio'
      ];

      $validator = Validator::make( $data, $rules, $messages );

      if ($validator->fails()) {
        $res->valid = false;
        $res->data = $validator->errors(); 
      }
      //Valida los Atributos internos del consultorio
      if($res->valid){
        $consultories = json_decode($data['consultories'],true);
        $res = InventoryValidation::validateConsultoryAmount($consultories);
      }
      return $res;
    }

    //VAlidacion de los campos requeridos para la actualizacion de un nuevo inventario 
    public static  function validateInvetoryUpdate($data){
      $update = false;
      $res = app()->make('stdClass');
      $res->valid = true;

      $rules = [
        'consultories' => 'required',
        'type' => 'required',
        'idUserAuth' => 'required'
      ];
        
      $messages=[
        'consultories.required' => 'Debe seleccionar por lo menos un consultorio',
        'type.required' => 'El tipo de movimiento es requerido',
        'idUserAuth.required' => 'El usuario es requerido',
      ];
  
      $validator = Validator::make( $data, $rules, $messages );

      if ($validator->fails()) {
        $res->valid = false;
        $res->data = $validator->errors(); 
      }

      if($res->valid){
        $consultories = json_decode($data['consultories'],true);
        $res = InventoryValidation::validateConsultoryAmount($consultories);

        if($res->valid){

            foreach ($consultories as $consultory) {
       
              if($consultory['amount']!==0){
                $update = true;
              }
                
          }

          if(!$update){
            $res->valid = false;
            $res->data = ["message" => "No existen elementos para actualizar"]; 
          }

        }
      }
      return $res;
    }

    //Validacion de los items enviados en el apartado consultories
    public static  function validateConsultoryAmount($data){
      $res = app()->make('stdClass');
   
      try {
        $res->valid = true;

        $rules = [
            'idConsultory' => 'required|numeric',
            'amount' => 'required|numeric'
        ];
        
        $messages=[
            'idConsultory.required' => 'Debe existir un consultorio seleccionado',
            'idConsultory.numeric' => 'El campo consultorio debe ser numerico',
            'amount.required' => 'La cantidad es obligatoria',
            'amount.numeric' => 'La cantidad debe ser numerica',
        ];
        
        if(count($data) !== 0){
     
          foreach ($data as $consultory) {
       
            $validator = Validator::make( $consultory, $rules, $messages );
      
            if ($validator->stopOnFirstFailure()->fails()) {
                $res->valid = false;
                $res->data = $validator->errors(); 
                return $res;
            }
              
          }
     
        }
        else{
          $res->valid = false;
          $res->data = ["message" => "Debe seleccionar un consultorio"]; 
        }


      
      } catch (\Exception $e) {
        $res->valid = false;
        $res->data = ["message" => "verifica el formato de los campos enviados"]; 
      } catch(\Throwable  $e) {
        $res->valid = false;
        $res->data = ["message" => "verifica el formato de los campos enviados"]; 
      } finally {
        
        return $res;
      }
    }

    //Valida si el producto ya cuenta con el consultorio registrado
    public static function validateExistConsultory($data,$idProduct){
      $res = app()->make('stdClass');
      try {
        $res->valid = true;
        
        $res = InventoryValidation::validateConsultoryAmount($data);

        if($res->valid){
        
          foreach ($data as $consultory) {
            $productConsultory = ProductConsultory::where('idConsultory',$consultory['idConsultory'])
            ->where('idProduct',$idProduct)
            ->first();

            if($productConsultory){
              $res->valid = false;
              $res->data = ["errors" => "Ya existe el producto en el consultorio seleccionado"]; 
              return $res;
            }
          }
       }

      } catch (\Exception $e) {
        $res->valid = false;
        $res->data = ["message" => "verifica el formato de los campos enviados"]; 
 
      } catch(\Throwable  $e) {
        $res->valid = false;
        $res->data = ["message" => "verifica el formato de los campos enviados"]; 
        
      } finally {
        return $res;
      }
    }
    
  
}

