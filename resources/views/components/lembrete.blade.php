<div>
    @if ($pacientes->isNotEmpty())
        @foreach ($pacientes as $paciente)
            <div class="mb-4 p-4 border border-gray-300 rounded bg-white">
                @foreach ($paciente->lembretes as $lembrete)
                    <p><strong>Médico:</strong> {{ $lembrete->medico->user->name ?? 'N/A' }}</p>
                    <p><strong>Descrição:</strong> {{ $lembrete->mensagem }}</p>
                    <p><strong>Data:</strong> {{ $lembrete->dataHora }}</p>
                @endforeach
            </div>
        @endforeach
    @endif
</div>
