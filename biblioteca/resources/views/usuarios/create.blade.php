@extends('app')

@section('title', 'Cadastrar Usuário')

@section('content')

<div class="mx-auto max-w-3xl">

    {{-- Cabeçalho --}}
    <x-page-header
        title="Cadastrar usuário"
        description="Adicione um novo usuário à biblioteca."
    />

    {{-- Formulário --}}
    <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

        @if ($errors->any())

            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">

                <p class="font-medium">
                    Corrija os seguintes erros:
                </p>

                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>

            </div>

        @endif


        <form action="{{ route('usuarios.store') }}" method="POST">

            @csrf

            <x-usuario-form mode="create" />


            {{-- Botões --}}
            <div class="mt-8 flex justify-end gap-3">

                <x-button
                    text="Cancelar"
                    :href="route('usuarios.index')"
                    color="slate"
                    class="!bg-white !text-slate-700 !ring-1 !ring-slate-300 hover:!bg-slate-50"
                />

                <x-button
                    text="Cadastrar usuário"
                    type="submit"
                    color="green"
                />

            </div>

        </form>

    </div>

</div>

@endsection
