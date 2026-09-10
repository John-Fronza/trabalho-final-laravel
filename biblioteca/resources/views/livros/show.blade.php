@extends('app')

@section('title', $livro->titulo)

@section('content')

    <h1>{{ $livro->titulo }}</h1>

    <p>
        <strong>Autor:</strong>
        {{ $livro->autor }}
    </p>

    <p>
        <strong>ISBN:</strong>
        @if ($livro->isbn)
            {{ $livro->isbn }}
        @else
            Não informado
        @endif
    </p>

    <p>
        <strong>Categoria:</strong>
        {{ $livro->categoria }}
    </p>

    <p>
        <strong>Ano de publicação:</strong>
        @if ($livro->ano_publicacao)
            {{ $livro->ano_publicacao }}
        @else
            Não informado
        @endif
    </p>

    <p>
        <strong>Exemplares:</strong>
        {{ $livro->exemplares_disponiveis }}
        disponíveis de
        {{ $livro->exemplares_totais }}
    </p>

    <h2>Descrição</h2>

    @if ($livro->descricao)
        <p>{{ $livro->descricao }}</p>
    @else
        <p>Este livro não possui descrição cadastrada.</p>
    @endif

    <br>

    <a href="{{ route('livros.edit', $livro) }}">
        Editar livro
    </a>

    <a href="{{ route('livros.index') }}">
        Voltar para livros
    </a>

@endsection