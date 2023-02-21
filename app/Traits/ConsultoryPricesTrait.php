<?php

namespace App\Traits;
use App\Models\Consultory;
use App\Models\Treatment;
use App\Models\Material;
use App\Models\ConsultoryMaterial;
use App\Models\ConsultoryTreatments;
use Illuminate\Support\Facades\DB;

trait ConsultoryPricesTrait {

    //Asignar los precios iniciales a los tratamientos de un nuevo consultorio automaticamente con 0
    public function setInitialPricesConsultory($input)
    {
      $res = app()->make('stdClass');
      $res->valid = true;

      DB::connection('tenant')->beginTransaction();

      try {

          $consultory = new Consultory;
          $consultory->name = $input['name'];
          $consultory->idManager = $input['idManager'];
          $consultory->start_time = $input['start_time'];
          $consultory->end_time = $input['end_time'];
          $consultory->status = 'Activo';
          $consultory->save();
       
          $treatments = treatment::select('idTreatment','hasMaterial')
          ->get();

          $treatments = json_decode($treatments);

          foreach ($treatments as $treatmentBase) {

              $consultoryTreatments = new ConsultoryTreatments;
              $consultoryTreatments->idTreatment = $treatmentBase->idTreatment;
              $consultoryTreatments->idConsultory = $consultory->idConsultory;
              $consultoryTreatments->price = $treatmentBase->hasMaterial == 'si'?'':0;
       
              $consultoryTreatments->save();

              if($treatmentBase->hasMaterial == 'si'){

                  $materials = Material::select('idMaterial','price')
                  ->where('idTreatment','=',$treatmentBase->idTreatment)
                  ->get();

                  $materials = json_decode($materials);
                  foreach($materials as $materialBase){
                    $material = new ConsultoryMaterial();
                    $material->idTreatment = $treatmentBase->idTreatment;
                    $material->idMaterial = $materialBase->idMaterial;#cons
                    $material->price = 0;
                    $material->idConsultory = $consultory->idConsultory;

                    $material->save();
                  }
              }

          }

          DB::connection('tenant')->commit();
          $res->consultory = $consultory;
          return $res;
       
        } catch (\Exception $e) {
          DB::connection('tenant')->rollback();
          $res->valid = false;
          return $res;

        } catch(\Illuminate\Database\QueryException $e){
          DB::connection('tenant')->rollback();
          $res->valid = false;
          return $res;
        }  
    }


    //Asignar los precios iniciales a los tratamientos de un nuevo consultorio automaticamente con los precios de tratamiento base

    public function setBasePricesConsultory($input)
    {
      $res = app()->make('stdClass');
      $res->valid = true;

      DB::connection('tenant')->beginTransaction();
      try {

          $consultory = new Consultory;
          $consultory->name = $input['name'];
          $consultory->idManager = $input['idManager'];
          $consultory->start_time = $input['start_time'];
          $consultory->end_time = $input['end_time'];
          $consultory->status = 'Activo';
          $consultory->save();

          $treatments = treatment::select('idTreatment','price','hasMaterial')
          ->get();

          $treatments = json_decode($treatments);

          foreach ($treatments as $treatmentBase) {

              $consultoryTreatments = new ConsultoryTreatments;
              $consultoryTreatments->idTreatment = $treatmentBase->idTreatment;
              $consultoryTreatments->idConsultory = $consultory->idConsultory;
              $consultoryTreatments->price = $treatmentBase->price;
              $consultoryTreatments->save();

              if($treatmentBase->hasMaterial == 'si'){

                  $materials = Material::select('idMaterial','price')
                  ->where('idTreatment','=',$treatmentBase->idTreatment)
                  ->get();

                  $materials = json_decode($materials);
                  foreach($materials as $materialBase){
                    $material = new ConsultoryMaterial();
                    $material->idTreatment = $treatmentBase->idTreatment;
                    $material->idMaterial = $materialBase->idMaterial;#cons
                    $material->price = $materialBase->price;
                    $material->idConsultory = $consultory->idConsultory;
                    $material->save();
                  }
              }
        

          }

          DB::connection('tenant')->commit();
          $res->consultory = $consultory;
          return $res;

        } catch (\Exception $e) {
          DB::connection('tenant')->rollback();
          $res->valid = false;
          return $res;

        } catch(\Illuminate\Database\QueryException $e){
          DB::connection('tenant')->rollback();
          $res->valid = false;
          return $res;
        }  
    }

