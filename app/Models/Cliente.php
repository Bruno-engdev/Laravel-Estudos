<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente'; // Se a tabela tiver nome diferente do plural 'clientes'

    // Quais campos podem ser preenchidos em massa (mass assignment)
    protected $fillable = ['nome', 'email', 'telefone', 'CPF', 'DataNasc'];
}
