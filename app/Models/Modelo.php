<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modelo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'marca_id',
        'nome',
        'descricao',
        'tipo',
        'ativo'
    ];

    protected $casts = [
        'ativo' => 'boolean'
    ];

    /**
     * Relacionamento com marca
     */
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    /**
     * Relacionamento com veículos
     */
    public function veiculos()
    {
        return $this->hasMany(Veiculo::class);
    }

    /**
     * Scope para modelos ativos
     */
    public function scopeAtivos($query)
    {
        return $query->where('ativo', true);
    }

    /**
     * Accessor para nome completo (Marca + Modelo)
     */
    public function getNomeCompletoAttribute()
    {
        return $this->marca->nome . ' ' . $this->nome;
    }
}
