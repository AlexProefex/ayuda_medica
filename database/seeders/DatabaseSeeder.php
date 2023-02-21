<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\SpecialtySeeder;
use Database\Seeders\MaterialSeeder;
use Database\Seeders\TreatmentSeeder;
use Database\Seeders\UserAdminsSeeder;
use Database\Seeders\UserAdministradorSeeder;
use Database\Seeders\ConsultorySeeder;


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
            //SpecialtySeeder::class,
            //TreatmentSeeder::class,
            //MaterialSeeder::class,
            UserAdministradorSeeder::class,
            //ConsultorySeeder::class,
            //UserConsultorySeeder::class,
            //ConsultoryTreatment::class,
        ]);
    
       \App\Models\Patients::factory(100)->create();
       // \App\Models\Consultory::factory(1)->create();
    
        //\App\Models\Convention::factory(10)->create();
        //\App\Models\Patients::factory(10)->create();
        //\App\Models\UserAdmin::factory(3)->create();
        //\App\Models\Appointment::factory(10)->create();
        //\App\Models\UserConsultory::factory(4)->create();
        //\App\Models\ConventionPatient::factory(20)->create();
        //\App\Models\ClinicHistory::factory(20)->create();
        //\App\Models\Product::factory(20)->create();
        //\App\Models\Inventory::factory(20)->create();
        //\App\Models\Kardex::factory(20)->create();
        //\App\Models\Laboratory::factory(20)->create();
        //\App\Models\Pedidos::factory(10)->create();
        //\App\Models\PedidosDetail::factory(50)->create();
       // \App\Models\SpecialityUser::factory(2)->create();

   
       /* $this->call([
           ConsultoryTreatment::class,
           UserAdminsSeeder::class,
           // InventorySeeder::class,
        ]);

        //comentario
*/
    }
}
