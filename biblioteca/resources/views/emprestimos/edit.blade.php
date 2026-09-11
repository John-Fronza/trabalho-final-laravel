@extends('app')

@section('title', 'Editar Empréstimo')

@section('content')

<div class="mx-auto max-w-3xl">

    {{-- Cabeçalho --}}
    <x-page-header
        title="Editar empréstimo"
        description="Atualize as informações do empréstimo cadastrado."
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


        <form
            action="{{ route('emprestimos.update', $emprestimo) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            <x-emprestimo-form
                mode="edit"
                :emprestimo="$emprestimo"
                :livros="$livros"
                :usuarios="$usuarios"
            />


            {{-- Botões --}}
            <div class="mt-8 flex justify-end gap-3">

                <x-button
                    text="Cancelar"
                    type="button"
                    color="slate"
                    onclick="history.back()"
                    class="!bg-white !text-slate-700 !ring-1 !ring-slate-300 hover:!bg-slate-50"
                />

                <x-button
                    text="Salvar alterações"
                    type="submit"
                    color="green"
                />

            </div>

        </form>

    </div>

</div>

@endsection
