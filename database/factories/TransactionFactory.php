<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'buyer_id' => User::factory(), // Crea un usuario automáticamente
            'card_id' => Card::factory(), // Crea una carta automáticamente
            'amount' => $this->faker->randomFloat(2, 1, 100), // Monto entre 1 y 100
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']), // Estado aleatorio
        ];
    }
}