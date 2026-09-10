@extends('app')

@section('title', 'Empréstimos')

@section('content')

    <h1>Empréstimos</h1>

    <a href="{{ route('emprestimos.create') }}">
        Registrar novo empréstimo
    </a>

    <hr>

    @if ($emprestimos->isEmpty())

        <p>Nenhum empréstimo cadastrado.</p>

    @else

        <table border="1" cellpadding="8" cellspacing="0">

            <thead>
                <tr>
                    <th>Livro</th>
                    <th>Usuário</th>
                    <th>Data do empréstimo</th>
                    <th>Devolução prevista</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($emprestimos as $emprestimo)

                    <tr>

                        <td>
                            <a href="{{ route('livros.show', $emprestimo->livro) }}">
                                {{ $emprestimo->livro->titulo }}
                            </a>
                        </td>

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

                            @if ($emprestimo->emprestado)
                                Emprestado
                            @else
                                Devolvido
                            @endif

                        </td>

                        <td>

                            <a href="{{ route('emprestimos.show', $emprestimo) }}">
                                Ver
                            </a>

                            <a href="{{ route('emprestimos.edit', $emprestimo) }}">
                                Editar
                            </a>

                            <form
                                action="{{ route('emprestimos.destroy', $emprestimo) }}"
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