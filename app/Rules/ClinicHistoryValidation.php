<?php

namespace App\Rules;
use Validator;
use Illuminate\Contracts\Validation\Rule;

class ClinicHistoryValidation implements Rule
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
    
    //Validacion general para los campos necesarios para el registro de historias clinicas
    public static  function validateAttributes($data){
      $res = app()->make('stdClass');
      $res->valid = true;

      $rules = [
        'idDoctor' => 'required|numeric',
        //'idConsultory' => 'required|numeric',
        'idPatient' => 'required|numeric'
      ];

      $messages=[
        'idDoctor.required' => 'El doctor  es requerido',
        'idDoctor.numeric' => 'El codigo del doctor debe ser numerico',
        //'idConsultory.required' => 'El consultorio  es requerido',
        //'idConsultory.numeric' => 'El codigo del consultorio debe ser numerico',
        'idPatient.required' => 'El paciente  es requerido',
        'idPatient.numeric' => 'El codigo del paciente debe ser numerico',
      ];

      $validator = Validator::make( $data, $rules, $messages );
   
      if ($validator->fails()) {
        $res->valid = false;
        $res->data = $validator->errors(); 
      }
      return $res;
    }
}
