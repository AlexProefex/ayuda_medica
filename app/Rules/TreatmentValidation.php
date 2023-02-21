<?php

namespace App\Rules;
use Validator;
use Illuminate\Contracts\Validation\Rule;

class TreatmentValidation implements Rule
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

    //Validacion general para los campos necesarios para el registro de tratamientos
    public static function validateAttributes($data){

      $res = app()->make('stdClass');
      $res->valid = true;

      $rules = [
          'name' => 'required',
          'price' => 'required|numeric',
          'hasMaterial' => 'required',
          'consultories' => 'required', 
      ];
      $messages=[
          'name.required' => 'El nombre del tratamiento es requerido',
          'price.required' => 'El precio del producto es requerido',
          'hasMaterial.required' => 'Se debe especificar si contiene material',
          'price.numeric' => 'El precio debe ser numerico',
          'consultories.required'=> 'Debe seleccionar por lo menos un consulrio',
      ];

      $validator = Validator::make( $data, $rules, $messages );

      if ($validator->fails()) {
          return [false,$validator->errors()];
      }

      if ($validator->fails()) {
        $res->valid = false;
        $res->data = $validator->errors(); 
      }
      return $res;
     
    }

    //Validacion de que exista al menos un tratamiento valido para su registro
    public static  function validateJSon($data){
      $res = app()->make('stdClass');
      $res->valid = true;

      $rules = [
          'treatments' => 'required',
      ];
      $messages=[
          'treatments.required' => 'El campo tratamiento no puede estar vacio',
      ];

      $validator = Validator::make( $data, $rules, $messages );

      if ($validator->fails()) {
        $res->valid = false;
        $res->data = $validator->errors(); 
      }
      return $res;
    }

}
