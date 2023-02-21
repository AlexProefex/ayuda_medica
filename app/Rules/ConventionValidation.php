<?php

namespace App\Rules;
use Validator;
use Illuminate\Contracts\Validation\Rule;

class ConventionValidation implements Rule
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

    //Validacion general para los campos necesarios para el registro de convenios
    public static  function validateAttributes($data,$check){

      $res = app()->make('stdClass');
      $res->valid = true;

      $rules = [
        'name' => 'required',
        'company_name' => 'required',
      ];
      
      $messages=[
        'name.required' => 'El nombre del convenio es requerido',
        'company_name.required' => 'El nombre de la empresa es requerido',
      ];

      if(!$check){
         $rules = array_merge($rules, array("status" => "required"));
         $messages = array_merge($messages, array("status.required" => "El estado es requerido"));
      }

      $validator = Validator::make( $data, $rules, $messages );

      if ($validator->fails()) {
        $res->valid = false;
        $res->data = $validator->errors(); 
      }
      return $res;

    }

    //Validacion general para los campos requeridos para el registro del descuento perteneciente a un convenio
    public static  function validateDisscount($data){

      $res = app()->make('stdClass');
      $res->valid = true;

      $rules = [
        'discount' => 'required',
      ];
      
      $messages=[
        'discount.required' => 'El descuento es requerido',
      ];

      $validator = Validator::make( $data, $rules, $messages );

      if ($validator->fails()) {
        $res->valid = false;
        $res->data = $validator->errors(); 
      }
      return $res;
    }
}
