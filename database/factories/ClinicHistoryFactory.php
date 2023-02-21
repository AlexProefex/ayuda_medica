<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ClinicHistory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClinicHistory>
 */
class ClinicHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    

    protected $model = ClinicHistory::class;

    public function definition()
    {
      return [
        'idPatient' => $this->faker->numberBetween(1,10),
        'idDoctor' => $this->faker->numberBetween(1,10),
        'idConsultory' => $this->faker->numberBetween(1,5),
        'observations' => $this->faker->paragraph()
      ];
    }
}
    