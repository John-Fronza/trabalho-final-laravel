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

        $resultados = collect();
        $mensagem = null;

        /*
        |--------------------------------------------------------------------------
        | Busca por ID
        |--------------------------------------------------------------------------
        */

        if ($modo === 'id' && $termo) {

            if ($tipo === 'livro') {
                $livro = Livro::find($termo);

                if ($livro) {
                    return redirect()->route('busca.livro.id', [
                        'id' => $termo
                    ]);
                }

                $mensagem = 'Não encontramos nenhum livro com esse ID.';
            }

            if ($tipo === 'usuario') {
                $usuario = Usuario::find($termo);

                if ($usuario) {
                    return redirect()->route('busca.usuario.id', [
                        'id' => $termo
                    ]);
                }

                $mensagem = 'Não encontramos nenhum usuário com esse ID.';
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Busca por nome
        |--------------------------------------------------------------------------
        */

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
            'resultados',
            'mensagem'
        ));
    }

    public function buscarLivroPorId($id)
    {
        $livro = Livro::find($id);

        if (!$livro) {
            return redirect()->route('busca.index', [
                'tipo' => 'livro',
                'modo' => 'id',
                'termo' => $id,
            ]);
        }

        $livro->load('emprestimos.usuario');

        return view('livros.show', compact('livro'));
    }

    public function buscarUsuarioPorId($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return redirect()->route('busca.index', [
                'tipo' => 'usuario',
                'modo' => 'id',
                'termo' => $id,
            ]);
        }

        $usuario->load('emprestimos.livro');

        return view('usuarios.show', compact('usuario'));
    }
}