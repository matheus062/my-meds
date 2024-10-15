<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmaceutico extends Model
{
    use HasFactory;

    protected $table = 'farmaceutico';

    protected $fillable = [
        'usuario',
        'empresa',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario');
    }
}
