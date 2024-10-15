<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'paciente';
    protected $fillable = ['usuario'];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario');
    }

    public function lembretes()
    {
        return $this->hasMany(Lembrete::class, 'paciente_id');
    }

    public function receitas()
    {
        return $this->hasMany(Receita::class);
    }
}
