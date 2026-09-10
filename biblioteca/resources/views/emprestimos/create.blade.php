@extends('app')

@section('title', 'Registrar Empréstimo')

@section('content')

    <h1>Registrar Empréstimo</h1>

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

    <form action="{{ route('emprestimos.store') }}" method="POST">

        @csrf

        <div>
            <label for="livro_id">Livro:</label>

            <select id="livro_id" name="livro_id" required>

                <option value="">
                    Selecione um livro
                </option>

                @foreach ($livros as $livro)

                    <option
                        value="{{ $livro->id }}"
                        {{ old('livro_id') == $livro->id ? 'selected' : '' }}
                    >
                        {{ $livro->titulo }}
                        ({{ $livro->exemplares_disponiveis }} disponíveis)
                    </option>

                @endforeach

            </select>
        </div>

        <br>

        <div>
            <label for="usuario_id">Usuário:</label>

            <select id="usuario_id" name="usuario_id" required>

                <option value="">
                    Selecione um usuário
                </option>

                @foreach ($usuarios as $usuario)

                    <option
                        value="{{ $usuario->id }}"
                        {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}
                    >
                        {{ $usuario->nome }}
                    </option>

                @endforeach

            </select>
        </div>

        <br>

        <div>
            <label for="data_emprestimo">
                Data do empréstimo:
            </label>

            <input
                type="date"
                id="data_emprestimo"
                name="data_emprestimo"
                value="{{ old('data_emprestimo', $dataEmprestimo) }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="data_devolucao_prevista">
                Data prevista para devolução:
            </label>

            <input
                type="date"
                id="data_devolucao_prevista"
                name="data_devolucao_prevista"
                value="{{ old('data_devolucao_prevista', $dataDevolucaoPrevista) }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="observacoes">
                Observações:
            </label>

            <br>

            <textarea
                id="observacoes"
                name="observacoes"
                rows="5"
                cols="50"
            >{{ old('observacoes') }}</textarea>
        </div>

        <br>

        <button type="submit">
            Registrar Empréstimo
        </button>

        <a href="{{ route('emprestimos.index') }}">
            Cancelar
        </a>

    </form>

@endsection