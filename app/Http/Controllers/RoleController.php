<?php

namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\Role\RoleObject;
class RoleController extends BaseController
{
    //Listado de todos los roles disponibles
    public function index()
    {
        $role = Role::select(
            'idRol',
            'name',
            'state')
        ->get();
        if(is_null($role))
         return $this->responseMessage('not_found','List de Roles!',[]);
        return $this->responseMessage('success','List de Roles!',RoleResource::collection($role));
    }


    public function store(Request $request)
    {
      try {
          
        $input = $request->all(); 
        $role = new Role;
        $role->name = $input['name'];
        $role->save();

        return $this->responseMessage('success','Role created!', new RoleObject($role));

      } catch (\Exception $e) {
        return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
      } catch(\Illuminate\Database\QueryException $e){
        return $this->responseMessage('error', 'Upss ha ocurrido un error inesperado');
      }
    }
    
    //Obtener las historias clinicas del paciente neduabte el identificador del paciente
    public function show($id)
    {
      $role = Role::find($id);

      if(is_null($role))
        return $this->responseMessage('not_found','List de Role!',[]);

      return $this->responseMessage('success','List de Role!', new RoleObject($role));
    }


    public function update(Request $request, $id)
    {
      try {
          
        $input = $request->all(); 

        $role = Role::find($id);

        $role->name = $input['name'];
        $role->state = $input['state'];
        $role->save();

        return $this->responseMessage('success','Role updated!', new RoleObject($role));

      } catch (\Exception $e) {
        return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
      } catch(\Illuminate\Database\QueryException $e){
        return $this->responseMessage('error', 'Upss ha ocurrido un error inesperado');
      }
    }


}
