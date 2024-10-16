<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Receita;

class PharmacistController extends Controller
{
    public function index(Request $request)
    {
        $queryPacientes = Paciente::with('user', 'lembretes', 'receitas');
        $queryReceitas = Receita::with(['medico.user', 'paciente.user']);

        if ($request->filled('filter')) {
            $filter = $request->input('filter');

            // Filtrar pacientes
            $queryPacientes->where(function($q) use ($filter) {
                $q->orWhereHas('user', function ($query) use ($filter) {
                      $query->whereRaw('LOWER(name) LIKE ?', ["%{$filter}%"])
                            ->orWhereRaw('LOWER(rg) LIKE ?', ["%{$filter}%"])
                            ->orWhereRaw('LOWER(cpf) LIKE ?', ["%{$filter}%"])
                            ->orWhereRaw('LOWER(endereco) LIKE ?', ["%{$filter}%"])
                            ->orWhereRaw('LOWER(telefone) LIKE ?', ["%{$filter}%"]);
                  });
            });

            // Filtrar receitas
            $queryReceitas->where(function($q) use ($filter) {
                $q->whereRaw('LOWER(codigoUnico) LIKE ?', ["%{$filter}%"])
                  ->orWhereRaw('LOWER(tipoEspecial) LIKE ?', ["%{$filter}%"])
                  ->orWhereRaw('LOWER(observacoes) LIKE ?', ["%{$filter}%"])
                  ->orWhereHas('paciente.user', function ($query) use ($filter) {
                      $query->whereRaw('LOWER(name) LIKE ?', ["%{$filter}%"]);
                  })
                  ->orWhereHas('medico.user', function ($query) use ($filter) {
                      $query->whereRaw('LOWER(name) LIKE ?', ["%{$filter}%"]);
                  })
                  ->orWhereHas('medico', function ($query) use ($filter) {
                      $query->whereRaw('LOWER(crm) LIKE ?', ["%{$filter}%"]);
                  });
            });
        }

        $pacientes = $queryPacientes->get();
        $receitas = $queryReceitas->get();

        return view('pharmacist.index', compact('pacientes', 'receitas'));
    }
}
