@extends('app')

@section('title', 'Detalhes do Empréstimo')

@section('content')

    <div class="mx-auto max-w-3xl">

        <x-page-header
            title="Detalhes do empréstimo"
            description="Visualize as informações do empréstimo registrado."
        />

        {{-- Informações do empréstimo --}}
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

            <dl class="grid gap-6 sm:grid-cols-2">

                <x-detail label="ID">
                    {{ $emprestimo->id }}
                </x-detail>

                <x-detail label="Livro">

                    <a
                        href="{{ route('livros.show', $emprestimo->livro) }}"
                        class="font-medium text-slate-700 hover:text-slate-950 hover:underline"
                    >
                        {{ $emprestimo->livro->titulo }}
                    </a>

                </x-detail>

                <x-detail label="Usuário">

                    <a
                        href="{{ route('usuarios.show', $emprestimo->usuario) }}"
                        class="font-medium text-slate-700 hover:text-slate-950 hover:underline"
                    >
                        {{ $emprestimo->usuario->nome }}
                    </a>

                </x-detail>

                <x-detail label="Data do empréstimo">
                    {{ $emprestimo->data_emprestimo->format('d/m/Y') }}
                </x-detail>

                <x-detail label="Data prevista para devolução">
                    {{ $emprestimo->data_devolucao_prevista->format('d/m/Y') }}
                </x-detail>

                <x-detail label="Status">
                    @if ($emprestimo->emprestado)
                        @if ($emprestimo->data_devolucao_prevista->lt(today()))
                            <x-badge
                                text="Atrasado"
                                color="red"
                            />
                        @else
                            <x-badge
                                text="Emprestado"
                                color="yellow"
                            />
                        @endif
                    @else
                        <x-badge
                            text="Devolvido"
                            color="green"
                        />
                    @endif
                </x-detail>

                @if ($emprestimo->data_devolucao)

                    <x-detail label="Data de devolução">
                        {{ $emprestimo->data_devolucao->format('d/m/Y') }}
                    </x-detail>

                @endif

                <x-detail label="Observações">

                    @if ($emprestimo->observacoes)
                        {{ $emprestimo->observacoes }}
                    @else
                        Nenhuma observação.
                    @endif

                </x-detail>

            </dl>

        </div>

        {{-- Ações --}}
        <div class="mt-8 flex justify-end gap-3">

            @if ($emprestimo->emprestado && !$emprestimo->data_devolucao_prevista->lt(today()))

                <form
                    action="{{ route('emprestimos.renovar', $emprestimo) }}"
                    method="POST"
                >
                    @csrf

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-yellow-500 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-offset-2"
                    >
                        Renovar por 14 dias
                    </button>
                </form>

            @else

                <button
                    type="button"
                    disabled
                    class="inline-flex cursor-not-allowed items-center justify-center rounded-lg bg-slate-200 px-4 py-2.5 text-sm font-medium text-slate-400"
                >
                    Renovar por 14 dias
                </button>

            @endif

            <x-button
                text="Editar empréstimo"
                :href="route('emprestimos.edit', $emprestimo)"
                color="slate"
            />

            <x-button
                text="← Voltar"
                type="button"
                onclick="history.back()"
                color="slate"
                class="!bg-white !text-slate-700 !ring-1 !ring-slate-300 hover:!bg-slate-50"
            />

        </div>

    </div>

@endsection