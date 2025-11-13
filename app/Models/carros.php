<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carros extends Model
{
    // Se a tabela é 'carros' o Laravel já associa automaticamente.

    // Campos que podem ser preenchidos em massa:
    protected $fillable = [
        'nome_carro',
        'ano_carro',
        'preco_carro',
    ];
}
