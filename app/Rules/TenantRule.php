<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Validator;

class TenantRule implements Rule
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
          'name' => 'required|unique:App\Models\Tenant,name',
          'domain' => 'required|unique:App\Models\Tenant,domain',
        ];
  
        $messages=[
          'name.required'=>'El nombre de la compañia es requerido',
          'name.unique'=>'El nombre ingresado ya se encuentra registrado',
          'domain.required'=>'El dominio de la compañia es requerido',
          'domain.unique'=>'El dominio ingresado ya se encuentra registrado',
        ];

        $validator = Validator::make( $data, $rules, $messages );
  
        if ($validator->fails()) {
          $res->valid = false;
          $res->data = $validator->errors(); 
        }

        return $res;
  
      }
}
