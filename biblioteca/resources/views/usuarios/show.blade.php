@extends('app')

@section('title', 'Detalhes do Usuário')

@section('content')

    <div class="mx-auto max-w-5xl">

        <x-page-header
            title="Detalhes do usuário"
            description="Visualize as informações e o histórico de empréstimos do usuário."
        />

        {{-- Informações do usuário --}}
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

            <dl class="grid gap-6 sm:grid-cols-2">

                <x-detail label="ID">
                    {{ $usuario->id }}
                </x-detail>

                <x-detail label="Nome">
                    {{ $usuario->nome }}
                </x-detail>

                <x-detail label="CPF">
                    {{ $usuario->cpf }}
                </x-detail>

                <x-detail label="E-mail">
                    {{ $usuario->email }}
                </x-detail>

                <x-detail label="Telefone">
                    {{ $usuario->telefone }}
                </x-detail>

            </dl>

        </div>

        {{-- Histórico de empréstimos --}}
        <div class="mt-8">

            <h2 class="mb-4 text-xl font-semibold text-slate-900">
                Histórico de empréstimos
            </h2>

            @if ($usuario->emprestimos->isEmpty())

                <div class="rounded-xl border border-slate-200 bg-white p-6 text-center shadow-sm">

                    <p class="text-slate-600">
                        Este usuário ainda não possui empréstimos registrados.
                    </p>

                </div>

            @else

                <x-table>

                    <x-slot:head>

                        <tr>

                            <th class="px-5 py-3 font-semibold">
                                Livro
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

                    @foreach ($usuario->emprestimos as $emprestimo)

                        <tr class="transition hover:bg-slate-50">

                            <td class="px-5 py-4">

                                <a
                                    href="{{ route('livros.show', $emprestimo->livro) }}"
                                    class="font-medium text-slate-700 hover:text-slate-950 hover:underline"
                                >
                                    {{ $emprestimo->livro->titulo }}
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
                text="Editar usuário"
                :href="route('usuarios.edit', $usuario)"
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