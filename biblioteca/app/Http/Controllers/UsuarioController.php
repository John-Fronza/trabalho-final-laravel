<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'cpf' => 'required|string|size:11|unique:usuarios,cpf',
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
        ]);

        try {
            Usuario::create($dados);

            return redirect()
                ->route('usuarios.index')
                ->with('sucesso', 'Usuário cadastrado com sucesso!');
        } catch (QueryException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível cadastrar o usuário.');
        }
    }

    public function show(Usuario $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $dados = $request->validate([
            'cpf' => 'required|string|size:11|unique:usuarios,cpf,' . $usuario->id,
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
        ]);

        try {
            $usuario->update($dados);

            return redirect()
                ->route('usuarios.index')
                ->with('sucesso', 'Usuário atualizado com sucesso!');
        } catch (QueryException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível atualizar o usuário.');
        }
    }

    public function destroy(Usuario $usuario)
    {
        try {
            $usuario->delete();

            return redirect()
                ->route('usuarios.index')
                ->with('sucesso', 'Usuário excluído com sucesso!');
        } catch (QueryException $e) {
            return redirect()
                ->back()
                ->with('erro', 'Não foi possível excluir o usuário. Verifique se existem empréstimos relacionados.');
        }
    }
}