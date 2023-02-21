<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PedidosDetail;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PedidosDetail>
 */
class PedidosDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PedidosDetail::class;
    public function definition()
    {
      return [
          'idPedido' => $this->faker->numberBetween(1,9),
          'idProduct' => $this->faker->firstName,
          'amountDelivery' => $this->faker->numberBetween(1,9),
          'amountRemaining' => $this->faker->numberBetween(1,9)
        ];
    }
}
