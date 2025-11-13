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
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            
            // Dados Básicos
            $table->string('marca', 50);
            $table->string('modelo', 100);
            $table->year('ano_fabricacao');
            $table->year('ano_modelo');
            $table->string('placa', 10)->unique();
            $table->string('cor', 30);
            $table->enum('tipo', ['Passeio', 'SUV', 'Picape', 'Caminhonete', 'Moto', 'Van', 'Utilitário'])->default('Passeio');
            
            // Dados Técnicos
            $table->string('chassi', 17)->unique()->nullable();
            $table->string('renavam', 11)->unique()->nullable();
            $table->integer('quilometragem')->default(0);
            $table->enum('combustivel', ['Gasolina', 'Etanol', 'Diesel', 'Flex', 'Elétrico', 'Híbrido', 'GNV'])->default('Flex');
            $table->enum('cambio', ['Manual', 'Automático', 'Automatizado', 'CVT'])->default('Manual');
            $table->integer('portas')->default(4);
            $table->string('motor', 20)->nullable(); // Ex: 1.0, 2.0 16V, etc.
            
            // Dados Comerciais
            $table->decimal('preco_compra', 10, 2)->nullable();
            $table->decimal('preco_venda', 10, 2)->nullable();
            $table->enum('status', ['Disponível', 'Vendido', 'Reservado', 'Em Manutenção', 'Indisponível'])->default('Disponível');
            $table->enum('categoria', ['Novo', 'Seminovo', 'Usado'])->default('Usado');
            
            // Dados Adicionais
            $table->text('descricao')->nullable();
            $table->text('observacoes')->nullable();
            $table->date('data_aquisicao')->nullable();
            
            // Relacionamento (opcional - descomente se tiver tabela clientes)
            // $table->foreignId('cliente_id')->nullable()->constrained('clientes')->onDelete('set null');
            
            $table->timestamps();
            $table->softDeletes(); // Para deletar logicamente sem remover do banco
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veiculos');
    }
};
