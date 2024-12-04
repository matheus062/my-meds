<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Receita;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    public function create()
    {
        $medicos = Medico::with('user')->get(); // Buscar médicos com a relação com usuários
        $pacientes = Paciente::with('user')->get(); // Buscar pacientes com a relação com usuários
        return view('receita.create', compact('medicos', 'pacientes'));
    }

    public function store(Request $request)
{
//    $request->validate([
//        'codigoUnico' => 'required|string|max:32',
//        'dataEmissao' => 'required|date',
//        'tipoEspecial' => 'nullable|string|max:254',
//        'observacoes' => 'nullable|string|max:254',
//        'resgatada' => 'required|boolean',
//        'medico_id' => 'required|exists:medico,id',
//        'paciente_id' => 'required|exists:paciente,id',
//    ]);

    $receita = new Receita();
    $receita->codigoUnico = $request->codigoUnico;
    $receita->dataEmissao = $request->dataEmissao;
    $receita->tipoEspecial = $request->tipoEspecial;
    $receita->observacoes = $request->observacoes;
    $receita->resgatada = $request->has('resgatada');
    $receita->medico_id = $request->medico_id;
    $receita->paciente_id = $request->paciente_id;
    $receita->save();

    return redirect()->route('dashboard')->with('success', 'Receita cadastrada com sucesso');
}

    public function edit($id) {
        $receita = Receita::findOrFail($id);
        $medicos = Medico::with('user')->get(); // Buscar médicos com a relação com usuários
        $pacientes = Paciente::with('user')->get(); // Buscar pacientes com a relação com usuários

        return view('receita.update', compact('receita', 'medicos', 'pacientes'));
    }

    public function update(Request $request, $id) {
        $receita = Receita::findOrFail($id);
        $receita->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Receita atualizada com sucesso');
    }

}
