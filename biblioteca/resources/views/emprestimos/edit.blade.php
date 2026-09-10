@extends('app')

@section('title', 'Editar Empréstimo')

@section('content')

    <h1>Editar Empréstimo</h1>

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

    <form
        action="{{ route('emprestimos.update', $emprestimo) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div>
            <label for="livro_id">Livro:</label>

            <select id="livro_id" name="livro_id" required>

                @foreach ($livros as $livro)

                    <option
                        value="{{ $livro->id }}"
                        {{ old('livro_id', $emprestimo->livro_id) == $livro->id ? 'selected' : '' }}
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

                @foreach ($usuarios as $usuario)

                    <option
                        value="{{ $usuario->id }}"
                        {{ old('usuario_id', $emprestimo->usuario_id) == $usuario->id ? 'selected' : '' }}
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
                value="{{ old('data_emprestimo', $emprestimo->data_emprestimo->format('Y-m-d')) }}"
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
                value="{{ old('data_devolucao_prevista', $emprestimo->data_devolucao_prevista->format('Y-m-d')) }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="data_devolucao">
                Data de devolução:
            </label>

            <input
                type="date"
                id="data_devolucao"
                name="data_devolucao"
                value="{{ old('data_devolucao', $emprestimo->data_devolucao?->format('Y-m-d')) }}"
            >
        </div>

        <br>

        <div>
            <label for="emprestado">
                Status:
            </label>

            <select id="emprestado" name="emprestado" required>

                <option
                    value="1"
                    {{ old('emprestado', $emprestimo->emprestado) == 1 ? 'selected' : '' }}
                >
                    Emprestado
                </option>

                <option
                    value="0"
                    {{ old('emprestado', $emprestimo->emprestado) == 0 ? 'selected' : '' }}
                >
                    Devolvido
                </option>

            </select>
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
            >{{ old('observacoes', $emprestimo->observacoes) }}</textarea>
        </div>

        <br>

        <button type="submit">
            Salvar alterações
        </button>

        <a href="{{ route('emprestimos.show', $emprestimo) }}">
            Cancelar
        </a>

    </form>

@endsection