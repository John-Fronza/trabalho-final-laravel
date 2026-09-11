<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Usuario;
use App\Models\Emprestimo;

class HomeController extends Controller
{
    public function index()
    {
        $quantidadeLivros = Livro::count();

        $quantidadeUsuarios = Usuario::count();

        $emprestimosAtivos = Emprestimo::where(
            'emprestado',
            true
        )->count();

        $emprestimosAtrasados = Emprestimo::where(
            'emprestado',
            true
        )
            ->whereDate(
                'data_devolucao_prevista',
                '<',
                today()
            )
            ->count();

        return view('home', compact(
            'quantidadeLivros',
            'quantidadeUsuarios',
            'emprestimosAtivos',
            'emprestimosAtrasados'
        ));
    }
}