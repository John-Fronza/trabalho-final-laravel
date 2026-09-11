@extends('app')

@section('title', 'Início')

@section('content')

    <div class="">

        {{-- Cabeçalho --}}
        <div>

            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                Bem-vindo à Biblioteca
            </h1>

            <p class="mt-2 text-slate-600">
                Gerencie o acervo, os usuários e os empréstimos da biblioteca.
            </p>

        </div>


        {{-- Indicadores --}}
        <div class="mt-6 flex gap-5">

            {{-- Livros --}}
            <div class="flex-1 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                <p class="text-sm font-medium text-slate-500">
                    Livros
                </p>

                <p class="mt-2 text-3xl font-bold text-slate-900">
                    {{ $quantidadeLivros }}
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    livros cadastrados
                </p>

            </div>


            {{-- Usuários --}}
            <div class="flex-1 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                <p class="text-sm font-medium text-slate-500">
                    Usuários
                </p>

                <p class="mt-2 text-3xl font-bold text-slate-900">
                    {{ $quantidadeUsuarios }}
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    usuários cadastrados
                </p>

            </div>


            {{-- Empréstimos ativos --}}
            <div class="flex-1 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                <p class="text-sm font-medium text-slate-500">
                    Empréstimos ativos
                </p>

                <p class="mt-2 text-3xl font-bold text-slate-900">
                    {{ $emprestimosAtivos }}
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    empréstimos em andamento
                </p>

            </div>

        </div>


        {{-- Aviso de empréstimos atrasados --}}
        @if ($emprestimosAtrasados > 0)

            <div class="mt-6 rounded-xl border border-red-200 bg-red-50 p-5">

                <div class="flex items-start gap-4">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600">
                        ⚠
                    </div>

                    <div>

                        <h2 class="font-semibold text-red-800">
                            Atenção aos empréstimos atrasados
                        </h2>

                        <p class="mt-1 text-sm text-red-700">
                            Existem
                            <strong>{{ $emprestimosAtrasados }}</strong>
                            empréstimo(s) com a data de devolução ultrapassada.
                        </p>

                        <a
                            href="{{ route('emprestimos.index') }}"
                            class="mt-3 inline-block text-sm font-medium text-red-800 hover:underline"
                        >
                            Ver empréstimos →
                        </a>

                    </div>

                </div>

            </div>

        @else

            <div class="mt-6 rounded-xl border border-green-200 bg-green-50 p-5">

                <div class="flex items-start gap-4">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-600">
                        ✓
                    </div>

                    <div>

                        <h2 class="font-semibold text-green-800">
                            Tudo em dia
                        </h2>

                        <p class="mt-1 text-sm text-green-700">
                            Não existem empréstimos atrasados no momento.
                        </p>

                    </div>

                </div>

            </div>

        @endif


        {{-- Acesso rápido --}}
        <div class="mt-8">

            <h2 class="mb-4 text-xl font-semibold text-slate-900">
                Acesso rápido
            </h2>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

                <x-button
                    text="Cadastrar livro"
                    :href="route('livros.create')"
                    color="slate"
                />

                <x-button
                    text="Cadastrar usuário"
                    :href="route('usuarios.create')"
                    color="slate"
                />

                <x-button
                    text="Novo empréstimo"
                    :href="route('emprestimos.create')"
                    color="green"
                />

                <x-button
                    text="Buscar"
                    :href="route('busca.index')"
                    color="slate"
                />

            </div>

        </div>

    </div>

@endsection