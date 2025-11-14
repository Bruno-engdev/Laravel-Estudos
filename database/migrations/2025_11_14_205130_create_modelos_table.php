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
        Schema::create('modelos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marca_id')->constrained('marcas')->onDelete('cascade');
            $table->string('nome', 100);
            $table->text('descricao')->nullable();
            $table->string('tipo', 50)->nullable(); // SUV, Sedan, Hatch, etc
            $table->boolean('ativo')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            $table->unique(['marca_id', 'nome']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modelos');
    }
};
