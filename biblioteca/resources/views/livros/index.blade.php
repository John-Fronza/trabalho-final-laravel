@extends('app')

@section('title', 'Livros')

@section('content')

    <h1>Livros</h1>

    <a href="{{ route('livros.create') }}">
        Cadastrar novo livro
    </a>

    <hr>

    @if ($livros->isEmpty())

        <p>Nenhum livro cadastrado.</p>

    @else

        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Categoria</th>
                    <th>Exemplares</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($livros as $livro)
                    <tr>
                        <td>{{ $livro->titulo }}</td>
                        <td>{{ $livro->autor }}</td>
                        <td>{{ $livro->categoria }}</td>
                        <td>
                            {{ $livro->exemplares_disponiveis }}
                            /
                            {{ $livro->exemplares_totais }}
                        </td>
                        <td>
                            <a href="{{ route('livros.show', $livro) }}">
                                Ver
                            </a>

                            <a href="{{ route('livros.edit', $livro) }}">
                                Editar
                            </a>

                            <form
                                action="{{ route('livros.destroy', $livro) }}"
                                method="POST"
                                style="display: inline;"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif

@endsection