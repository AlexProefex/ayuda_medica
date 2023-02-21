<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patients;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patients>
 */
class PatientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'last_name' => $this->faker->lastName.' '.$this->faker->lastName,
            'document_type' => 'DNI',
            'document_number' => $this->faker->unique()->numberBetween(1000000,99999999),
            'phone_number' => $this->faker->numberBetween(100000000,999999999),
            'email' => $this->faker->firstName.'@gmail.com',
            'avatar' => 'default-thumbnail.jpg',
            //'gender' => 'M',
            'birthdate' => $this->faker->date,
            'diseases' => '{}',
            //'password' => '123456789'

        ];
    }
}

