<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::table('user_admins')
        ->where('idUser', 1)
        ->update([
            'email' => 'admin@admin.com',
            'idRol' => '1'
        ]);
        
        DB::table('user_admins')
        ->where('idUser', 2)
        ->update([
            'email' => 'doctor@admin.com',
            'idRol' => '2'
        ]);

        DB::table('user_admins')
        ->where('idUser', 3)
        ->update([
            'email' => 'asis_admin@admin.com',
            'idRol' => '3'
        ]);

        DB::table('user_admins')
        ->where('idUser', 4)
        ->update([
            'email' => 'asis_med@admin.com',
            'idRol' => '4'
        ]);

    }
}
