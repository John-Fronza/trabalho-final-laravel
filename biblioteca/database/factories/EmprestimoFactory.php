<?php

namespace Database\Factories;

use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Emprestimo>
 */
class EmprestimoFactory extends Factory
{
    protected $model = Emprestimo::class;

    public function definition(): array
    {
        $dataEmprestimo = fake()->dateTimeBetween('-60 days', 'now');
        $dataDevolucaoPrevista = (clone $dataEmprestimo)->modify('+14 days');

        $emprestado = fake()->boolean(50);

        return [
            'livro_id' => Livro::inRandomOrder()->first()->id,
            'usuario_id' => Usuario::inRandomOrder()->first()->id,
            'data_emprestimo' => $dataEmprestimo,
            'data_devolucao_prevista' => $dataDevolucaoPrevista,
            'data_devolucao' => $emprestado
                ? null
                : fake()->dateTimeBetween(
                    $dataEmprestimo,
                    'now'
                ),
            'emprestado' => $emprestado,
            'observacoes' => fake()->optional()->sentence(),
        ];
    }
}