@extends('app')

@section('title', 'Empréstimos')

@section('content')

<div class="mx-auto max-w-6xl">

{{-- Cabeçalho --}}
<x-page-header
    title="Empréstimos"
    description="Gerencie os empréstimos realizados na biblioteca."
>
    <x-slot:actions>

        <x-button
            text="+ Registrar empréstimo"
            :href="route('emprestimos.create')"
        />

    </x-slot:actions>
</x-page-header>

{{-- Tabela --}}
@if ($emprestimos->isEmpty())
    <x-empty-state 
        title="Nenhum empréstimo registrado" 
        message="Registre um empréstimo para acompanhar os livros emprestados."
    />
@else

    <x-table>

        {{-- Cabeçalho da tabela --}}
        <x-slot:head>

            <tr>

                <th class="px-5 py-3 font-semibold">
                    ID
                </th>

                <th class="px-5 py-3 font-semibold">
                    Livro
                </th>

                <th class="px-5 py-3 font-semibold">
                    Usuário
                </th>

                <th class="px-5 py-3 font-semibold">
                    Empréstimo
                </th>

                <th class="px-5 py-3 font-semibold">
                    Devolução prevista
                </th>

                <th class="px-5 py-3 font-semibold">
                    Status
                </th>

                <th class="px-5 py-3 font-semibold">
                    Ações
                </th>

            </tr>

        </x-slot:head>


        {{-- Linhas da tabela --}}
        @foreach ($emprestimos as $emprestimo)

            <tr class="transition hover:bg-slate-50">

                <td class="px-5 py-4 font-medium text-slate-500">
                    #{{ $emprestimo->id }}
                </td>

                <td class="px-5 py-4 font-medium text-slate-900">
                    {{ $emprestimo->livro->titulo }}
                </td>

                <td class="px-5 py-4 text-slate-600">
                    {{ $emprestimo->usuario->nome }}
                </td>

                <td class="px-5 py-4 text-slate-600">
                    {{ $emprestimo->data_emprestimo->format('d/m/Y') }}
                </td>

                <td class="px-5 py-4 text-slate-600">
                    {{ $emprestimo->data_devolucao_prevista->format('d/m/Y') }}
                </td>

                <td class="px-5 py-4">
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
                </td>

                <td class="whitespace-nowrap px-5 py-4">

                    <div class="flex items-center gap-3">

                        <a
                            href="{{ route('emprestimos.show', $emprestimo) }}"
                            class="font-medium text-slate-700 hover:text-slate-950 hover:underline"
                        >
                            Ver
                        </a>

                        <a
                            href="{{ route('emprestimos.edit', $emprestimo) }}"
                            class="font-medium text-slate-700 hover:text-slate-950 hover:underline"
                        >
                            Editar
                        </a>

                        @if ($emprestimo->emprestado && !$emprestimo->data_devolucao_prevista->lt(today()))
                            <form 
                                action="{{ route('emprestimos.renovar', $emprestimo) }}" 
                                method="POST"
                            > 
                                @csrf 
                                <button 
                                    type="submit" 
                                    class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-1 text-xs font-medium text-yellow-700 transition hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-yellow-300"
                                >
                                    Renovar
                                </button>
                            </form>
                        @else
                            <button 
                                type="button" disabled 
                                class="inline-flex cursor-not-allowed items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-400"
                            >
                                Renovar
                            </button>
                        @endif

                        <form
                            id="delete-form-{{ $emprestimo->id }}"
                            action="{{ route('emprestimos.destroy', $emprestimo) }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')
                        </form>

                        <x-confirm
                            :id="$emprestimo->id"
                            title="Excluir empréstimo"
                            message="Tem certeza que deseja excluir este empréstimo?"
                            :form="'delete-form-' . $emprestimo->id"
                            confirm-text="Excluir empréstimo"
                        />

                    </div>

                </td>

            </tr>

        @endforeach

    </x-table>

@endif

</div>

@endsection
