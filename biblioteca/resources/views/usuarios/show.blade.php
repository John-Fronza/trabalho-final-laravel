@extends('app')

@section('title', 'Detalhes do Usuário')

@section('content')

    <h1>Detalhes do Usuário</h1>

    <p>
        <strong>ID:</strong>
        {{ $usuario->id }}
    </p>

    <p>
        <strong>Nome:</strong>
        {{ $usuario->nome }}
    </p>

    <p>
        <strong>CPF:</strong>
        {{ $usuario->cpf }}
    </p>

    <p>
        <strong>E-mail:</strong>
        {{ $usuario->email }}
    </p>

    <p>
        <strong>Telefone:</strong>
        {{ $usuario->telefone }}
    </p>

    <hr>

    <h2>Histórico de Empréstimos</h2>

    @if ($usuario->emprestimos->isEmpty())

        <p>
            Este usuário ainda não possui empréstimos registrados.
        </p>

    @else

        <table border="1" cellpadding="8" cellspacing="0">

            <thead>
                <tr>
                    <th>Livro</th>
                    <th>Data do empréstimo</th>
                    <th>Devolução prevista</th>
                    <th>Data de devolução</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($usuario->emprestimos as $emprestimo)

                    <tr>

                        <td>
                            <a href="{{ route('livros.show', $emprestimo->livro) }}">
                                {{ $emprestimo->livro->titulo }}
                            </a>
                        </td>

                        <td>
                            {{ $emprestimo->data_emprestimo->format('d/m/Y') }}
                        </td>

                        <td>
                            {{ $emprestimo->data_devolucao_prevista->format('d/m/Y') }}
                        </td>

                        <td>

                            @if ($emprestimo->data_devolucao)
                                {{ $emprestimo->data_devolucao->format('d/m/Y') }}
                            @else
                                —
                            @endif

                        </td>

                        <td>

                            @if ($emprestimo->emprestado)
                                Emprestado
                            @else
                                Devolvido
                            @endif

                        </td>

                        <td>
                            <a href="{{ route('emprestimos.show', $emprestimo) }}">
                                Ver empréstimo
                            </a>
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @endif

    <br>

    <a href="{{ route('usuarios.edit', $usuario) }}">
        Editar usuário
    </a>

    <button type="button" onclick="history.back()">
        ← Voltar
    </button>

@endsection