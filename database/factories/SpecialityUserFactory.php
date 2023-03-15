<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SpecialityUser;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpecialityUser>
 */
class SpecialityUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SpecialityUser::class;

    public function definition()
    {
        return [
            'idSpecialty' => $this->faker->numberBetween(1,12),
            'idUser' => 2,
            'status' => 'Activo',
        ];


    }
}
