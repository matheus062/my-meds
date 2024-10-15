<?php
namespace Database\Factories;

use App\Models\Lembrete;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class LembreteFactory extends Factory
{
    protected $model = Lembrete::class;

    public function definition()
    {
        return [
            'mensagem' => $this->faker->sentence,
            'dataHora' => $this->faker->dateTime,
            'medico_id' => Medico::inRandomOrder()->first()->id,   // Utiliza um médico existente
            'paciente_id' => Paciente::inRandomOrder()->first()->id, // Utiliza um paciente existente
        ];
    }
}

