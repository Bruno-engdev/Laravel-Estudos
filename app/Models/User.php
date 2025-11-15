<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'cpf',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Accessor para formatar o CPF
     */
    public function getFormattedCpfAttribute()
    {
        if (!$this->cpf) return null;
        $cpf = $this->cpf;
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }

    /**
     * Accessor para formatar o telefone
     */
    public function getFormattedPhoneAttribute()
    {
        if (!$this->phone) return null;
        $phone = $this->phone;
        if (strlen($phone) == 11) {
            return '(' . substr($phone, 0, 2) . ') ' . substr($phone, 2, 5) . '-' . substr($phone, 7, 4);
        }
        return $phone;
    }

    /**
     * Verifica se o usuário é administrador
     */
    public function isAdmin()
    {
        $adminEmails = [
            'admin@autoprime.com',
            'admin@gmail.com',
            'bruno@autoprime.com',
            'gerente@autoprime.com',
            'supervisor@autoprime.com'
        ];
        
        return in_array($this->email, $adminEmails);
    }

    /**
     * Verifica se o usuário é um cliente comum
     */
    public function isClient()
    {
        return !$this->isAdmin();
    }
}