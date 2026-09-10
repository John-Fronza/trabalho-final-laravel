<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Emprestimo;

class Livro extends Model
{
    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }
    use HasFactory;

    protected $table = 'livros';

    protected $fillable = [
        'titulo',
        'autor',
        'isbn',
        'categoria',
        'ano_publicacao',
        'exemplares_totais',
        'exemplares_disponiveis',
        'descricao'
    ];
}

