<?php
namespace Database\Factories;

use App\Models\Agenda;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgendaFactory extends Factory
{
    protected $model = Agenda::class;

    public function definition()
    {
        return [
            'paciente' => Paciente::factory(),
            'dataConsulta' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
