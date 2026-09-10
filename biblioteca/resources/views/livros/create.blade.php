@extends('app')

@section('title', 'Cadastrar Livro')

@section('content')

    <h1>Cadastrar Livro</h1>

    @if ($errors->any())
        <div class="erro">
            <strong>Corrija os seguintes erros:</strong>

            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('livros.store') }}" method="POST">

        @csrf

        <div>
            <label for="titulo">Título:</label>
            <input
                type="text"
                id="titulo"
                name="titulo"
                value="{{ old('titulo') }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="autor">Autor:</label>
            <input
                type="text"
                id="autor"
                name="autor"
                value="{{ old('autor') }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="isbn">ISBN:</label>
            <input
                type="text"
                id="isbn"
                name="isbn"
                value="{{ old('isbn') }}"
            >
        </div>

        <br>

        <div>
            <label for="categoria">Categoria:</label>
            <select id="categoria" name="categoria" required>
                <option value="">Selecione uma categoria</option>
                <option value="Fantasia">Fantasia</option>
                <option value="Ficção">Ficção</option>
                <option value="Romance">Romance</option>
                <option value="Aventura">Aventura</option>
                <option value="Terror">Terror</option>
                <option value="Mistério">Mistério</option>
                <option value="Biografia">Biografia</option>
            </select>
        </div>

        <br>

        <div>
            <label for="ano_publicacao">Ano de publicação:</label>
            <input
                type="number"
                id="ano_publicacao"
                name="ano_publicacao"
                value="{{ old('ano_publicacao') }}"
            >
        </div>

        <br>

        <div>
            <label for="exemplares_totais">Exemplares totais:</label>
            <input
                type="number"
                id="exemplares_totais"
                name="exemplares_totais"
                value="{{ old('exemplares_totais', 1) }}"
                min="1"
                required
            >
        </div>

        <br>

        <div>
            <label for="exemplares_disponiveis">Exemplares disponíveis:</label>
            <input
                type="number"
                id="exemplares_disponiveis"
                name="exemplares_disponiveis"
                value="{{ old('exemplares_disponiveis', 1) }}"
                min="0"
                required
            >
        </div>

        <br>

        <div>
            <label for="descricao">Descrição:</label>
            <br>
            <textarea
                id="descricao"
                name="descricao"
                rows="5"
                cols="50"
            >{{ old('descricao') }}</textarea>
        </div>

        <br>

        <button type="submit">Cadastrar Livro</button>

        <a href="{{ route('livros.index') }}">
            Cancelar
        </a>

    </form>

@endsection