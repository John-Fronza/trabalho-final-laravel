<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Livro;
use App\Models\Usuario;

class Emprestimo extends Model
{
    use HasFactory;
    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }


    protected $table = 'emprestimos';

    protected $fillable = [
        'livro_id',
        'usuario_id',
        'data_emprestimo',
        'data_devolucao_prevista',
        'data_devolucao',
        'emprestado',
        'observacoes',
    ];

    protected $casts = [
        'data_emprestimo' => 'date',
        'data_devolucao_prevista' => 'date',
        'data_devolucao' => 'date',
        'emprestado' => 'boolean',
    ];
}