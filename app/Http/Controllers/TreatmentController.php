<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\Material;
use App\Models\ConsultoryMaterial;
use App\Models\ConsultoryTreatments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Treatment\TreatmentResource;
use App\Http\Resources\Treatment\AddTreatment;
use App\Http\Resources\Treatment\TreatmentCollection;
use App\Http\Resources\Treatment\TreatmentObject;
use App\Rules\TreatmentValidation;
use App\Traits\ConsultoryPricesTrait;

class TreatmentController extends BaseController
{
    use ConsultoryPricesTrait;

    //Listado de tratamientos y sus materiales
    public function index()
    {
      $treatment = Treatment::orderBy('idTreatment', 'asc')
      ->select('*')
      ->get();

      $material = Material::orderBy('idMaterial', 'asc')
      ->select('*')
      ->get();

      if(is_null($treatment)||$treatment=="[]")
        return $this->responseMessage('not_found','List Treatment!',[]);
      return $this->responseMessage('success','List de Treatment!',TreatmentCollection::make($treatment,$material));
    }

    //Registro de un nuevo tratamiento
    public function store(Request $request)
    {
        DB::connection('tenant')->beginTransaction();
        try {
          $input = $request->all();  

          $validador = TreatmentValidation::validateAttributes($input);
          if($validador->valid){

            $consultories = json_decode($input['consultories'],true);

            $price = trim($input['hasMaterial'] == 'si' ? '' : $input['price']);

            $treatment = new Treatment;
            $treatment->name = strtolower(trim($input['name']));
            $treatment->price = $price;
            $treatment->hasMaterial = $input['hasMaterial'];
            $treatment->save();

            foreach ($consultories as $consultory) {
              $consultoryTreatments = new ConsultoryTreatments;
              $consultoryTreatments->idConsultory = $consultory;
              $consultoryTreatments->idTreatment = $treatment->idTreatment;
              $consultoryTreatments->price = $price;
              $consultoryTreatments->save();
            }
            
            if($input['hasMaterial'] == 'si'){
              $materials = json_decode($input['material'],true);
              foreach ($materials as $details) {
      
                $material = new Material;
                $material->idTreatment = $treatment->idTreatment;
                $material->name = trim($details['name']);
                $material->price = trim($details['price']);
                $material->save();

                foreach ($consultories as $consultory) {

                  $consultoryMaterial = new ConsultoryMaterial();
                  $consultoryMaterial->idTreatment = $treatment->idTreatment;
                  $consultoryMaterial->price = trim($details['price']);
                  $consultoryMaterial->idMaterial = $material->idMaterial;
                  $consultoryMaterial->idConsultory = $consultory;
                  $consultoryMaterial->save();
                }
              }
          } 
            DB::connection('tenant')->commit();
            return $this->responseMessage('success','tratamiento created!',new TreatmentObject($treatment));
          }
          
          DB::connection('tenant')->rollback();
          return $this->responseMessage('rules','Campos requeridos',$validador->data);
        } catch (\Exception $e) {
          DB::connection('tenant')->rollback();
          return $this->responseMessage('errorTransaction','Ha ocurrido un error');
        }
        catch(\Illuminate\Database\QueryException $e){
          DB::connection('tenant')->rollback();
          return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado');
        }  

    }
 
    //Listado de tratamientos pertenecientes a un consultorio o al listado de tratamientos base
    public function show($id)
    {
      if($id == 0){
        return $this->index();
      }
      else{
      $treatment = Treatment::select(
        'treatments.idTreatment',
        'treatments.name',
        'consultory_treatments.price',
        'treatments.hasMaterial')
      ->join('consultory_treatments','consultory_treatments.idTreatment','=','treatments.idTreatment')
      ->where('idConsultory','=',$id)
      ->orderBy('treatments.idTreatment', 'asc')
      ->get();

      $material = Material::select(
        'consultory_materials.idMaterial',
        'consultory_materials.idTreatment',
        'materials.name',
        'consultory_materials.price')
      ->join('consultory_materials','consultory_materials.idMaterial','=','materials.idMaterial')
      ->join('treatments','treatments.idTreatment','=','materials.idTreatment')
      ->where('consultory_materials.idConsultory','=',$id)
      ->orderBy('consultory_materials.idMaterial', 'asc')
      ->get();

      }
      if(is_null($treatment)||$treatment=="[]")
        return $this->responseMessage('not_found','List Treatment!',[]);

      return $this->responseMessage('success','List de Treatment!',TreatmentCollection::make($treatment,$material));
    }

    //Actualizar los precios de los tratamientos correspondientes a un consultorio o a los tratamientos base
    public function updatePrices(Request $request)
    {

      try {
        $input = $request->all(); 
        $validador = TreatmentValidation::validateJSon($input);
        if($validador->valid){

          if ($request->has('consultory')) {
            if($request->consultory==0){
              $res = $this->setUpdatePricesTreatmentBase($input);
            }
            else{
              $res = $this->setUpdatePricesByConsultory($input);
            }
          }
          else{
            $res = $this->setUpdatePricesTreatmentBase($input);
          }
          if($res->error)
            return $this->responseMessage('success','failed!',TreatmentCollection::make('[]','[]'));
          else
            return $this->responseMessage('success','Updated!','');
        } else{
          return $this->responseMessage('rules','Campos requeridos',$validador->data);
        }
      } catch (\Exception $e) {
        return $this->responseMessage('errorTransaction','Ha ocurrido un error!',TreatmentCollection::make('[]','[]'));
      } catch(\Illuminate\Database\QueryException $e){
        return $this->responseMessage('error','Upp ha ocurrido un error',TreatmentCollection::make('[]','[]'));
      }   
    }

    //Listado de tratamientos faltantes a un determinado consultorio
    public function missingTreatment($idConsultory){
      $consultoryTreatments = ConsultoryTreatments::select('idTreatment')
      ->where('idConsultory',$idConsultory)
      ->get();

      $treatment = Treatment::select('idTreatment','name', 'price','hasMaterial')
      ->whereNotIn('idTreatment',$consultoryTreatments)
      ->orderBy('treatments.idTreatment', 'asc')
      ->get();

      return $this->responseMessage('success','tratamiento created!', AddTreatment::collection($treatment));
    }
}
