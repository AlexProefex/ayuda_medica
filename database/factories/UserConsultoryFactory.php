<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserConsultory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserConsultory>
 */
class UserConsultoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = UserConsultory::class;

    public function definition()
    {
        return [
            //'idUser' => $this->faker->numberBetween(1,9),
            //'idConsultory' => $this->faker->numberBetween(1,4),
            'idUser' =>  $this->faker->unique()->numberBetween(1,4),
            'idConsultory' => $this->faker->numberBetween(1,1),
            'status' => 'Activo',
        ];
    }

}




