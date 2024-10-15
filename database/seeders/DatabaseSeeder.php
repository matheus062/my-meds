<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Medico;
use App\Models\Farmaceutico;
use App\Models\Paciente;
use App\Models\Agenda;
use App\Models\Receita;
use App\Models\Lembrete;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Criar usuários genéricos
        User::factory(10)->create();

        // Criar usuários e modelos relacionados
        Medico::factory(10)->create();
        Paciente::factory(10)->create();
        Farmaceutico::factory(10)->create();

        // Criar receitas e lembretes para cada paciente
        Paciente::all()->each(function ($paciente) {
            // Gerar 5 receitas para cada paciente
            Receita::factory(5)->create([
                'paciente_id' => $paciente->id,
                'medico_id' => Medico::inRandomOrder()->first()->id,
            ]);

            // Gerar 5 lembretes para cada paciente
            Lembrete::factory(5)->create([
                'paciente_id' => $paciente->id,
                'medico_id' => Medico::inRandomOrder()->first()->id,
            ]);
        });

        // Criar um usuário do tipo Medico e associá-lo a um usuário
        $user = User::factory()->create([
            'name' => 'Medico User',
            'email' => 'medico@example.com',
            'username' => 'medico_user',
            'password' => bcrypt('1234'),
        ]);

        Medico::factory()->create([
            'usuario' => $user->id,
            'crm' => 'CRM-8089790',
        ]);

        // Criar um usuário do tipo Paciente e associá-lo a um usuário
        $user = User::factory()->create([
            'name' => 'Paciente User',
            'email' => 'paciente@example.com',
            'username' => 'paciente_user',
            'password' => bcrypt('1234'),
        ]);

        $paciente = Paciente::factory()->create([
            'usuario' => $user->id,
        ]);

        // Gerar 5 receitas e 5 lembretes para o paciente criado
        Receita::factory(5)->create([
            'paciente_id' => $paciente->id,
            'medico_id' => Medico::inRandomOrder()->first()->id,
        ]);

        Lembrete::factory(5)->create([
            'paciente_id' => $paciente->id,
            'medico_id' => Medico::inRandomOrder()->first()->id,
        ]);

        // Criar um usuário do tipo Farmaceutico e associá-lo a um usuário
        $user = User::factory()->create([
            'name' => 'Farmaceutico User',
            'email' => 'farmaceutico@example.com',
            'username' => 'farmaceutico_user',
            'password' => bcrypt('1234'),
        ]);

        Farmaceutico::factory()->create([
            'usuario' => $user->id,
        ]);
    }
}
