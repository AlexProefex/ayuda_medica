<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialty;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialties')->insert([
            'name' => 'Rehabilitación oral',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('specialties')->insert([
            'name' => 'Periodoncia',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('specialties')->insert([
            'name' => 'Endodoncia',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('specialties')->insert([
            'name' => 'Odontopediatría',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('specialties')->insert([
            'name' => 'Ortodoncia',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('specialties')->insert([
            'name' => 'Implantología',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('specialties')->insert([
            'name' => 'Odontología estética',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('specialties')->insert([
            'name' => 'Odontología preventiva',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('specialties')->insert([
            'name' => 'Cariología',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('specialties')->insert([
            'name' => 'Cirugía bucal',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('specialties')->insert([
            'name' => 'Cirugia Maxilofacial',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('specialties')->insert([
            'name' => 'Ortopedia maxilar',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }
}

