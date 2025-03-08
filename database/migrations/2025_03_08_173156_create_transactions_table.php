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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade'); // Comprador
            $table->foreignId('card_id')->constrained()->onDelete('cascade'); // Carta comprada
            $table->decimal('amount', 8, 2); // Monto de la transacción
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending'); // Estado de la transacción
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
