<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pedidos;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedidos>
 */
class PedidosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Pedidos::class;
    public function definition()
    {
      return [
          'idUsuario' => $this->faker->numberBetween(1,9),
          'dateDelivery' => '2022-07-21'
      ];
    }
}
