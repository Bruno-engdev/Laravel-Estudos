<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('veiculos', function (Blueprint $table) {
            // Alterar o campo tipo de ENUM para STRING para aceitar mais valores
            $table->string('tipo', 50)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('veiculos', function (Blueprint $table) {
            // Reverter para ENUM original
            $table->enum('tipo', ['Passeio', 'SUV', 'Picape', 'Caminhonete', 'Moto', 'Van', 'Utilitário'])->default('Passeio')->change();
        });
    }
};