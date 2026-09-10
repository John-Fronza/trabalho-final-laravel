@extends('app')

@section('title', 'Buscar')

@section('content')

    <h1>Buscar</h1>

    <form action="{{ route('busca.index') }}" method="GET">

        <div>
            <label for="tipo">
                Pesquisar:
            </label>

            <select id="tipo" name="tipo">

                <option
                    value="livro"
                    {{ $tipo === 'livro' ? 'selected' : '' }}
                >
                    Livro
                </option>

                <option
                    value="usuario"
                    {{ $tipo === 'usuario' ? 'selected' : '' }}
                >
                    Usuário
                </option>

            </select>
        </div>

        <br>

        <div>
            <label for="modo">
                Pesquisar por:
            </label>

            <select id="modo" name="modo">
                <option
                    value="nome"
                    {{ $modo === 'nome' ? 'selected' : '' }}
                >
                    Nome
                </option>

                <option
                    value="id"
                    {{ $modo === 'id' ? 'selected' : '' }}
                >
                    ID
                </option>
            </select>
        </div>

        <br>

        <div>
            <label for="termo">
                {{ $modo === 'id' ? 'ID' : 'Nome' }}:
            </label>

            <input
                type="text"
                id="termo"
                name="termo"
                value="{{ $termo }}"
                placeholder="Digite o nome ou ID"
            >

            <button type="submit">
                Buscar
            </button>
        </div>

    </form>

    <hr>

    @if ($termo)

        <h2>
            Resultados para "{{ $termo }}"
        </h2>

        @if ($resultados->isEmpty())

            <p>
                Nenhum resultado encontrado.
            </p>

        @else

            <table border="1" cellpadding="8" cellspacing="0">

                <thead>

                    <tr>

                        @if ($tipo === 'livro')

                            <th>Título</th>
                            <th>Autor</th>
                            <th>Categoria</th>
                            <th>Ações</th>

                        @elseif ($tipo === 'usuario')

                            <th>Nome</th>
                            <th>CPF</th>
                            <th>E-mail</th>
                            <th>Ações</th>

                        @endif

                    </tr>

                </thead>

                <tbody>

                    @foreach ($resultados as $resultado)

                        <tr>

                            @if ($tipo === 'livro')

                                <td>
                                    {{ $resultado->titulo }}
                                </td>

                                <td>
                                    {{ $resultado->autor }}
                                </td>

                                <td>
                                    {{ $resultado->categoria }}
                                </td>

                                <td>
                                    <a href="{{ route('livros.show', $resultado) }}">
                                        Ver livro
                                    </a>
                                </td>

                            @elseif ($tipo === 'usuario')

                                <td>
                                    {{ $resultado->nome }}
                                </td>

                                <td>
                                    {{ $resultado->cpf }}
                                </td>

                                <td>
                                    {{ $resultado->email }}
                                </td>

                                <td>
                                    <a href="{{ route('usuarios.show', $resultado) }}">
                                        Ver usuário
                                    </a>
                                </td>

                            @endif

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @endif

    @endif

@endsection