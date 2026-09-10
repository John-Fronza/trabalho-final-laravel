<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class LivroController extends Controller
{
    public function index()
    {
        $livros = Livro::all();

        return view('livros.index', compact('livros'));
    }

    public function create()
    {
        return view('livros.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:255|unique:livros,isbn',
            'categoria' => 'required|string|max:255',
            'ano_publicacao' => 'nullable|integer|min:1|max:2026',
            'exemplares_totais' => 'required|integer|min:1',
            'exemplares_disponiveis' => 'required|integer|min:0',
            'descricao' => 'nullable|string',
        ]);

        if ($dados['exemplares_disponiveis'] > $dados['exemplares_totais']) {
            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'A quantidade disponível não pode ser maior que a quantidade total.');
        }

        try {
            Livro::create($dados);

            return redirect()
                ->route('livros.index')
                ->with('sucesso', 'Livro cadastrado com sucesso!');
        } catch (QueryException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível cadastrar o livro.');
        }
    }

    public function show(Livro $livro)
    {
        $livro->load('emprestimos.usuario');
        
        return view('livros.show', compact('livro'));
    }

    public function edit(Livro $livro)
    {
        return view('livros.edit', compact('livro'));
    }

    public function update(Request $request, Livro $livro)
    {
        $dados = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:255|unique:livros,isbn,' . $livro->id,
            'categoria' => 'required|string|max:255',
            'ano_publicacao' => 'nullable|integer|min:1|max:2026',
            'exemplares_totais' => 'required|integer|min:1',
            'exemplares_disponiveis' => 'required|integer|min:0',
            'descricao' => 'nullable|string',
        ]);

        if ($dados['exemplares_disponiveis'] > $dados['exemplares_totais']) {
            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'A quantidade disponível não pode ser maior que a quantidade total.');
        }

        try {
            $livro->update($dados);

            return redirect()
                ->route('livros.index')
                ->with('sucesso', 'Livro atualizado com sucesso!');
        } catch (QueryException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível atualizar o livro.');
        }
    }

    public function destroy(Livro $livro)
    {
        try {
            $livro->delete();

            return redirect()
                ->route('livros.index')
                ->with('sucesso', 'Livro excluído com sucesso!');
        } catch (QueryException $e) {
            return redirect()
                ->back()
                ->with('erro', 'Não foi possível excluir o livro. Verifique se existem empréstimos relacionados.');
        }
    }
}