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
            // Alterar campos ENUM para STRING para maior flexibilidade
            $table->string('combustivel', 50)->change();
            $table->string('cambio', 50)->change();
            $table->string('status', 50)->change();
            $table->string('categoria', 50)->change();
            
            // Aumentar tamanho do campo motor
            $table->string('motor', 100)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('veiculos', function (Blueprint $table) {
            // Reverter para ENUMs originais
            $table->enum('combustivel', ['Gasolina', 'Etanol', 'Diesel', 'Flex', 'Elétrico', 'Híbrido', 'GNV'])->default('Flex')->change();
            $table->enum('cambio', ['Manual', 'Automático', 'Automatizado', 'CVT'])->default('Manual')->change();
            $table->enum('status', ['Disponível', 'Vendido', 'Reservado', 'Em Manutenção', 'Indisponível'])->default('Disponível')->change();
            $table->enum('categoria', ['Novo', 'Seminovo', 'Usado'])->default('Usado')->change();
            $table->string('motor', 20)->change();
        });
    }
};