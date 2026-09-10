<?php

namespace Database\Seeders;

use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class EmprestimoSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = Usuario::all();

        for ($i = 0; $i < 15; $i++) {

            $livro = Livro::where('exemplares_disponiveis', '>', 0)
                ->inRandomOrder()
                ->first();

            if (!$livro) {
                break;
            }

            $usuario = $usuarios->random();

            $emprestimo = Emprestimo::factory()->make([
                'livro_id' => $livro->id,
                'usuario_id' => $usuario->id,
            ]);

            $emprestimo->save();

            if ($emprestimo->emprestado) {
                $livro->decrement('exemplares_disponiveis');
            }
        }
    }
}