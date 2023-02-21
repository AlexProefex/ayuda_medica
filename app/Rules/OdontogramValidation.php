<?php

namespace App\Rules;

use Validator;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;
class OdontogramValidation implements Rule
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

    //Validacion general para los campos necesarios para el registro de un odontograma
    public static  function validateAttributes($data){

      $res = app()->make('stdClass');
      $res->valid = true;
      
      $rules = [
        'idPatient' => 'required',
        'dataOdontogram' => 'required',
        'date' =>  ['date_format:Y-m-d','required','date_equals:'.Carbon::now()->toDateString()],
        'dateOdontogram' =>  ['unique:App\Models\Odontogram,dateOdontogram'],
      ];

      $messages = [
        'idPatient.required'=>'El paciente es requerido',
        'dataOdontogram.required'=>'El odontograma no púede estar vacio',
        'date.required'=>'La fecha es requerida',
        'date.date_equals'=>'La fecha del dispositvo no corresponde a la fecha actual',
        'date.date_format'=>'La fecha debe tener el formato YYYY-MM-DD',
        'dateOdontogram.unique' => 'No se pude crear mas de un Odontograma en el mismo dia'
      ];

      $data['dateOdontogram'] = $data['date'].'-'.$data['idPatient'];
  
      $validator = Validator::make( $data, $rules, $messages );
  
      if ($validator->fails()) {
          $res->valid = false;
          $res->data = $validator->errors(); 
      }

      return $res;
    }
}

