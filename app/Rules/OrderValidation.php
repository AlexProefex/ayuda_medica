<?php

namespace App\Rules;

use Validator;
use Illuminate\Contracts\Validation\Rule;

class OrderValidation implements Rule
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
/*
        $rules = [
            'idLaboratory' => 'required|numeric',
            'idUser' => 'required|numeric',
            'idConsultory' => 'required|numeric',
            'dateDelivery' =>  ['date_format:Y-m-d'],
        ];
  
        $messages=[
  
            'idLaboratory.required'=>'El doctor es requerido',
            'idUser.required'=>'El paciente es requerido',
            'idConsultory.required'=>'El convenio es requerido',
      

            'idLaboratory.numeric'=>'El total es requerido',
            'idUser.numeric'=>'El total debe ser un numero',
            'idConsultory.numeric'=>'El total debe ser un numero con dos decimales',
            

          
        ];
  
        $validator = Validator::make( $data, $rules, $messages );
  
        if ($validator->fails()) {
            return [false,$validator->errors()];
        }
  
        return [true,"exito"=>true];
  */
      }

    public static  function validateDetails($data){
/*
        $rules = [
         'idTreatment' => 'required',
         'amount' => 'required|numeric',
         'price' => 'required|numeric',
         'discount' => 'numeric|required'
     ];
 
       $messages=[
         'idTreatment.required'=>'El tratamiento es requerido',
         'amount.required'=>'La cantidad es requerido',
         'amount.numeric'=>'La cantidad debe ser un numero',
         'price.required'=>'El precio es requerido',
         'price.numeric'=>'El precio debe ser un numero',
         'discount.numeric'=>'El descuento debe ser un numero',
         'discount.required'=>'El descuento es requerida',
       ];
 
   
       foreach ($data as $details) {
 
         $validator = Validator::make( $details, $rules, $messages );
 
         if ($validator->fails()) {
       
             return [false,$validator->errors()];
         }
 
       }
 
       return [true,"exito"=>true];
 */
    }
 
}
