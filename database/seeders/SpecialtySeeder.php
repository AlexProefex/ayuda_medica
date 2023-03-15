<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            'name' => 'Medicina General',
            'idCategory' => 1,
            'duration' => 60,
            'description' => 'Medicina General',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('specialties')->insert([
            'name' => 'Piscologia General',
            'idCategory' => 2,
            'duration' => 60,
            'description' => 'Psicologia General',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


    }
}

