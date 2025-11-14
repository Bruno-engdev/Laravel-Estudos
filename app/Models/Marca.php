<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marca extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'descricao',
        'pais_origem',
        'ativo'
    ];

    protected $casts = [
        'ativo' => 'boolean'
    ];

    /**
     * Relacionamento com modelos
     */
    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }

    /**
     * Relacionamento com veículos
     */
    public function veiculos()
    {
        return $this->hasMany(Veiculo::class);
    }

    /**
     * Scope para marcas ativas
     */
    public function scopeAtivas($query)
    {
        return $query->where('ativo', true);
    }
}
