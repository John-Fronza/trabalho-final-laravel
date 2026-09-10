@extends('app')

@section('title', 'Editar Usuário')

@section('content')

    <h1>Editar Usuário</h1>

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
        action="{{ route('usuarios.update', $usuario) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div>
            <label for="cpf">CPF:</label>

            <input
                type="text"
                id="cpf"
                name="cpf"
                value="{{ old('cpf', $usuario->cpf) }}"
                maxlength="11"
                required
            >
        </div>

        <br>

        <div>
            <label for="nome">Nome:</label>

            <input
                type="text"
                id="nome"
                name="nome"
                value="{{ old('nome', $usuario->nome) }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="email">E-mail:</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $usuario->email) }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="telefone">Telefone:</label>

            <input
                type="text"
                id="telefone"
                name="telefone"
                value="{{ old('telefone', $usuario->telefone) }}"
                required
            >
        </div>

        <br>

        <button type="submit">
            Salvar alterações
        </button>

        <a href="{{ route('usuarios.show', $usuario) }}">
            Cancelar
        </a>

    </form>

@endsection