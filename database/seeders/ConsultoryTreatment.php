<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Treatment;
use App\Models\Material;
use App\Models\ConsultoryMaterial;
use App\Models\ConsultoryTreatments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
class ConsultoryTreatment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $treatments = DB::table('treatments')->get();
        $treatments = json_decode($treatments);


        $consultories = DB::table('consultories')->get();
        foreach ($consultories as $consultory) {
  
   
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


        }

    }


}
