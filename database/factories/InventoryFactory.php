<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Inventory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Inventory::class;

    public function definition()
    {
        return [
         /*   'product' => $this->faker->jobTitle,
            'brand' => $this->faker->company,
            'amount' => $this->faker->randomDigit,
            'unit' => 'caja', */
            'idProduct' => $this->faker->numberBetween(1,9),
            'idConsultory' => $this->faker->numberBetween(1,5),
        ];
    }
}
           