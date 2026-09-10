@extends('app')

@section('title', $usuario->nome)

@section('content')

    <h1>{{ $usuario->nome }}</h1>

    <p>
        <strong>CPF:</strong>
        {{ $usuario->cpf }}
    </p>

    <p>
        <strong>E-mail:</strong>
        {{ $usuario->email }}
    </p>

    <p>
        <strong>Telefone:</strong>
        {{ $usuario->telefone }}
    </p>

    <br>

    <a href="{{ route('usuarios.edit', $usuario) }}">
        Editar usuário
    </a>

    <a href="{{ route('usuarios.index') }}">
        Voltar para usuários
    </a>

@endsection