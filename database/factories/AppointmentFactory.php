<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Appointment;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
         return [
            'idDoctor' => $this->faker->numberBetween(1,9),
            'idConsultory' => $this->faker->numberBetween(1,5),
            'idPatient' => $this->faker->numberBetween(1,9),
            'date' => $this->faker->date,
            'time' => $this->faker->time,
            'idSpecialty' => $this->faker->numberBetween(1,9),
            'reason_appointment'=> $this->faker->jobTitle

        ];
    }
}

     