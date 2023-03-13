<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserAdmin;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAdmin>
 */
class UserAdminFactory extends Factory
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
            'document_number' => $this->faker->unique()->numberBetween(10000000,99999999),
            'phone_number' => $this->faker->unique()->numberBetween(100000000,999999999),
            'email' => $this->faker->firstName.'@test.com',
            'idRol'=> $this->faker->numberBetween(1,2),
            'avatar' => 'default-thumbnail.jpg',
            'state' => 'Activo',
            'password'=> bcrypt('123456789'),
            'date' => $this->faker->date,
            'schedule' => '[{day: "",checkInTime: null,departureTime: null,disabled: false}]',
            'location' => 'virtual',
            'timezone' => 'America/Lima',
            'observations' => 'Observaciones',
            'idCategory' => '1',
            'nColegiatura' => $this->faker->unique()->numberBetween(100000000,999999999),
        ];
    }
}

    

