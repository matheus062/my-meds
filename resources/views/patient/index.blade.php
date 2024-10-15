<x-app-layout>
    <x-search-form action="{{ route('patient.index') }}" />

    <div class="grid grid-cols-2">
        <div class="bg-gray-100 p-4 overflow-y-auto">
            <h2 class="text-xl font-bold mb-4">Lista de Receitas</h2>
            @foreach ($receitas as $receita)
                <div class="mb-4 p-4 border border-gray-300 rounded bg-white">
                    <strong>Código:</strong> {{ $receita->codigoUnico }}<br>
                    <strong>Data de Emissão:</strong> {{ \Carbon\Carbon::parse($receita->dataEmissao)->format('d/m/Y H:i') }}<br>
                    <strong>Tipo Especial:</strong> {{ $receita->tipoEspecial }}<br>
                    <strong>Observações:</strong> {{ $receita->observacoes }}<br>
                    <strong>Resgatada:</strong> {{ $receita->resgatada ? 'Sim' : 'Não' }}<br>
                    <strong>Médico:</strong> {{ $receita->medico->user->name ?? 'N/A' }}<br>
                    <strong>CRM:</strong> {{ $receita->medico->crm ?? 'N/A' }}<br>
                    <strong>Paciente:</strong> {{ $receita->paciente->user->name ?? 'N/A' }}<br>
                </div>
            @endforeach
        </div>

        <div class="bg-gray-100 p-4 overflow-y-auto">
            <h2 class="text-xl font-bold mb-4">Lembretes</h2>
            <div class="grid grid-cols-1">
                @if ($pacientes->isNotEmpty())
                    @foreach ($pacientes as $paciente)
                        @foreach ($paciente->lembretes as $lembrete)
                            <div class="mb-4 p-4 border border-gray-300 rounded bg-white">
                                <p><strong>Paciente:</strong> {{ $paciente->user->name }}</p>
                                <p><strong>Médico:</strong> {{ $lembrete->medico->user->name ?? 'N/A' }}</p>
                                <p><strong>Descrição:</strong> {{ $lembrete->mensagem }}</p>
                                <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($lembrete->dataHora)->format('d/m/Y H:i') }}</p>
                            </div>
                        @endforeach
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
