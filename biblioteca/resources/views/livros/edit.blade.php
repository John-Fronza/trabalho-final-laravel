@extends('app')

@section('title', 'Editar Livro')

@section('content')

    <h1>Editar Livro</h1>

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

    <form action="{{ route('livros.update', $livro) }}" method="POST">

        @csrf
        @method('PUT')

        <div>
            <label for="titulo">Título:</label>
            <input
                type="text"
                id="titulo"
                name="titulo"
                value="{{ old('titulo', $livro->titulo) }}"
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
                value="{{ old('autor', $livro->autor) }}"
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
                value="{{ old('isbn', $livro->isbn) }}"
            >
        </div>

        <br>

        <div>
            <label for="categoria">Categoria:</label>
            <select id="categoria" name="categoria" required>
                <option value="Fantasia" {{ $livro->categoria == 'Fantasia' ? 'selected' : '' }}>Fantasia</option>
                <option value="Ficção" {{ $livro->categoria == 'Ficção' ? 'selected' : '' }}>Ficção</option>
                <option value="Romance" {{ $livro->categoria == 'Romance' ? 'selected' : '' }}>Romance</option>
                <option value="Aventura" {{ $livro->categoria == 'Aventura' ? 'selected' : '' }}>Aventura</option>
                <option value="Terror" {{ $livro->categoria == 'Terror' ? 'selected' : '' }}>Terror</option>
                <option value="Mistério" {{ $livro->categoria == 'Mistério' ? 'selected' : '' }}>Mistério</option>
                <option value="Biografia" {{ $livro->categoria == 'Biografia' ? 'selected' : '' }}>Biografia</option>
            </select>
        </div>

        <br>

        <div>
            <label for="ano_publicacao">Ano de publicação:</label>
            <input
                type="number"
                id="ano_publicacao"
                name="ano_publicacao"
                value="{{ old('ano_publicacao', $livro->ano_publicacao) }}"
            >
        </div>

        <br>

        <div>
            <label for="exemplares_totais">Exemplares totais:</label>
            <input
                type="number"
                id="exemplares_totais"
                name="exemplares_totais"
                value="{{ old('exemplares_totais', $livro->exemplares_totais) }}"
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
                value="{{ old('exemplares_disponiveis', $livro->exemplares_disponiveis) }}"
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
            >{{ old('descricao', $livro->descricao) }}</textarea>
        </div>

        <br>

        <button type="submit">Salvar alterações</button>

        <a href="{{ route('livros.show', $livro) }}">
            Cancelar
        </a>

    </form>

@endsection