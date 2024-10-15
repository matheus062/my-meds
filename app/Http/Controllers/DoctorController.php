<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Receita;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{

    public function index(Request $request)
    {
        $queryPacientes = Paciente::with('user', 'lembretes', 'receitas');
        $queryReceitas = Receita::with(['medico.user', 'paciente.user']);

        if ($request->filled('filter')) {
            $filter = $request->input('filter');

            if (is_numeric($filter)) {
                $queryPacientes->where('identifier', $filter);
                $queryReceitas->where('identifier', $filter);
            } else {
                $queryPacientes->whereHas('user', function ($q) use ($filter) {
                    $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($filter) . '%']);
                });

                $queryReceitas->whereHas('paciente.user', function ($q) use ($filter) {
                    $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($filter) . '%']);
                });

                $queryReceitas->orWhere('codigoUnico', $filter);
            }
        }

        $pacientes = $queryPacientes->get();
        $receitas = $queryReceitas->get();

        return view('doctor.index', compact('pacientes', 'receitas'));
    }
}
