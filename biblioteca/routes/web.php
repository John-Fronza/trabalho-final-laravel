<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\BuscaController;

Route::get('/', function () {
    return redirect()->route('busca.index');
});

Route::resource('livros', LivroController::class);

Route::resource('usuarios', UsuarioController::class);

Route::resource('emprestimos', EmprestimoController::class);

Route::get('/busca', [BuscaController::class, 'index'])
    ->name('busca.index');

    Route::get('/busca/livro/{id}', [BuscaController::class, 'buscarLivroPorId'])
    ->where('id', '[0-9]+')
    ->name('busca.livro.id');

Route::get('/busca/usuario/{id}', [BuscaController::class, 'buscarUsuarioPorId'])
    ->where('id', '[0-9]+')
    ->name('busca.usuario.id');