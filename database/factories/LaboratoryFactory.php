<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Laboratory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laboratory>
 */
class LaboratoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Laboratory::class;
    public function definition()
    {
      return [
          'business' => $this->faker->company,
          'name' => $this->faker->name,
          'orders' => $this->faker->name,
          'pendientes' => '', 
          'email' => $this->faker->email, 
      ];
    }
}

