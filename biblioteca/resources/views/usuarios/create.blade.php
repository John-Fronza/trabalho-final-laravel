@extends('app')

@section('title', 'Cadastrar Usuário')

@section('content')

    <h1>Cadastrar Usuário</h1>

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

    <form action="{{ route('usuarios.store') }}" method="POST">

        @csrf

        <div>
            <label for="cpf">CPF:</label>

            <input
                type="text"
                id="cpf"
                name="cpf"
                value="{{ old('cpf') }}"
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
                value="{{ old('nome') }}"
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
                value="{{ old('email') }}"
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
                value="{{ old('telefone') }}"
                required
            >
        </div>

        <br>

        <button type="submit">
            Cadastrar Usuário
        </button>

        <a href="{{ route('usuarios.index') }}">
            Cancelar
        </a>

    </form>

@endsection