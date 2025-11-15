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
            // Adicionar campos adicionais de fotos
            $table->string('foto4', 500)->nullable()->after('foto3');
            $table->string('foto5', 500)->nullable()->after('foto4');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('veiculos', function (Blueprint $table) {
            $table->dropColumn(['foto4', 'foto5']);
        });
    }
};