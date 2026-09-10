@extends('app')

@section('title', 'Usuários')

@section('content')

    <h1>Usuários</h1>

    <a href="{{ route('usuarios.create') }}">
        Cadastrar novo usuário
    </a>

    <hr>

    @if ($usuarios->isEmpty())

        <p>Nenhum usuário cadastrado.</p>

    @else

        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($usuarios as $usuario)

                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->nome }}</td>
                        <td>{{ $usuario->cpf }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->telefone }}</td>

                        <td>

                            <a href="{{ route('usuarios.show', $usuario) }}">
                                Ver
                            </a>

                            <a href="{{ route('usuarios.edit', $usuario) }}">
                                Editar
                            </a>

                            <form
                                action="{{ route('usuarios.destroy', $usuario) }}"
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