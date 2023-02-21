<?php

namespace App\Rules;
use Validator;
use Illuminate\Contracts\Validation\Rule;

class ConsultoryValidation implements Rule
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

    //Validacion general para los campos necesarios para el registro de consultorios
    public static  function validateAttributes($data){

      $res = app()->make('stdClass');
      $res->valid = true;
      
      $rules = [
        'name' => 'required',
        'idManager' => 'required|numeric',
        'start_time' => 'required',
        'end_time' => 'required',
        'idConsultory' => 'required',
      ];
      
      $messages=[
        'name.required' => 'El nombre del Consulorio es requerido',
        'idManager.required '=> 'El nombre del encargado es requerido',
        'idManager.numeric' => 'El nombre del encargado es requerido',
        'start_time.required' => 'La hora de aprtura es requerida',
        'end_time.required' => 'La hora de cierre es requerida',
        'idConsultory.required' => 'El consultorio es requerido',
      ];

      $validator = Validator::make( $data, $rules, $messages );

      if ($validator->fails()) {
        $res->valid = false;
        $res->data = $validator->errors(); 
      }
      return $res;
    }
}
