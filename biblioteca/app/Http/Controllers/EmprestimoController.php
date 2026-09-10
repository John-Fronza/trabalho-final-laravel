<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class EmprestimoController extends Controller
{
    public function index()
    {
        $emprestimos = Emprestimo::with(['livro', 'usuario'])->get();

        return view('emprestimos.index', compact('emprestimos'));
    }

    public function create()
    {
        $livros = Livro::where('exemplares_disponiveis', '>', 0)->get();
        $usuarios = Usuario::all();

        return view('emprestimos.create', compact('livros', 'usuarios'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'livro_id' => 'required|exists:livros,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'data_emprestimo' => 'required|date',
            'data_devolucao_prevista' => 'required|date|after_or_equal:data_emprestimo',
            'observacoes' => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($dados) {

                $livro = Livro::lockForUpdate()->findOrFail($dados['livro_id']);

                if ($livro->exemplares_disponiveis <= 0) {
                    throw new \Exception('Este livro não possui exemplares disponíveis.');
                }

                Emprestimo::create([
                    'livro_id' => $dados['livro_id'],
                    'usuario_id' => $dados['usuario_id'],
                    'data_emprestimo' => $dados['data_emprestimo'],
                    'data_devolucao_prevista' => $dados['data_devolucao_prevista'],
                    'data_devolucao' => null,
                    'emprestado' => true,
                    'observacoes' => $dados['observacoes'] ?? null,
                ]);

                $livro->decrement('exemplares_disponiveis');
            });

            return redirect()
                ->route('emprestimos.index')
                ->with('sucesso', 'Empréstimo registrado com sucesso!');

        } catch (QueryException $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível registrar o empréstimo.');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', $e->getMessage());
        }
    }

    public function show(Emprestimo $emprestimo)
    {
        $emprestimo->load(['livro', 'usuario']);

        return view('emprestimos.show', compact('emprestimo'));
    }

    public function edit(Emprestimo $emprestimo)
    {
        $livros = Livro::all();
        $usuarios = Usuario::all();

        return view(
            'emprestimos.edit',
            compact('emprestimo', 'livros', 'usuarios')
        );
    }

    public function update(Request $request, Emprestimo $emprestimo)
    {
        $dados = $request->validate([
            'livro_id' => 'required|exists:livros,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'data_emprestimo' => 'required|date',
            'data_devolucao_prevista' => 'required|date|after_or_equal:data_emprestimo',
            'data_devolucao' => 'nullable|date|after_or_equal:data_emprestimo',
            'emprestado' => 'required|boolean',
            'observacoes' => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($dados, $emprestimo) {

                $livroAntigo = Livro::lockForUpdate()
                    ->findOrFail($emprestimo->livro_id);

                $livroNovo = Livro::lockForUpdate()
                    ->findOrFail($dados['livro_id']);

                $livroMudou = $emprestimo->livro_id != $dados['livro_id'];

                $statusMudou = $emprestimo->emprestado != $dados['emprestado'];

                /*
                 * Se o empréstimo estava ativo e agora está sendo
                 * marcado como devolvido, devolvemos o exemplar.
                 */
                if ($emprestimo->emprestado && !$dados['emprestado']) {
                    $livroAntigo->increment('exemplares_disponiveis');

                    if (empty($dados['data_devolucao'])) {
                        $dados['data_devolucao'] = now()->toDateString();
                    }
                }

                /*
                 * Se o empréstimo estava devolvido e agora volta
                 * a ficar ativo, retiramos um exemplar.
                 */
                if (!$emprestimo->emprestado && $dados['emprestado']) {

                    if ($livroNovo->exemplares_disponiveis <= 0) {
                        throw new \Exception(
                            'Este livro não possui exemplares disponíveis.'
                        );
                    }

                    $livroNovo->decrement('exemplares_disponiveis');

                    $dados['data_devolucao'] = null;
                }

                /*
                 * Se o livro mudou enquanto o empréstimo estava ativo,
                 * devolvemos o exemplar ao livro antigo e retiramos
                 * um exemplar do novo livro.
                 */
                if ($livroMudou && $emprestimo->emprestado && $dados['emprestado']) {

                    $livroAntigo->increment('exemplares_disponiveis');

                    if ($livroNovo->exemplares_disponiveis <= 0) {
                        throw new \Exception(
                            'O novo livro não possui exemplares disponíveis.'
                        );
                    }

                    $livroNovo->decrement('exemplares_disponiveis');
                }

                /*
                 * Se o empréstimo está devolvido, não deve possuir
                 * data de devolução vazia.
                 */
                if (!$dados['emprestado'] && empty($dados['data_devolucao'])) {
                    $dados['data_devolucao'] = now()->toDateString();
                }

                $emprestimo->update($dados);
            });

            return redirect()
                ->route('emprestimos.index')
                ->with('sucesso', 'Empréstimo atualizado com sucesso!');

        } catch (QueryException $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível atualizar o empréstimo.');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', $e->getMessage());
        }
    }

    public function destroy(Emprestimo $emprestimo)
    {
        try {
            DB::transaction(function () use ($emprestimo) {

                if ($emprestimo->emprestado) {
                    $livro = Livro::lockForUpdate()
                        ->findOrFail($emprestimo->livro_id);

                    $livro->increment('exemplares_disponiveis');
                }

                $emprestimo->delete();
            });

            return redirect()
                ->route('emprestimos.index')
                ->with('sucesso', 'Empréstimo excluído com sucesso!');

        } catch (QueryException $e) {

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível excluir o empréstimo.');
        }
    }
}