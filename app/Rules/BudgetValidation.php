<?php

namespace App\Rules;
use Validator;
use Illuminate\Contracts\Validation\Rule;

class BudgetValidation implements Rule
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

    //Validacion general para los campos necesarios para el registro de presupuestos
    public static  function validateAttributes($data){
      $res = app()->make('stdClass');
      $res->valid = true;

      $rules = [
        'idDoctor' => 'required|numeric',
        'idPatient' => 'required|numeric',
        'idConvention' => 'required|numeric',
        'idConsultory' =>  'required|numeric',
        'total' => ['regex:/^(\d*\.\d{2})?$/','required','numeric'],
        'details' => 'required',
        'elements' => 'required'
      ];

      $messages=[
        'idDoctor.required' => 'El doctor es requerido',
        'idPatient.required' => 'El paciente es requerido',
        'idConvention.required' => 'El convenio es requerido',
        'idConsultory.required' => 'El consultorio es requerido',
        'idDoctor.numeric' => 'El codigo del doctor debe ser numerico',
        'idPatient.numeric' => 'El codigo del paciente debe ser numerico',
        'idConvention.numeric' => 'El codigo del covenio debe ser numerico',
        'idConsultory.numeric' => 'El codigo del consultorio debe ser numerico',
        'total.required' => 'El total es requerido',
        'total.numeric' => 'El total debe ser numerico',
        'total.regex' => 'El total debe ser un numero con dos decimales',
        'details.required' => 'Debe haber al menos 1 tratamiento seleccionado',
        'elements.required' => 'El formato de la tabla es requerido',
      ];

      $validator = Validator::make( $data, $rules, $messages );

      if ($validator->fails()) {
        $res->valid = false;
        $res->data = $validator->errors(); 
      }

      if($res->valid){
        if(count($data) === 0){
          $res->valid = false;
          $res->data = ["message" => "Debe exitir al menos un tratamiento seleccionado"]; 
        }else{
          $details = json_decode($data['details'], true);
          $res = BudgetValidation::validateDetails($details);
        }
      }
      return $res;
    }

    //Validacion de los datos correspondientes al detalle de un presupuesto
    public static  function validateDetails($data){
      try {
        $res = app()->make('stdClass');
        $res->valid = true;
  
        $rules = [
          'idTreatment' => 'required|numeric',
          'amount' => 'required|numeric',
          'price' => 'required|numeric',
          'discount' => 'numeric|required'
        ];
  
        $messages=[
          'idTreatment.required'=>'El tratamiento es requerido',
          'idTreatment.required'=>'El codigo del tratamiento es numerico',
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
      }catch(\Throwable  $e) {
        $res->valid = false;
        $res->data = ["message" => "verifica el formato de los campos enviados"]; 
      } finally {
        return $res;
      }
    }

    //VAlidacion que el precio calculado y el precio enviado sea igual
    public static function validatePrices($priceCalculate,$priceSend){
      if($priceCalculate != $priceSend)
        return true;
      return false;
    }
       
}
