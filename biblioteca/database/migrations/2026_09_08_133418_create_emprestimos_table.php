<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('livro_id');
            $table->unsignedBigInteger('usuario_id');

            $table->foreign('livro_id')
                ->references('id')
                ->on('livros')
                ->restrictedOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('usuario_id')
                ->references('id')
                ->on('usuarios')
                ->restrictedOnDelete()
                ->cascadeOnUpdate();

            $table->date('data_emprestimo');
            $table->date('data_devolucao_prevista');
            $table->date('data_devolucao')->nullable();
            $table->boolean('emprestado');
            $table->text('observacoes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprestimos');
    }
};
