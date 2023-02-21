<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = DB::table('products')->get();
        $products = json_decode($products);

        foreach ($products as $product) {

            $inventory = new Inventory;
            $inventory->idProduct = $product->idProduct;
            $inventory->idConsultory = rand(1,4);
            $inventory->save();
 
        }

    }
    
}
