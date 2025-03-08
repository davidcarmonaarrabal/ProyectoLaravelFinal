<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    protected $model = Card::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word, // Nombre aleatorio
            'description' => $this->faker->sentence, // Descripción aleatoria
            'price' => $this->faker->randomFloat(2, 1, 100), // Precio entre 1 y 100
            'image_url' => $this->faker->imageUrl(), // URL de imagen aleatoria
            'user_id' => User::factory(), // Crea un usuario automáticamente
            'status' => $this->faker->randomElement(['active', 'inactive']), // Estado aleatorio
        ];
    }
}
