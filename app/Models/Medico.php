<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medico';
    protected $fillable = ['usuario', 'crm'];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario');
    }

    public function lembretes()
    {
        return $this->hasMany(Lembrete::class, 'medico_id');
    }
}
