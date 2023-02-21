<?php

namespace App\Rules;

use Validator;
use Illuminate\Contracts\Validation\Rule;

class ExpensesValidation implements Rule
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

    public static  function validateAttributes($data){
        /*$rules = [
            'business' => 'required',
            'name' => 'required',
            'email' => 'required|email'
        ];
  
        $messages=[
            'business.required'=>'El nombre de la Empresa es requerido',
            'name.required'=>'El nombre del Contacto es requerido',
            'email.required'=>'El correo electronico  es requerido',
            'email'=>'El correo electronico debe tener formato example@domain.com',
        ];
  
        $validator = Validator::make( $data, $rules, $messages );
  
        if ($validator->fails()) {
            return [false,$validator->errors()];
        }*/
  
        return [true,"exito"=>true];
      }
}
