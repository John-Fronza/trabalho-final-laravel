@extends('app')

@section('title', 'Usuários')

@section('content')

<div class="mx-auto max-w-6xl">

{{-- Cabeçalho --}}
<x-page-header
    title="Usuários"
    description="Gerencie os usuários cadastrados na biblioteca."
>
    <x-slot:actions>

        <x-button
            text="+ Cadastrar usuário"
            :href="route('usuarios.create')"
        />

    </x-slot:actions>
</x-page-header>

{{-- Tabela --}}
@if ($usuarios->isEmpty())
    <x-empty-state 
        title="Nenhum usuário cadastrado" 
        message="Cadastre um usuário para começar a registrar empréstimos."
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
                    Nome
                </th>

                <th class="px-5 py-3 font-semibold">
                    CPF
                </th>

                <th class="px-5 py-3 font-semibold">
                    E-mail
                </th>

                <th class="px-5 py-3 font-semibold">
                    Telefone
                </th>

                <th class="px-5 py-3 font-semibold">
                    Ações
                </th>

            </tr>

        </x-slot:head>


        {{-- Linhas da tabela --}}
        @foreach ($usuarios as $usuario)

            <tr class="transition hover:bg-slate-50">

                <td class="px-5 py-4 font-medium text-slate-500">
                    #{{ $usuario->id }}
                </td>

                <td class="px-5 py-4 font-medium text-slate-900">
                    {{ $usuario->nome }}
                </td>

                <td class="px-5 py-4 text-slate-600">
                    {{ $usuario->cpf }}
                </td>

                <td class="px-5 py-4 text-slate-600">
                    {{ $usuario->email }}
                </td>

                <td class="px-5 py-4 text-slate-600">
                    {{ $usuario->telefone }}
                </td>

                <td class="px-5 py-4">

                    <div class="flex flex-wrap items-center gap-3">

                        <a
                            href="{{ route('usuarios.show', $usuario) }}"
                            class="font-medium text-slate-700 hover:text-slate-950 hover:underline"
                        >
                            Ver
                        </a>

                        <a
                            href="{{ route('usuarios.edit', $usuario) }}"
                            class="font-medium text-slate-700 hover:text-slate-950 hover:underline"
                        >
                            Editar
                        </a>

                        <form
                            id="delete-form-{{ $usuario->id }}"
                            action="{{ route('usuarios.destroy', $usuario) }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')
                        </form>

                        <x-confirm
                            :id="$usuario->id"
                            title="Excluir usuário"
                            :message="'Tem certeza que deseja excluir ' . $usuario->nome . '?'"
                            :form="'delete-form-' . $usuario->id"
                            confirm-text="Excluir usuário"
                        />

                    </div>

                </td>

            </tr>

        @endforeach

    </x-table>

@endif

</div>

@endsection
