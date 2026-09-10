<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;


class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;
    public function definition(): array
    {
        return [
            'cpf' => fake()->unique()->numerify('###########'),
            'nome' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telefone' => fake()->numerify('###########')
        ];
    }
}
