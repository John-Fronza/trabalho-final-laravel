<?php

namespace Database\Factories;

use App\Models\Livro;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Livro>
 */
class LivroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $exemplaresTotais = fake()->numberBetween(1, 10);
        $exemplaresDisponiveis = fake()->numberBetween(0, $exemplaresTotais);

        return [
        'titulo' => fake()->sentence(3),
        'autor' => fake()->name(),
        'isbn' => fake()->unique()->numerify('978#############'),
        'categoria' => fake()->randomElement([
            'Fantasia',
            'Ficção',
            'Romance',
            'Aventura',
            'Terror',
            'Mistério',
            'Biografia'
        ]),
        'ano_publicacao' => fake()->numberBetween(1900, 2026),
        'exemplares_totais' => $exemplaresTotais,
        'exemplares_disponiveis' => $exemplaresDisponiveis,
        'descricao' => fake()->paragraph()
        ];
    }
}
