<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Paciente;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda';

    protected $fillable = [
        'paciente',
        'dataConsulta',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
