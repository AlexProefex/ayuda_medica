<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConventionPatient>
 */
class ConventionPatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          'idPatient' => $this->faker->numberBetween(1,10),
          'idConvention' => $this->faker->numberBetween(1,10),
        ];
    }
}
