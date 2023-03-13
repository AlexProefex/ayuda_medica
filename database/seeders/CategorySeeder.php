<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')
        ->insert([
          'name' => 'Medicina',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ]);

        DB::table('categories')
        ->insert([
          'name' => 'Psicologia',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ]);


    }
}


