<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lembrete;
use App\Models\Medico;
use App\Models\Paciente;

class LembreteController extends Controller
{
    public function index()
    {
        $lembretes = Lembrete::with(['medico.user', 'paciente.user'])->get(); // Carrega os relacionamentos
        return view('lembretes.index', compact('lembretes'));
    }
    public function create()
    {
        $medicos = Medico::with('user')->get()->map(function($medico) {
            return [
                'id' => $medico->id,
                'name' => $medico->user->name
            ];
        });
        $pacientes = Paciente::with('user')->get()->map(function($paciente) {
            return [
                'id' => $paciente->id,
                'name' => $paciente->user->name
            ];
        });
        return view('lembrete.create', compact('medicos', 'pacientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mensagem' => 'required|string|max:255',
            'dataHora' => 'required|date',
            'medico_id' => 'nullable|exists:medico,id',
            'paciente_id' => 'nullable|exists:paciente,id',
        ]);

        Lembrete::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Lembrete criado com sucesso!');
    }
}
