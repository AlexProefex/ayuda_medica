<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Traits\CheckDatabase;
use Illuminate\Support\Facades\DB;

use App\Rules\TenantRule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserAdminsController;


class TenantController extends BaseController
{
    use CheckDatabase;



    public function check(Request $request)
    {
      try{
        $input = $request->all();  
        $tenant = Tenant::where('domain',$input['domain'])
        ->first();
        if(is_null($tenant))
          return $this->responseMessage('success','Dominio',false);
        //return redirect('api/login');
        return redirect()->route('api/login');

      } catch (\Throwable $e) {
        return $this->responseMessage('error', 'Ha ocurrido un error'.$e);
      }

      //return redirect()->route('api/login');
      //return redirect()->route('login');


      //return redirect()->action('UserAdminsController@login')->withInput();
      //return $this->responseMessage('success','Dominio!',true);
    }


    public function show($id)
    {
      $tenant = Tenant::where('domain',$id)
      ->first();
      if(is_null($tenant))
        return $this->responseMessage('success','Dominio',false);
      //return redirect()->action('UserAdminsController@login')->withInput();
      return $this->responseMessage('success','Dominio!',true);
    }
    //Registrar un nuevo consultorios
    public function store(Request $request)
    {
      set_time_limit(180);
      $input = $request->all();  
      $validador = TenantRule::validateAttributes($input);
      DB::connection('landlord')->beginTransaction();
      try{

        if($validador->valid){
        
            try {
              $tenant = new Tenant;
              $tenant->name = $input['name'];
              $tenant->domain = $input['domain'];
              $tenant->database = 'kiru_'.Str::lower($tenant->domain);
              $tenant->save();

              DB::connection('landlord')->commit();

              Storage::disk('avatar')->copy('default-thumbnail.jpg', $tenant->domain.'/useradmin/'.'default-thumbnail.jpg');
              Storage::disk('avatar')->copy('default-thumbnail.jpg', $tenant->domain.'/patients/'.'default-thumbnail.jpg');

              return $this->responseMessage('success','Domain created!', $tenant);
            } catch(\Illuminate\Database\QueryException $e){
              DB::connection('landlord')->rollback();
              $this->checkCurrentDatabase($input['domain']);
              return $this->responseMessage('errorTransaction', 'Ups ha ocurrido un error inesperado'.$e);
            } catch (\Exception $e) {
              DB::connection('landlord')->rollback();
              $this->checkCurrentDatabase($input['domain']);
              return $this->responseMessage('error', 'Ha ocurrido un error'.$e);
            }
        } else{
            return $this->responseMessage('rules','Campos requeridos',$validador->data);
        }
      } catch (\Throwable $e) {
        DB::connection('landlord')->rollback();
        return $this->responseMessage('error', 'Ha ocurrido un error'.$e);

      }

    }
}
