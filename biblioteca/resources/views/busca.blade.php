@extends('app')

@section('title', 'Buscar')

@section('content')

    <div class="mx-auto max-w-3xl">

        <x-page-header
            title="Buscar"
            description="Encontre livros e usuários cadastrados na biblioteca."
        />

        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

            <form action="{{ route('busca.index') }}" method="GET">

                <div class="grid gap-5 sm:grid-cols-2">

                    {{-- Tipo --}}
                    <div>
                        <label
                            for="tipo"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            O que deseja buscar?
                        </label>

                        <select
                            id="tipo"
                            name="tipo"
                            required
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-slate-800 shadow-sm outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                        >
                            <option
                                value="livro"
                                {{ $tipo === 'livro' ? 'selected' : '' }}
                            >
                                Livro
                            </option>

                            <option
                                value="usuario"
                                {{ $tipo === 'usuario' ? 'selected' : '' }}
                            >
                                Usuário
                            </option>
                        </select>
                    </div>

                    {{-- Modo --}}
                    <div>
                        <label
                            for="modo"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Buscar por
                        </label>

                        <select
                            id="modo"
                            name="modo"
                            required
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-slate-800 shadow-sm outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                        >
                            <option
                                value="nome"
                                {{ $modo === 'nome' ? 'selected' : '' }}
                            >
                                Nome
                            </option>

                            <option
                                value="id"
                                {{ $modo === 'id' ? 'selected' : '' }}
                            >
                                ID
                            </option>
                        </select>
                    </div>

                </div>

                {{-- Termo --}}
                <div class="mt-5">

                    <label
                        for="termo"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Termo da busca
                    </label>

                    <input
                        type="text"
                        id="termo"
                        name="termo"
                        value="{{ $termo }}"
                        required
                        class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                    >

                </div>

                <div class="mt-6 flex justify-end">

                    <x-button
                        text="Buscar"
                        type="submit"
                        color="slate"
                    />

                </div>

            </form>

        </div>

        @if ($termo)

            <div class="mt-8">

                <h2 class="mb-4 text-xl font-semibold text-slate-900">
                    Resultados da busca
                </h2>

                {{-- ID não encontrado --}}
                @if ($mensagem)

                    <x-empty-state
                        title="Nenhum resultado encontrado"
                        message="{{ $mensagem }}"
                    />

                {{-- Busca por nome sem resultados --}}
                @elseif ($resultados->isEmpty())

                    <x-empty-state
                        title="Nenhum resultado encontrado"
                        message="Não encontramos nenhum registro que corresponda à sua busca."
                    />

                @else

                    {{-- Tabela de resultados --}}
                    <x-table>

                        <x-slot:head>

                            <tr>

                                @if ($tipo === 'livro')

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
                                        Ações
                                    </th>

                                @else

                                    <th class="px-5 py-3 font-semibold">
                                        ID
                                    </th>

                                    <th class="px-5 py-3 font-semibold">
                                        Nome
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

                        @foreach ($resultados as $resultado)

                            <tr class="transition hover:bg-slate-50">

                                <td class="px-5 py-4 text-slate-600">
                                    {{ $resultado->id }}
                                </td>

                                @if ($tipo === 'livro')

                                    <td class="px-5 py-4 font-medium text-slate-800">
                                        {{ $resultado->titulo }}
                                    </td>

                                    <td class="px-5 py-4 text-slate-600">
                                        {{ $resultado->autor }}
                                    </td>

                                    <td class="px-5 py-4">

                                        <a
                                            href="{{ route('livros.show', $resultado) }}"
                                            class="font-medium text-slate-700 hover:text-slate-950 hover:underline"
                                        >
                                            Ver livro
                                        </a>

                                    </td>

                                @else

                                    <td class="px-5 py-4 font-medium text-slate-800">
                                        {{ $resultado->nome }}
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