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
            // Remover colunas antigas de texto
            $table->dropColumn(['marca', 'modelo', 'cor']);
            
            // Adicionar foreign keys
            $table->foreignId('marca_id')->after('id')->constrained('marcas')->onDelete('restrict');
            $table->foreignId('modelo_id')->after('marca_id')->constrained('modelos')->onDelete('restrict');
            $table->foreignId('cor_id')->after('modelo_id')->constrained('cores')->onDelete('restrict');
            
            // Adicionar campos de fotos (URLs)
            $table->string('foto1', 500)->nullable()->after('descricao');
            $table->string('foto2', 500)->nullable()->after('foto1');
            $table->string('foto3', 500)->nullable()->after('foto2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('veiculos', function (Blueprint $table) {
            // Remover foreign keys
            $table->dropForeign(['marca_id']);
            $table->dropForeign(['modelo_id']);
            $table->dropForeign(['cor_id']);
            
            $table->dropColumn(['marca_id', 'modelo_id', 'cor_id']);
            $table->dropColumn(['foto1', 'foto2', 'foto3']);
            
            // Restaurar colunas antigas
            $table->string('marca', 100)->after('id');
            $table->string('modelo', 100)->after('marca');
            $table->string('cor', 50)->after('placa');
        });
    }
};
