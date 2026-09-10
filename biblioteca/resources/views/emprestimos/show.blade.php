@extends('app')

@section('title', 'Detalhes do Empréstimo')

@section('content')

    <h1>Detalhes do Empréstimo</h1>

    <p>
        <strong>ID:</strong>
        {{ $emprestimo->id }}
    </p>

    <p>
        <strong>Livro:</strong>
        <a href="{{ route('livros.show', $emprestimo->livro) }}">
            {{ $emprestimo->livro->titulo }}
        </a>
    </p>

    <p>
        <strong>Usuário:</strong>
        <a href="{{ route('usuarios.show', $emprestimo->usuario) }}">
            {{ $emprestimo->usuario->nome }}
        </a>
    </p>

    <p>
        <strong>Data do empréstimo:</strong>
        {{ $emprestimo->data_emprestimo->format('d/m/Y') }}
    </p>

    <p>
        <strong>Data prevista para devolução:</strong>
        {{ $emprestimo->data_devolucao_prevista->format('d/m/Y') }}
    </p>

    <p>
        <strong>Status:</strong>

        @if ($emprestimo->emprestado)
            Emprestado
        @else
            Devolvido
        @endif
    </p>

    @if ($emprestimo->data_devolucao)

        <p>
            <strong>Data de devolução:</strong>
            {{ $emprestimo->data_devolucao->format('d/m/Y') }}
        </p>

    @endif

    <p>
        <strong>Observações:</strong>

        @if ($emprestimo->observacoes)
            {{ $emprestimo->observacoes }}
        @else
            Nenhuma observação.
        @endif
    </p>

    <br>

    <a href="{{ route('emprestimos.edit', $emprestimo) }}">
        Editar empréstimo
    </a>

    <button type="button" onclick="history.back()">
        ← Voltar
    </button>

@endsection