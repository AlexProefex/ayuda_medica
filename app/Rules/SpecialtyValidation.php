<?php

namespace App\Rules;

use Validator;
use Illuminate\Contracts\Validation\Rule;

class SpecialtyValidation implements Rule
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
        $res = app()->make('stdClass');
        $res->valid = true;
  
        $rules = [
          'name' => 'required',
          'idCategory' => 'required',
          'duration' => 'required',
          'description' => 'required'
        ];
  
        $messages=[
          'name.required' => 'El nombre del servicio es requerido',
          'idCategory.required' => 'El nombre de la categoria es requerido',
          'duration.required' => 'El tiempo de duracion es requerido',
          'description.required' => 'La descripcion es requerido',
        ];
  
        $validator = Validator::make( $data, $rules, $messages );
     
        if ($validator->fails()) {
          $res->valid = false;
          $res->data = $validator->errors(); 
        }
        return $res;
    }
}
