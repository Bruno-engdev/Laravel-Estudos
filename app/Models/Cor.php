<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cor extends Model
{
    use SoftDeletes;

    protected $table = 'cores';

    protected $fillable = [
        'nome',
        'codigo_hex',
        'ativo'
    ];

    protected $casts = [
        'ativo' => 'boolean'
    ];

    /**
     * Relacionamento com veículos
     */
    public function veiculos()
    {
        return $this->hasMany(Veiculo::class);
    }

    /**
     * Scope para cores ativas
     */
    public function scopeAtivas($query)
    {
        return $query->where('ativo', true);
    }
}
