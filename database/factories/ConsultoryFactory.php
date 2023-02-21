<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Consultory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultory>
 */
class ConsultoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Consultory::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'idManager' => 1,
            'start_time' => $this->faker->time,
            'end_time' => $this->faker->time, 
        ];
    }


}
