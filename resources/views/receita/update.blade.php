@php use Carbon\Carbon; @endphp
<x-app-layout>
    <x-bladewind::card>
        <form method="POST" action="{{ route('receita.update', $receita->id) }}">
            @csrf
            @method('PUT')
            <h1 class="text-2xl">Cadastrar Receita</h1>

            <x-bladewind::input value="{{ $receita->codigoUnico }}" name="codigoUnico" required="true"
                                prefix="Código Único"/>
            {{--            <x-bladewind::datepicker value="{{ $receita->dataEmissao }}" name="dataEmissao" required="true" label="Data de Emissão" />--}}
            <div class="mb-4">
                <label for="dataEmissao" class="block text-sm font-medium text-gray-700">Data de Emissão</label>
                <input
                    type="datetime-local"
                    id="dataEmissao"
                    name="dataEmissao"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    value="{{ Carbon::parse($receita->dataEmissao)->format('Y-m-d\TH:i') }}"
                    required
                />
            </div>
            <x-bladewind::input value="{{ $receita->tipoEspecial }}" name="tipoEspecial" prefix="Tipo Especial"/>
            <x-bladewind::input value="{{ $receita->observacoes }}" name="observacoes" prefix="Observações"/>
            <label for="resgatada">Resgatada:</label>
            <input type="checkbox" name="resgatada" id="resgatada" value="1">

            <select name="medico_id" required>
                @foreach ($medicos as $medico)
                    <option value="{{ $medico->id }}">{{ $medico->user->name }}</option>
                @endforeach
            </select>

            <select name="paciente_id" required>
                @foreach ($pacientes as $paciente)
                    <option value="{{ $paciente->id }}">{{ $paciente->user->name }}</option>
                @endforeach
            </select>
            <x-bladewind::button can_submit="true">Atualizar</x-bladewind::button>
        </form>
    </x-bladewind::card>
</x-app-layout>
