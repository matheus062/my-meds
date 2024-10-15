<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Criar Lembrete
        </h2>
    </x-slot>

    <x-bladewind::card class="m-8 p-8">
        <form method="POST" action="{{ route('lembrete.store') }}">
            @csrf
            <div class="p-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="mensagem">
                        Lembrete:
                    </label>
                    <x-bladewind::input  type="text" name="mensagem" id="mensagem"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="dataHora">
                        Data e Hora:
                    </label>
                    <div class="relative w-full dv-bw_datepicker  mb-4">
                        <input type="datetime-local" name="dataHora" id="dataHora"
                            class="shadow appearance-none border rounded w-full py-2 px-3
                            text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                            bw-input peer bw_datepicker medium bw-datepicker">

                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="medico_id">
                        Médico (opcional)
                    </label>
                    <x-bladewind::select :data="$medicos" value_key="id" label_key="name" name="medico_id"
                        label="Medico" searchable="true" selected_value="{{ old('medico_id') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="paciente_id">
                        Paciente (opcional)
                    </label>
                    <x-bladewind::select :data="$pacientes" value_key="id" label_key="name" name="paciente_id"
                        label="Paciente" searchable="true" selected_value="{{ old('paciente_id') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />

                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Criar Lembrete
                    </button>
                </div>
            </div>
        </form>
    </x-bladewind::card>
</x-app-layout>
