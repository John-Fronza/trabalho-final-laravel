@extends('app')

@section('title', 'Detalhes do Livro')

@section('content')

    <h1>Detalhes do Livro</h1>

    <p>
        <strong>ID:</strong>
        {{ $livro->id }}
    </p>

    <p>
        <strong>Título:</strong>
        {{ $livro->titulo }}
    </p>

    <p>
        <strong>Autor:</strong>
        {{ $livro->autor }}
    </p>

    <p>
        <strong>Categoria:</strong>
        {{ $livro->categoria }}
    </p>

    @isset($livro->isbn)
        <p>
            <strong>ISBN:</strong>
            {{ $livro->isbn }}
        </p>
    @else
        <p>
            <strong>ISBN:</strong>
            Não informado.
        </p>
    @endisset

    @if ($livro->ano_publicacao)
        <p>
            <strong>Ano de publicação:</strong>
            {{ $livro->ano_publicacao }}
        </p>
    @endif

    <p>
        <strong>Exemplares disponíveis:</strong>
        {{ $livro->exemplares_disponiveis }}
        /
        {{ $livro->exemplares_totais }}
    </p>

    <p>
        <strong>Descrição:</strong>
    </p>

    @if ($livro->descricao)
        <p>
            {{ $livro->descricao }}
        </p>
    @else
        <p>
            Nenhuma descrição cadastrada.
        </p>
    @endif

    <hr>

    <h2>Histórico de Empréstimos</h2>

    @if ($livro->emprestimos->isEmpty())

        <p>
            Este livro ainda não possui empréstimos registrados.
        </p>

    @else

        <table border="1" cellpadding="8" cellspacing="0">

            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Data do empréstimo</th>
                    <th>Devolução prevista</th>
                    <th>Data de devolução</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($livro->emprestimos as $emprestimo)

                    <tr>

                        <td>
                            <a href="{{ route('usuarios.show', $emprestimo->usuario) }}">
                                {{ $emprestimo->usuario->nome }}
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

    <a href="{{ route('livros.edit', $livro) }}">
        Editar livro
    </a>

    <button type="button" onclick="history.back()">
        ← Voltar
    </button>

@endsection