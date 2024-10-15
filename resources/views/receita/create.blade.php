<x-app-layout>
    <x-bladewind::card>
        <form method="POST" action="{{ route('receita.store') }}">
            @csrf
            <h1 class="text-2xl">Cadastrar Receita</h1>

            <x-bladewind::input name="codigoUnico" required="true" prefix="Código Único" />
            <x-bladewind::datepicker name="dataEmissao" required="true" label="Data de Emissão" />
            <x-bladewind::input name="tipoEspecial" prefix="Tipo Especial" />
            <x-bladewind::input name="observacoes" prefix="Observações" />
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
            <x-bladewind::button can_submit="true">Cadastrar</x-bladewind::button>
        </form>
    </x-bladewind::card>
</x-app-layout>
