<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'telefone',
        'cpf',
        'rg',
        'endereco',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function medico()
    {
        return $this->hasOne(Medico::class, 'usuario');
    }

    public function farmaceutico()
    {
        return $this->hasOne(Farmaceutico::class, 'usuario');
    }

    public function paciente()
    {
        return $this->hasOne(Paciente::class, 'usuario');
    }
}
