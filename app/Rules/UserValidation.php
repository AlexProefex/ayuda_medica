<?php

namespace App\Rules;

use Validator;
use Illuminate\Contracts\Validation\Rule;

class UserValidation implements Rule
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

    //Validacion general para los campos necesarios para el registro de Usuarios
    public static function validateAttributes($data, $email, $document_number, $state = false, $password = false ){

      $res = app()->make('stdClass');
      $res->valid = true;

      $rules = [
        'name' => 'required',
        'last_name' => 'required',
        'phone_number' => 'required|numeric',
        'idRol' => 'required|numeric',
        'date' => ['date_format:Y-m-d'],
        'nColegiatura' => 'required',
        'idCategory' => 'required',



      ];

      $messages=[
        'name.required' => 'El nombre es requerido',
        'last_name.required' => 'El apellido es requerido',
        'phone_number.required' => 'El numero de telefono es requerido',
        'phone_number.numeric' => 'El numero de telefono debe ser numerico',
        'date.date_format' => 'La fecha debe tener el formato YYYY-MM-DD',
        'email.email' => 'El correo electronico  debe tener formato example@domain.com',
        'email.required' => 'El correo electronico  es requerido',
        'document_number.required' => 'El numero de documento es requerido',
        'document_number.numeric' => 'El numero de documento debe ser numerico',
        'idRol.required' => 'El rol es requerido',
        'idRol.required' => 'El id debe ser de tipo numerico',
        'nColegiatura.required' => 'El numero de colegiatura es requerido',
        'idCategory.required' => 'El id de categoria es requerido',
      ];
        
      if($email){
        $rules = array_merge($rules, array("email" => "required|email"));
      }
      else{
        $rules = array_merge($rules, array("email" => "required|email|unique:App\Models\UserAdmin,email"));
      }

      if($document_number)
      {
          $rules = array_merge($rules, array("document_number" => "required|numeric"));
      }
      else{
          $rules = array_merge($rules, array("document_number" => "required|numeric|unique:App\Models\UserAdmin,document_number"));
      }

      if($email == false){
        $messages = array_merge($messages, array("email.unique" => "El correo electronico ya existe"));
      }
      if($document_number == false){
        $messages = array_merge($messages, array("document_number.unique" => "El numero de documento ya existe"));
      }

      if($state){
            $rules = array_merge($rules, array("state" => "required"));
            $messages = array_merge($messages, array("state.required" => "El estado del usuario es obligatorio"));
      }

      if($password){
        $rules = array_merge($rules, array("password" => "required"));
        $messages = array_merge($messages, array("password.required" => "El password es requerido"));
      }

      

      $validator = Validator::make( $data, $rules, $messages );
      if ($validator->fails()) {
          $res->valid = false;
          $res->data = $validator->errors(); 
      }

      return $res;
    }





    public static function validateSchedule($data){

      $res = app()->make('stdClass');
      $res->valid = true;

      $rules = [
        'schedule' => 'required',
      ];

      $messages=[
        'schedule.required' => 'El horario es requerido',
      ];
        
      $validator = Validator::make( $data, $rules, $messages );
      if ($validator->fails()) {
          $res->valid = false;
          $res->data = $validator->errors(); 
      }

      return $res;
    }
}

