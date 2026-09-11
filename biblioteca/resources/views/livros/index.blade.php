@extends('app')

@section('title', 'Livros')

@section('content')

<div class="mx-auto max-w-6xl">

    {{-- Cabeçalho --}}
    <x-page-header
        title="Livros"
        description="Gerencie os livros cadastrados na biblioteca."
    >
        <x-slot:actions>

            <x-button
                text="+ Cadastrar livro"
                :href="route('livros.create')"
            />

        </x-slot:actions>
    </x-page-header>

    {{-- Tabela --}}
    @if ($livros->isEmpty())

        <div class="rounded-xl bg-white p-8 text-center shadow-sm ring-1 ring-slate-200">

            <p class="text-slate-600">
                Nenhum livro cadastrado.
            </p>

            <a
                href="{{ route('livros.create') }}"
                class="mt-4 inline-block text-sm font-medium text-slate-700 hover:text-slate-950 hover:underline"
            >
                Cadastrar o primeiro livro
            </a>

        </div>

    @else

        <x-table>

            {{-- Cabeçalho da tabela --}}
            <x-slot:head>

                <tr>

                    <th class="px-5 py-3 font-semibold">
                        ID
                    </th>

                    <th class="px-5 py-3 font-semibold">
                        Título
                    </th>

                    <th class="px-5 py-3 font-semibold">
                        Autor
                    </th>

                    <th class="px-5 py-3 font-semibold">
                        Categoria
                    </th>

                    <th class="px-5 py-3 font-semibold">
                        Disponíveis
                    </th>

                    <th class="px-5 py-3 font-semibold">
                        Ações
                    </th>

                </tr>

            </x-slot:head>


            {{-- Linhas da tabela --}}
            @foreach ($livros as $livro)

                <tr class="transition hover:bg-slate-50">

                    <td class="px-5 py-4 font-medium text-slate-500">
                        #{{ $livro->id }}
                    </td>

                    <td class="px-5 py-4 font-medium text-slate-900">
                        {{ $livro->titulo }}
                    </td>

                    <td class="px-5 py-4 text-slate-600">
                        {{ $livro->autor }}
                    </td>

                    <td class="px-5 py-4 text-slate-600">
                        {{ $livro->categoria }}
                    </td>

                    <td class="px-5 py-4 text-slate-600">
                        {{ $livro->exemplares_disponiveis }}
                        /
                        {{ $livro->exemplares_totais }}
                    </td>

                    <td class="px-5 py-4">

                        <div class="flex flex-wrap items-center gap-3">

                            <a
                                href="{{ route('livros.show', $livro) }}"
                                class="font-medium text-slate-700 hover:text-slate-950 hover:underline"
                            >
                                Ver
                            </a>

                            <a
                                href="{{ route('livros.edit', $livro) }}"
                                class="font-medium text-slate-700 hover:text-slate-950 hover:underline"
                            >
                                Editar
                            </a>

                            <form
                                id="delete-form-{{ $livro->id }}"
                                action="{{ route('livros.destroy', $livro) }}"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE')
                            </form>

                            <x-confirm
                                :id="$livro->id"
                                title="Excluir livro"
                                :message="'Tem certeza que deseja excluir ' . $livro->titulo . '?'"
                                :form="'delete-form-' . $livro->id"
                                confirm-text="Excluir livro"
                            />

                        </div>

                    </td>

                </tr>

            @endforeach

        </x-table>

    @endif

</div>

@endsection
