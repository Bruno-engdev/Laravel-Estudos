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
            // Remover a constraint unique da placa
            $table->dropUnique(['placa']);
            
            // Alterar placa para nullable e recriar unique (permitindo múltiplos NULLs)
            $table->string('placa', 10)->nullable()->change();
            
            // Recriar index unique que permite NULLs
            $table->unique('placa', 'veiculos_placa_unique');
        });
        
        // Adicionar constraint personalizada para permitir NULLs múltiplos
        DB::statement('ALTER TABLE veiculos DROP INDEX veiculos_placa_unique');
        DB::statement('ALTER TABLE veiculos ADD CONSTRAINT veiculos_placa_unique UNIQUE (placa)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('veiculos', function (Blueprint $table) {
            // Reverter para não nullable
            $table->string('placa', 10)->nullable(false)->change();
        });
    }
};