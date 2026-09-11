```blade
@extends('app')

@section('title', 'Detalhes do Livro')

@section('content')

    <div class="mx-auto max-w-5xl">

        <x-page-header
            title="Detalhes do livro"
            description="Visualize as informações e o histórico de empréstimos do livro."
        />

        {{-- Informações do livro --}}
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

            <dl class="grid gap-6 sm:grid-cols-2">

                <x-detail label="ID">
                    {{ $livro->id }}
                </x-detail>

                <x-detail label="Título">
                    {{ $livro->titulo }}
                </x-detail>

                <x-detail label="Autor">
                    {{ $livro->autor }}
                </x-detail>

                <x-detail label="Categoria">
                    {{ $livro->categoria }}
                </x-detail>

                <x-detail label="ISBN">
                    @isset($livro->isbn)
                        {{ $livro->isbn }}
                    @else
                        Não informado.
                    @endisset
                </x-detail>

                @if ($livro->ano_publicacao)

                    <x-detail label="Ano de publicação">
                        {{ $livro->ano_publicacao }}
                    </x-detail>

                @endif

                <x-detail label="Exemplares disponíveis">
                    {{ $livro->exemplares_disponiveis }}
                    /
                    {{ $livro->exemplares_totais }}
                </x-detail>

                <x-detail label="Descrição">
                    @if ($livro->descricao)
                        {{ $livro->descricao }}
                    @else
                        Nenhuma descrição cadastrada.
                    @endif
                </x-detail>

            </dl>

        </div>

        {{-- Histórico de empréstimos --}}
        <div class="mt-8">

            <h2 class="mb-4 text-xl font-semibold text-slate-900">
                Histórico de empréstimos
            </h2>

            @if ($livro->emprestimos->isEmpty())

                <div class="rounded-xl border border-slate-200 bg-white p-6 text-center shadow-sm">

                    <p class="text-slate-600">
                        Este livro ainda não possui empréstimos registrados.
                    </p>

                </div>

            @else

                <x-table>

                    <x-slot:head>

                        <tr>

                            <th class="px-5 py-3 font-semibold">
                                Usuário
                            </th>

                            <th class="px-5 py-3 font-semibold">
                                Data do empréstimo
                            </th>

                            <th class="px-5 py-3 font-semibold">
                                Devolução prevista
                            </th>

                            <th class="px-5 py-3 font-semibold">
                                Data de devolução
                            </th>

                            <th class="px-5 py-3 font-semibold">
                                Status
                            </th>

                            <th class="px-5 py-3 font-semibold">
                                Ações
                            </th>

                        </tr>

                    </x-slot:head>

                    @foreach ($livro->emprestimos as $emprestimo)

                        <tr class="transition hover:bg-slate-50">

                            <td class="px-5 py-4">

                                <a
                                    href="{{ route('usuarios.show', $emprestimo->usuario) }}"
                                    class="font-medium text-slate-700 hover:text-slate-950 hover:underline"
                                >
                                    {{ $emprestimo->usuario->nome }}
                                </a>

                            </td>

                            <td class="px-5 py-4 text-slate-600">
                                {{ $emprestimo->data_emprestimo->format('d/m/Y') }}
                            </td>

                            <td class="px-5 py-4 text-slate-600">
                                {{ $emprestimo->data_devolucao_prevista->format('d/m/Y') }}
                            </td>

                            <td class="px-5 py-4 text-slate-600">

                                @if ($emprestimo->data_devolucao)
                                    {{ $emprestimo->data_devolucao->format('d/m/Y') }}
                                @else
                                    —
                                @endif

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

                            <td class="px-5 py-4">

                                <a
                                    href="{{ route('emprestimos.show', $emprestimo) }}"
                                    class="font-medium text-slate-700 hover:text-slate-950 hover:underline"
                                >
                                    Ver empréstimo
                                </a>

                            </td>

                        </tr>

                    @endforeach

                </x-table>

            @endif

        </div>

        {{-- Ações --}}
        <div class="mt-8 flex justify-end gap-3">

            <x-button
                text="Editar livro"
                :href="route('livros.edit', $livro)"
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
