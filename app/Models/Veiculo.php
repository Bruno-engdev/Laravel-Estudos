<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Veiculo extends Model
{
    use SoftDeletes;

    protected $table = 'veiculos';

    protected $fillable = [
        'marca_id',
        'modelo_id',
        'cor_id',
        'ano_fabricacao',
        'ano_modelo',
        'placa',
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
        'foto1',
        'foto2',
        'foto3',
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

    /**
     * Relacionamento com Marca
     */
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    /**
     * Relacionamento com Modelo
     */
    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }

    /**
     * Relacionamento com Cor
     */
    public function cor()
    {
        return $this->belongsTo(Cor::class);
    }

    // Accessor para formatar preço
    public function getPrecoVendaFormatadoAttribute()
    {
        return 'R$ ' . number_format((float) $this->preco_venda, 2, ',', '.');
    }

    public function getPrecoCompraFormatadoAttribute()
    {
        return 'R$ ' . number_format((float) $this->preco_compra, 2, ',', '.');
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
