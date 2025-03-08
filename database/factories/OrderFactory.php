<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Crea un usuario automáticamente
            'total_amount' => $this->faker->randomFloat(2, 10, 500), // Monto total entre 10 y 500
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']), // Estado aleatorio
        ];
    }
}