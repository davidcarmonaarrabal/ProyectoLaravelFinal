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
            'name' => $this->faker->word, 
            'description' => $this->faker->sentence, 
            'price' => $this->faker->randomFloat(2, 1, 100), 
            'image_url' => 'https://decartascoleccionables.com/wp-content/uploads/2021/01/dorso-carta-pokemon-scaled.jpg',
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement(['active', 'inactive']), 
        ];
    }
}
