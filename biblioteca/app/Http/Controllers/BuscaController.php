<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Usuario;
use Illuminate\Http\Request;

class BuscaController extends Controller
{
    public function index(Request $request)
    {
        $tipo = $request->input('tipo');
        $modo = $request->input('modo', 'nome');
        $termo = $request->input('termo');

        // Se a pesquisa for por ID
        if ($modo === 'id' && $termo) {

            if ($tipo === 'livro') {

                return redirect()->route('busca.livro.id', [
                    'id' => $termo
                ]);

            }

            if ($tipo === 'usuario') {

                return redirect()->route('busca.usuario.id', [
                    'id' => $termo
                ]);
            }
        }

        // Pesquisa por nome
        $resultados = collect();

        if ($modo === 'nome' && $termo) {

            if ($tipo === 'livro') {

                $resultados = Livro::where(
                    'titulo',
                    'like',
                    '%' . $termo . '%'
                )->get();

            } elseif ($tipo === 'usuario') {

                $resultados = Usuario::where(
                    'nome',
                    'like',
                    '%' . $termo . '%'
                )->get();
            }
        }

        return view('busca', compact(
            'tipo',
            'modo',
            'termo',
            'resultados'
        ));
    }

    public function buscarLivroPorId($id)
    {
        $livro = Livro::findOrFail($id);

        $livro->load('emprestimos.usuario');

        return view('livros.show', compact('livro'));
    }

    public function buscarUsuarioPorId($id)
    {
        $usuario = Usuario::findOrFail($id);

        $usuario->load('emprestimos.livro');

        return view('usuarios.show', compact('usuario'));
    }
}