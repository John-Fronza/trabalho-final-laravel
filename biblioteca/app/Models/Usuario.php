<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Emprestimo;

class Usuario extends Model
{
    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }
    
    use HasFactory;
    protected $table = 'usuarios';

    protected $fillable = [
        'cpf',
        'nome',
        'email',
        'telefone'
    ];
}
