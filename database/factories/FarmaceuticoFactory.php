<?php

namespace Database\Factories;

use App\Models\Farmaceutico;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Farmaceutico>
 */
class FarmaceuticoFactory extends Factory
{
    protected $model = Farmaceutico::class;

    public function definition()
    {
        return [
            'usuario' => User::factory(),
            'empresa' => $this->faker->unique()->company,
        ];
    }
}
