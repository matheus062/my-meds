<?php
namespace Database\Factories;

use App\Models\Receita;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;
class ReceitaFactory extends Factory
{
    protected $model = Receita::class;

    public function definition()
    {
        return [
            'codigoUnico' => $this->faker->unique()->uuid,
            'dataEmissao' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'tipoEspecial' => $this->faker->optional()->word,
            'observacoes' => $this->faker->sentence,
            'resgatada' => $this->faker->boolean,
            'medico_id' => Medico::factory(),
            'paciente_id' => Paciente::factory(),
        ];
    }
}
