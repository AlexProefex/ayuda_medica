<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Treatment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //Tratamientos con material 
        DB::table('treatments')->insert([
            'name' => 'corona definitiva',
            'price' => '',
            'hasMaterial' => 'si',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'corona temporal',
            'price' => '',
            'hasMaterial' => 'si',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'restauración',
            'price' => '',
            'hasMaterial' => 'si',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        DB::table('treatments')->insert([
            'name' => 'restauración temporal',
            'price' => '',
            'hasMaterial' => 'si',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'tratamiento pulpar',
            'price' => '',
            'hasMaterial' => 'si',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'tratamiento pulpar malo',
            'price' => '',
            'hasMaterial' => 'si',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        DB::table('treatments')->insert([
            'name' => 'perno bueno',
            'price' => '',
            'hasMaterial' => 'si',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'perno malo',
            'price' => '',
            'hasMaterial' => 'si',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        //Tratamientos variados
        DB::table('treatments')->insert([
            'name' => 'consulta',
            'price' => '50',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'amalgama simple',
            'price' => '40',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'amalgama compuesta',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'resina fotocurable pequeña',
            'price' => '40',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'resina fotocurable mediana',
            'price' => '60',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'resina fotocurable grande',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'ionomero simple',
            'price' => '30',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'ionomero compuesto',
            'price' => '50',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'endodoncia anterior',
            'price' => '35',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'endodoncia premolar',
            'price' => '40',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'endodoncia molar',
            'price' => '50',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'perno y muñón',
            'price' => '50',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'incrustación',
            'price' => '35',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'prótesis parcial metálica',
            'price' => '35',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'prótesis parcial acrílica',
            'price' => '40',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'prótesis total',
            'price' => '50',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'sellantes',
            'price' => '25',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'fluorización',
            'price' => '60',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'exodoncia simple',
            'price' => '50',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'exodoncia retenida/semiretenida',
            'price' => '70',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'implante',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'cirugía periodontal',
            'price' => '150',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'profilaxis',
            'price' => '90',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'destartraje',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'blanqueamiento',
            'price' => '190',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'radiografia',
            'price' => '60',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'rebasado de prótesis',
            'price' => '50',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'deprogramados anterior',
            'price' => '55',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'férulas miorelajantes',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        //Tratamientos Agrupados

        DB::table('treatments')->insert([
            'name' => 'sellante bueno',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'sellante malo',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'aparato ortodóntico fijo bueno',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'aparato ortodóntico fijo malo',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'aparato ortodóntico removible bueno',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'aparato ortodóntico removible malo',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'caries',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
             DB::table('treatments')->insert([
            'name' => 'desgaste oclusal',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'diastema',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'diente ausente',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'diente extraído',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'diente discrómico',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'diente ectópico',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'diente en clavija',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'diente extruido',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'diente intruido',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'edéntulo total',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'fractura',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'geminación fusión',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'giroversión',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'impactación',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'implante',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'macrodoncia',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'microdoncia',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        DB::table('treatments')->insert([
            'name' => 'migración',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'movilidad',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'prótesis fija buena',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'prótesis fija malo',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'prótesis removible bueno',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'prótesis removible malo',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'prótesis total buena',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'prótesis total malo',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

          DB::table('treatments')->insert([
            'name' => 'remanente radicular',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'semi impactación',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('treatments')->insert([
            'name' => 'supernumerario',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'transposición',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'diente extruido arriba',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'diente intruido arriba',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'transposición arriba',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('treatments')->insert([
            'name' => 'giroversión izquierda',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

            DB::table('treatments')->insert([
            'name' => 'migración izquierda',
            'price' => '80',
            'isInOdontogram' => 'si',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


    }
}