<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2); // Precio con 8 dígitos en total y 2 decimales
            $table->string('image_url')->nullable()->default('https://decartascoleccionables.com/wp-content/uploads/2021/01/dorso-carta-pokemon-scaled.jpg');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con el vendedor
            $table->enum('status', ['active', 'inactive'])->default('active'); // Estado de la carta
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
