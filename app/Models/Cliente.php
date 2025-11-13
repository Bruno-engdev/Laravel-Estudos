<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Cliente extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'cliente';

    /**
     * Campos que podem ser preenchidos em massa (mass assignment)
     */
    protected $fillable = [
        'nome',
        'email',
        'password',
        'telefone',
        'CPF',
        'DataNasc',
    ];

    /**
     * Campos que devem ser ocultados em arrays/JSON
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Campos que devem ser convertidos para tipos nativos
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'DataNasc' => 'date',
    ];

    /**
     * Relacionamento: Um cliente pode ter vários veículos
     */
    public function veiculos()
    {
        return $this->hasMany(Veiculo::class, 'cliente_id');
    }
}
