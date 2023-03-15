<?php

namespace App\Rules;

use Validator;
use Illuminate\Contracts\Validation\Rule;

class AppointmentValidation implements Rule
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

    //Validacion general para los campos necesarios para el registro y actualizacion de citas medicas
    public static  function validateAttributes($data, $validate = true){

      $res = app()->make('stdClass');
      $res->valid = true;

      $rules = [
        'idCategory' => 'required|numeric',
        'location' => 'required',
        'idDoctor' => 'required|numeric',
        'idPatient' => 'required|numeric',
        'idSpecialty' => 'required|numeric',
        'date' =>  ['date_format:Y-m-d','after:yesterday'],
        'time' => 'required'
      ];

      $messages=[
        'idCategory.required' => 'La categoria es requerido',
        'location.required' => 'La ubicacion es requerido',
        'idDoctor.required' => 'El doctor es requerido',
        'idPatient.required' => 'El paciente es requerido',
        'idSpecialty.required' => 'La especialidad es requerido',
        'idCategory.numeric' => 'La categoria debe ser numerico',
        'idDoctor.numeric' => 'El codigo del doctor debe ser numerico',
        'idPatient.numeric' => 'El codigo del paciente debe ser numerico',
        'time.required' => 'La hora es requerido',
        'date.date_format' => 'La fecha debe tener el formato YYYY-MM-DD',
        'date.after' => 'La fecha no puede ser anterior a la de hoy'
      ];

      if(!$validate){
        $rules =  array_merge($rules, array("status" => "required"));
        $messages =  array_merge($messages, array("status.required" => "El estado de la cita medica es requerido"));
      }

      $validator = Validator::make( $data, $rules, $messages );

      if ($validator->fails()) {
        $res->valid = false;
        $res->data = $validator->errors(); 
      }

      return $res;
    }



    public static  function validateStatus($data){

      $res = app()->make('stdClass');
      $res->valid = true;

      $rules = [
        'status' => 'required',
      ];

      $messages=[
        'status.required' => 'El estado es requerido',

      ];

      $validator = Validator::make( $data, $rules, $messages );

      if ($validator->fails()) {
        $res->valid = false;
        $res->data = $validator->errors(); 
      }

      return $res;
    }
}
