<?php

namespace App\Rules;
use Validator;
use Illuminate\Contracts\Validation\Rule;

class SalesValidation implements Rule
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

    //Validacion general para los campos necesarios para el registro de una venta
    public static  function validateAttributes($data){

      $res = app()->make('stdClass');
      $res->valid = true;

      $rules = [
          'idDoctor' => 'required',
          'idPatient' => 'required',
          'idConvention' => 'required',
          'idConsultory' =>  'required',
          'total' => ['regex:/^(\d*\.\d{2})?$/','required','numeric'],
          'amount' => 'required|numeric',
          'details' => 'required',
      ];

      $messages=[
          'idDoctor.required'=>'El doctor es requerido',
          'idPatient.required'=>'El paciente es requerido',
          'idConvention.required'=>'El convenio es requerido',
          'idConsultory.required'=>'El consultorio es requerido',
          'total.required'=>'El total es requerido',
          'total.numeric'=>'El total debe ser un numero',
          'total.regex'=>'El total debe ser un numero con dos decimales',
          'amount.required'=>'La cantidad es requerido',
          'amount.numeric'=>'La cantidad debe ser un numero',
          'details.required'=>'Debe haber al menos 1 tratamiento seleccionado',
      ];

      $validator = Validator::make( $data, $rules, $messages );

      if ($validator->fails()) {
        $res->valid = false;
        $res->data = $validator->errors(); 
      }

      return $res;

    }

    //Validacion para el pago de una cuota de una venta realizada
    public static  function validateAttributesPayFee($data){

      $res = app()->make('stdClass');
      $res->valid = true;

      $rules = [
        'idSale' => 'required',
        'amount' => 'required|numeric',
      ];

      $messages=[
        'idSale.required'=>'El numero de venta es requerido',
        'amount.required'=>'La cantidad es requerido',
        'amount.numeric'=>'La cantidad debe ser un numero',
      ];

      $validator = Validator::make( $data, $rules, $messages );

      if ($validator->fails()) {
        $res->valid = false;
        $res->data = $validator->errors(); 
      }

      return $res;

    }

    //Validacion de los detalles de ventas realizadas
    public static  function validateDetails($data){

      $res = app()->make('stdClass');
      $res->valid = true;

       $rules = [
        'idTreatment' => 'required',
        'amount' => 'required|numeric',
        'price' => 'required|numeric',
        'discount' => 'numeric|required'
    ];

      $messages=[
        'idTreatment.required'=>'El tratamiento es requerido',
        'amount.required'=>'La cantidad es requerido',
        'amount.numeric'=>'La cantidad debe ser un numero',
        'price.required'=>'El precio es requerido',
        'price.numeric'=>'El precio debe ser un numero',
        'discount.numeric'=>'El descuento debe ser un numero',
        'discount.required'=>'El descuento es requerida',
      ];

  
      foreach ($data as $details) {

        $validator = Validator::make( $details, $rules, $messages );

        if ($validator->stopOnFirstFailure()->fails()) {
          $res->valid = false;
          $res->data = $validator->errors(); 
          return $res;
        }
      }

      return $res;

    }

    //Validacion del precio enviado y el precio calculado sea igual
    public static function validatePrices($priceCalculate,$priceSend){
      if($priceCalculate != $priceSend)
        return true;
      return false;
    }

}
