<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    public function definition()
    {
        return [
            'product' => $this->faker->jobTitle,
            'brand' => $this->faker->company,
            'amount' => $this->faker->randomDigit,
            'unit' => 'caja', 
            ///'idConsultory' => $this->faker->numberBetween(1,5),
        ];
    }
}
