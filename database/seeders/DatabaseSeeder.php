<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\UserAdministradorSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
 
        $this->call([
            RolesSeeder::class,
            UserAdministradorSeeder::class,
            SpecialtySeeder::class
        ]);
     //  \App\Models\UserAdmin::factory(30)->create();
     //  \App\Models\Patients::factory(100)->create();
    }
}
