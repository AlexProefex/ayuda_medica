<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
class UserAdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_admins')
        ->insert([
          'name' => 'Manuel Andre',
          'last_name' => 'Gutierres Sanchez',
          'document_number' => '45879687',
          'phone_number' => '698754874',
          'email' => 'admin@admin.com',
          'idRol'=> 1,
          'avatar' => 'default-thumbnail.jpg',
          'state' => 'Activo',
          'password'=> bcrypt('123456789'),
          'date' => '2022-08-26',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ]);

    }
}


