<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmprestimoController;

Route::resource('livros', LivroController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('emprestimos', EmprestimoController::class);