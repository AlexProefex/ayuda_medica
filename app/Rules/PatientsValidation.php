<?php

namespace App\Rules;
use Validator;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
class PatientsValidation implements Rule
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

    //Validacion general para los campos necesarios para el registro y actualizacion de un paciente
    public static  function validateAttributes($data,$email,$document_number){
      $res = app()->make('stdClass');
      $res->valid = true;

      $rules = [
        'name' => 'required',
        'last_name' => 'required',
        'birthdate' => ['date_format:Y-m-d'],'before:today',
        'document_type' => 'required',
        'phone_number' => 'required|numeric',
        'email' => 'email|required'
    

      ];

      $messages=[
        'name.required'=>'El nombre es requerido',
        'last_name.required'=>'El apellido es requerido',
        'document_type.required'=>'El tipo de documento es requerido',
        'birthdate.date_format'=>'La fecha debe tener el formato YYYY-MM-DD',
        'document_number.numeric'=>'El numero de documento debe ser numerico',
        'document_number.required'=>'El numero de documento es requerido',
        'birthdate.before' => 'La fecha de nacimiento debe ser anterior a la fecha actual',
        'phone_number.required' => 'El numero de telefono es requerido',
        'phone_number.numeric' => 'El numero de telefono debe ser numerico',
        'email.email' => 'El correo electronico debe tener formato example@domain.com',
        'email.required' => 'El correo electronico es requerido'
      
      ];


   
      if($document_number)
      {
        $rules = array_merge($rules, array('document_number' => 'required|numeric'));
      }
      else{
        $rules = array_merge($rules, array('document_number' => 'required|numeric|unique:App\Models\Patients,document_number'));

      }

      if($document_number==false){
        $messages = array_merge($messages, array('document_number.unique' => 'El numero de documento ya existe'));
      }


      $validator = Validator::make( $data, $rules, $messages );

      if ($validator->fails()) {
        $res->valid = false;
        $res->data = $validator->errors(); 
      }
      return $res;

    }
}
    


