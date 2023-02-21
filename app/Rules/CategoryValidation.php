<?php

namespace App\Rules;

use Validator;
use Illuminate\Contracts\Validation\Rule;

class CategoryValidation implements Rule
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
          'name' => 'required'
        ];
  
        $messages=[
          'name.required' => 'El nombre de la categoria es requerido',
        ];
  
        $validator = Validator::make( $data, $rules, $messages );
     
        if ($validator->fails()) {
          $res->valid = false;
          $res->data = $validator->errors(); 
        }
        return $res;
    }
}
