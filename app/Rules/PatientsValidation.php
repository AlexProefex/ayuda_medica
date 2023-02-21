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
        'password' => 'required',

      ];

      $messages=[
        'name.required'=>'El nombre es requerido',
        'last_name.required'=>'El apellido es requerido',
        'document_type.required'=>'El tipo de documento es requerido',
        'birthdate.date_format'=>'La fecha debe tener el formato YYYY-MM-DD',
        'document_number.numeric'=>'El numero de documento debe ser numerico',
        'birthdate.before' => 'La fecha de nacimiento debe ser anterior a la fecha actual',
        'phone_number.required' => 'El numero de telefono es requerido',
        'phone_number.numeric' => 'El numero de telefono debe ser numerico',
        'password.required' => 'El password es requerido',
      ];


      if(array_key_exists('email',$data)){
        $rules =  array_merge($rules, array("email" => "email|required"));
        $messages =  array_merge($messages, array("email.email" => "El correo electronico debe tener formato example@domain.com"));
        $messages =  array_merge($messages, array("email.email" => "El correo electronico es requerido"));
      }

      /*if(array_key_exists('phone_number',$data)){
        $rules =  array_merge($rules, array("phone_number" => "numeric"));
        $messages =  array_merge($messages, array("phone_number.numeric" => "El telefono solo acepta campos numericos"));
      }*/

      //if(!array_key_exists('email',$data) && !array_key_exists('phone_number',$data)){
      //  $rules =  array_merge($rules, array("email" => "required"));
      //  $messages =  array_merge($messages, array("email.required" => "Se requiere ingresar al menos un medio de contacto correo electronico o telefono"));
      //}
   
      if($document_number)
      {
        $rules = array_merge($rules, array("document_number" => "numeric"));
      }
      else{
        $rules = array_merge($rules, array("document_number" => "required|numeric|unique:App\Models\Patients,document_number"));

      }

      if($document_number==false){
        $messages = array_merge($messages, array("document_number.unique" => "El numero de documento ya existe"));
      }

      /*if(intval($data['edad'])<18){
        $rules = array_merge($rules, array("tutorName" => "required"));
        $rules = array_merge($rules, array("tutorLastName" => "required"));
        $rules = array_merge($rules, array("relationship" => "required"));

        $messages = array_merge($messages, array("tutorName.required" => "El nombre de tutor es requerido"));
        $messages = array_merge($messages, array("tutorLastName.required" => "El apellido del tutor es requerido"));
        $messages = array_merge($messages, array("relationship.required" => "El parentesco es requerido"));
      }*/

      $validator = Validator::make( $data, $rules, $messages );

      if ($validator->fails()) {
        $res->valid = false;
        $res->data = $validator->errors(); 
      }
      return $res;

    }
}
    


