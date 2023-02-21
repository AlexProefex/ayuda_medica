<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Material;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {/*
        DB::table('materials')->insert([
            'idTreatment'=>'0',
            'name' => 'no',
            'price' => '0',
        ]);*/
        //Corona Definitiva
        DB::table('materials')->insert([
            'idTreatment'=>'1',
            'name' => 'corona definitiva cc',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('materials')->insert([
            'idTreatment'=>'1',
            'name' => 'corona definitiva cf',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('materials')->insert([
            'idTreatment'=>'1',
            'name' => 'corona definitiva cj',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('materials')->insert([
            'idTreatment'=>'1',
            'name' => 'corona definitiva cmc',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('materials')->insert([
            'idTreatment'=>'1',
            'name' => 'corona definitiva cv',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //Corona Temporal

        DB::table('materials')->insert([
            'idTreatment'=>'2',
            'name' => 'corona temporal cc',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('materials')->insert([
            'idTreatment'=>'2',
            'name' => 'corona temporal cf',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('materials')->insert([
            'idTreatment'=>'2',
            'name' => 'corona temporal cj',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('materials')->insert([
            'idTreatment'=>'2',
            'name' => 'corona temporal cmc',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('materials')->insert([
            'idTreatment'=>'2',
            'name' => 'corona temporal cv',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //Restauracion
        DB::table('materials')->insert([
            'idTreatment'=>'3',
            'name' => 'restauración am',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('materials')->insert([
            'idTreatment'=>'3',
            'name' => 'restauración ie',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('materials')->insert([
            'idTreatment'=>'3',
            'name' => 'restauración im',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('materials')->insert([
            'idTreatment'=>'3',
            'name' => 'restauración iv',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('materials')->insert([
            'idTreatment'=>'3',
            'name' => 'restauración r',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //Restauracion Temporal

        DB::table('materials')->insert([
            'idTreatment'=>'4',
            'name' => 'restauración am r',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        DB::table('materials')->insert([
            'idTreatment'=>'4',
            'name' => 'restauración ie r',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('materials')->insert([
            'idTreatment'=>'4',
            'name' => 'restauración im r',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('materials')->insert([
            'idTreatment'=>'4',
            'name' => 'restauración iv r',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('materials')->insert([
            'idTreatment'=>'4',
            'name' => 'restauración r r',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //Tratamiento pulpar 
        DB::table('materials')->insert([
            'idTreatment'=>'5',
            'name' => 'tratamiento pulpar pc',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('materials')->insert([
            'idTreatment'=>'5',
            'name' => 'tratamiento pulpar pp',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('materials')->insert([
            'idTreatment'=>'5',
            'name' => 'tratamiento pulpar tc',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //Tratamiento pulpar malo

        DB::table('materials')->insert([
            'idTreatment'=>'6',
            'name' => 'tratamiento pulpar pc r',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('materials')->insert([
            'idTreatment'=>'6',
            'name' => 'tratamiento pulpar pp r',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('materials')->insert([
            'idTreatment'=>'6',
            'name' => 'tratamiento pulpar tc r',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //Perno Bueno

        DB::table('materials')->insert([
            'idTreatment'=>'7',
            'name' => 'perno bueno mf',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('materials')->insert([
            'idTreatment'=>'7',
            'name' => 'perno bueno mm',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //Perno Malo

        DB::table('materials')->insert([
            'idTreatment'=>'8',
            'name' => 'perno mf',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('materials')->insert([
            'idTreatment'=>'8',
            'name' => 'perno mm',
            'price' => '80',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


    }
}