    //Asignar los precios iniciales a los tratamientos de un nuevo consultorio importando desde otro consultorio
    public function setPricesByConsultory($input)
    {
      $res = app()->make('stdClass');
      $res->valid = true;

      DB::connection('tenant')->beginTransaction();

      try {
          $consultory = new Consultory;
          $consultory->name = $input['name'];
          $consultory->idManager = $input['idManager'];
          $consultory->start_time = $input['start_time'];
          $consultory->end_time = $input['end_time'];
          $consultory->status = 'Activo';
          $consultory->save();
       
          $treatments = ConsultoryTreatments::select('consultory_treatments.idTreatment','consultory_treatments.price','treatments.hasMaterial')
          ->join('treatments','consultory_treatments.idTreatment','=','treatments.idTreatment')
          ->where('consultory_treatments.idConsultory','=',$input['idConsultory'])
          ->get();

          $treatments = json_decode($treatments);

          foreach ($treatments as $treatmentBase) {
            
              $consultoryTreatments = new ConsultoryTreatments;
              $consultoryTreatments->idTreatment = $treatmentBase->idTreatment;
              $consultoryTreatments->idConsultory = $consultory->idConsultory;
              $consultoryTreatments->price = $treatmentBase->price;
              $consultoryTreatments->save();

              if($treatmentBase->hasMaterial == 'si'){

                  $materials = ConsultoryMaterial::select('idMaterial','price')
                  ->where('idTreatment','=',$treatmentBase->idTreatment)
                  ->where('idConsultory','=',$input['idConsultory'])
                  ->get();

                  $materials = json_decode($materials);
                  foreach($materials as $materialBase){
                    $material = new ConsultoryMaterial();
                    $material->idTreatment = $treatmentBase->idTreatment;
                    $material->idMaterial = $materialBase->idMaterial;#cons
                    $material->price = $materialBase->price;
                    $material->idConsultory = $consultory->idConsultory;
                    $material->save();
                  }
              }
          }
          DB::connection('tenant')->commit();
          $res->consultory = $consultory;
          return $res;
        } catch (\Exception $e) {
          DB::connection('tenant')->rollback();
          $res->valid = false;
          return $res;
        } catch(\Illuminate\Database\QueryException $e){
          DB::connection('tenant')->rollback();
          $res->valid = false;
          return $res;
        }  
    }

      
    //Actualizar los precios de los tratamientos base 
    public function setUpdatePricesTreatmentBase($input)
    {

      $res = app()->make('stdClass');
      $res->error = false;

      DB::connection('tenant')->beginTransaction();

      try {

        $treatments = json_decode($input['treatments'],true);

        foreach ($treatments as $treatmentBase) {

          $treatment = Treatment::where('idTreatment','=',$treatmentBase['idTreatment'])
          ->first();
          $treatment->price = trim($treatmentBase['price']);
          $treatment->save();
        }

        $materials = json_decode($input['materials'],true);

        foreach ($materials as $materialBase) {
            $material = Material::where('idMaterial','=',$materialBase['idMaterial'])
            ->first();
            $material->price = trim($materialBase['price']);
            $material->save();
        }

        DB::connection('tenant')->commit();
      
      } catch(\Illuminate\Database\QueryException $e){
        $res->message = $e;
        $res->error = true;
      } catch (\Exception $e) {
        $res->message = $e;
        $res->error = true;
      } catch (\Throwable $e) {
        $res->message = $e;
        $res->error = true;
      } finally {
        if($res->error){
          DB::connection('tenant')->rollback();
        }
        return $res;
      }
    }

    //Actualizar los precios de los traatamientos de un consultorio extraendolo desde otro consultorio
    public function setUpdatePricesByConsultory($input)
    {
      $res = app()->make('stdClass');
      $res->error = false;
      DB::connection('tenant')->beginTransaction();
      $idConsultory = $input['consultory'];
      try {

        $treatments = json_decode($input['treatments'],true);
        $materials = json_decode($input['materials'],true);

        foreach ($treatments as $treatmentBase) {

          $treatment = Treatment::where('idTreatment','=',$treatmentBase['idTreatment'])
          ->first();        

          $consultoryTreatments = ConsultoryTreatments::where('idTreatment','=',$treatment->idTreatment)
          ->where('idConsultory','=',$idConsultory)
          ->first();

            if(!$consultoryTreatments){
              $consultoryTreatments = new ConsultoryTreatments;
              $consultoryTreatments->idConsultory = $idConsultory;
              $consultoryTreatments->idTreatment = $treatment->idTreatment;
            } 

            $consultoryTreatments->price = $treatmentBase['price'];
            $consultoryTreatments->save();
        }

        foreach ($materials as $materialBase) {

          $material = Material::where('idMaterial','=',$materialBase['idMaterial'])
          ->first();


          $consultoryMaterial = ConsultoryMaterial::where('idMaterial','=',$material->idMaterial)
          ->where('idConsultory','=',$idConsultory)
          ->first();

          if(!$consultoryMaterial){
            $consultoryMaterial = new ConsultoryMaterial;
            $consultoryMaterial->idTreatment = $material->idTreatment;
            $consultoryMaterial->idMaterial = $material->idMaterial;
            $consultoryMaterial->idConsultory = $idConsultory;
          }

          $consultoryMaterial->price = $materialBase['price'];
          $consultoryMaterial->save();
        }

        DB::connection('tenant')->commit();

      } catch(\Illuminate\Database\QueryException $e){
        $res->message = $e;
        $res->error = true;
      } catch (\Exception $e) {
        $res->message = $e;
        $res->error = true;
      } catch (\Throwable $e) {
        $res->message = $e;
        $res->error = true;
      } finally {
        if($res->error){
          DB::connection('tenant')->rollback();
        }
        return $res;
      }
      
    }

}