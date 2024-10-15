
<x-app-layout>
    <x-bladewind::card>
        <form method="POST" action="{{ route('patient.store') }}">
            @csrf
            <h1 class="text-2xl">Cadastrar Pacientes</h1>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <x-bladewind::alert
                        type="error">
                        <li>{{ $error }}</li>
                    </x-bladewind::alert>
                @endforeach
            @endif
            <x-bladewind::input name="name" required="true" prefix="Nome" />
            <x-bladewind::input name="email" required="true" prefix="E-mail" />
            <x-bladewind::input name="telefone" numeric="true" prefix="Telefone"/>
            <x-bladewind::input name="cpf" required="true" prefix="CPF" numeric="true"/>
            <x-bladewind::input name="rg" required="true" prefix="RG" numeric="true"/>
            <x-bladewind::input name="endereco" required="true" prefix="Endereço" />
            <x-bladewind::button can_submit="true">Cadastrar</x-bladewind::button>
        </form>        
    </x-bladewind::card>
</x-app-layout>
                        