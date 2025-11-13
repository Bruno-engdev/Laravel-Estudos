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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            
            // Dados pessoais
            $table->string('nome', 100);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('telefone', 20)->nullable();
            $table->string('CPF', 14)->unique();
            $table->date('DataNasc')->nullable();
            
            // Token para "lembrar-me"
            $table->rememberToken();
            
            $table->timestamps();
            $table->softDeletes(); // Exclusão lógica
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
