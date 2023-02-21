<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kardex;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kardex>
 */
class KardexFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Kardex::class;

    public function definition()
    {
        return [/*
            'product' => $this->faker->jobTitle,
            'brand' => $this->faker->company,
            'amount' => $this->faker->randomDigit,
            'unit' => 'caja', 
            'idConsultory' => $this->faker->numberBetween(1,5),*/
        ];
    }
}
