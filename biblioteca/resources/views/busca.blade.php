@extends('app')

@section('title', 'Buscar')

@section('content')

<div class="mx-auto max-w-3xl">

    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold tracking-tight text-slate-900">
            Buscar
        </h1>

        <p class="mt-2 text-slate-600">
            Encontre livros e usuários cadastrados na biblioteca.
        </p>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

        <form action="{{ route('busca.index') }}" method="GET">

            <div class="grid gap-5 md:grid-cols-2">

                <div>
                    <label
                        for="tipo"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Pesquisar
                    </label>

                    <select
                        id="tipo"
                        name="tipo"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-slate-800 shadow-sm outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                    >
                        <option value="livro" {{ $tipo === 'livro' ? 'selected' : '' }}>
                            Livro
                        </option>

                        <option value="usuario" {{ $tipo === 'usuario' ? 'selected' : '' }}>
                            Usuário
                        </option>
                    </select>
                </div>

                <div>
                    <label
                        for="modo"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Pesquisar por
                    </label>

                    <select
                        id="modo"
                        name="modo"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-slate-800 shadow-sm outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                    >
                        <option value="nome" {{ $modo === 'nome' ? 'selected' : '' }}>
                            Nome
                        </option>

                        <option value="id" {{ $modo === 'id' ? 'selected' : '' }}>
                            ID
                        </option>
                    </select>
                </div>

            </div>

            <div class="mt-5">

                <label
                    for="termo"
                    class="mb-2 block text-sm font-medium text-slate-700"
                >
                    {{ $modo === 'id' ? 'ID' : 'Nome' }}
                </label>

                <div class="flex gap-3">

                    <input
                        type="text"
                        id="termo"
                        name="termo"
                        value="{{ $termo }}"
                        placeholder="{{ $modo === 'id' ? 'Digite o ID' : 'Digite o nome' }}"
                        class="min-w-0 flex-1 rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                    >

                    <x-button
                        text="Buscar"
                        type="submit"
                    />

                </div>

            </div>

        </form>

    </div>

    @if ($termo)

        <div class="mt-8">

            <h2 class="mb-4 text-xl font-semibold text-slate-900">
                Resultados para "{{ $termo }}"
            </h2>

            @if ($resultados->isEmpty())

                <div class="rounded-xl border border-slate-200 bg-white p-6 text-center shadow-sm">
                    <p class="text-slate-600">
                        Nenhum resultado encontrado.
                    </p>
                </div>

            @else

                <x-table>

                    {{-- Cabeçalho da tabela --}}
                    <x-slot:head>

                        <tr>

                            @if ($tipo === 'livro')

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
                                    Ações
                                </th>

                            @elseif ($tipo === 'usuario')

                                <th class="px-5 py-3 font-semibold">
                                    Nome
                                </th>

                                <th class="px-5 py-3 font-semibold">
                                    CPF
                                </th>

                                <th class="px-5 py-3 font-semibold">
                                    E-mail
                                </th>

                                <th class="px-5 py-3 font-semibold">
                                    Ações
                                </th>

                            @endif

                        </tr>

                    </x-slot:head>


                    {{-- Resultados --}}
                    @foreach ($resultados as $resultado)

                        <tr class="transition hover:bg-slate-50">

                            @if ($tipo === 'livro')

                                <td class="px-5 py-4 font-medium text-slate-900">
                                    {{ $resultado->titulo }}
                                </td>

                                <td class="px-5 py-4 text-slate-600">
                                    {{ $resultado->autor }}
                                </td>

                                <td class="px-5 py-4 text-slate-600">
                                    {{ $resultado->categoria }}
                                </td>

                                <td class="px-5 py-4">
                                    <a
                                        href="{{ route('livros.show', $resultado) }}"
                                        class="font-medium text-slate-700 hover:text-slate-950 hover:underline"
                                    >
                                        Ver livro
                                    </a>
                                </td>

                            @elseif ($tipo === 'usuario')

                                <td class="px-5 py-4 font-medium text-slate-900">
                                    {{ $resultado->nome }}
                                </td>

                                <td class="px-5 py-4 text-slate-600">
                                    {{ $resultado->cpf }}
                                </td>

                                <td class="px-5 py-4 text-slate-600">
                                    {{ $resultado->email }}
                                </td>

                                <td class="px-5 py-4">
                                    <a
                                        href="{{ route('usuarios.show', $resultado) }}"
                                        class="font-medium text-slate-700 hover:text-slate-950 hover:underline"
                                    >
                                        Ver usuário
                                    </a>
                                </td>

                            @endif

                        </tr>

                    @endforeach

                </x-table>

            @endif

        </div>

    @endif

</div>

@endsection
