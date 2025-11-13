<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Veiculo extends Model
{
    use SoftDeletes;

    protected $table = 'veiculos';

    protected $fillable = [
        'marca',
        'modelo',
        'ano_fabricacao',
        'ano_modelo',
        'placa',
        'cor',
        'tipo',
        'chassi',
        'renavam',
        'quilometragem',
        'combustivel',
        'cambio',
        'portas',
        'motor',
        'preco_compra',
        'preco_venda',
        'status',
        'categoria',
        'descricao',
        'observacoes',
        'data_aquisicao',
        // 'cliente_id', // Descomente se houver relacionamento
    ];

    protected $casts = [
        'ano_fabricacao' => 'integer',
        'ano_modelo' => 'integer',
        'quilometragem' => 'integer',
        'portas' => 'integer',
        'preco_compra' => 'decimal:2',
        'preco_venda' => 'decimal:2',
        'data_aquisicao' => 'date',
    ];

    // Relacionamento com Cliente (descomente se necessário)
    // public function cliente()
    // {
    //     return $this->belongsTo(Cliente::class);
    // }

    // Accessor para formatar preço
    public function getPrecoVendaFormatadoAttribute()
    {
        return 'R$ ' . number_format($this->preco_venda, 2, ',', '.');
    }

    public function getPrecoCompraFormatadoAttribute()
    {
        return 'R$ ' . number_format($this->preco_compra, 2, ',', '.');
    }

    // Scope para veículos disponíveis
    public function scopeDisponiveis($query)
    {
        return $query->where('status', 'Disponível');
    }

    // Scope para veículos vendidos
    public function scopeVendidos($query)
    {
        return $query->where('status', 'Vendido');
    }
}
