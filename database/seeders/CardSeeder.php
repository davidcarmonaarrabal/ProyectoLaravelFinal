<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    public function run()
    {
        Card::factory()->count(100)->create(); // Crea 100 cartas
    }
}