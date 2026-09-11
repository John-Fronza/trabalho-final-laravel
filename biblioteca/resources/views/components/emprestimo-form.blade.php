@props([
    'mode' => 'create',
    'emprestimo' => null,
    'livros' => [],
    'usuarios' => [],
    'dataEmprestimo' => null,
    'dataDevolucaoPrevista' => null,
])

@php
    $isEdit = $mode === 'edit';
@endphp

<div class="space-y-5">

    {{-- Livro + Usuário --}}
    <div class="grid gap-5 sm:grid-cols-2">

        {{-- Livro --}}
        <div>
            <label
                for="livro_id"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                Livro
            </label>

            <select
                id="livro_id"
                name="livro_id"
                required
                class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-slate-800 shadow-sm outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
            >

                @if (!$isEdit)
                    <option value="">
                        Selecione um livro
                    </option>
                @endif

                @foreach ($livros as $livro)
                    <option
                        value="{{ $livro->id }}"
                        {{ old('livro_id', $isEdit ? optional($emprestimo)->livro_id : '') == $livro->id ? 'selected' : '' }}
                    >
                        {{ $livro->titulo }}
                        ({{ $livro->exemplares_disponiveis }} disponíveis)
                    </option>
                @endforeach

            </select>
        </div>

        {{-- Usuário --}}
        <div>
            <label
                for="usuario_id"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                Usuário
            </label>

            <select
                id="usuario_id"
                name="usuario_id"
                required
                class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-slate-800 shadow-sm outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
            >

                @if (!$isEdit)
                    <option value="">
                        Selecione um usuário
                    </option>
                @endif

                @foreach ($usuarios as $usuario)
                    <option
                        value="{{ $usuario->id }}"
                        {{ old('usuario_id', $isEdit ? optional($emprestimo)->usuario_id : '') == $usuario->id ? 'selected' : '' }}
                    >
                        {{ $usuario->nome }}
                    </option>
                @endforeach

            </select>
        </div>

    </div>

    {{-- Data do empréstimo + Data prevista --}}
    <div class="grid gap-5 sm:grid-cols-2">

        {{-- Data do empréstimo --}}
        <div>
            <label
                for="data_emprestimo"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                Data do empréstimo
            </label>

            <input
                type="date"
                id="data_emprestimo"
                name="data_emprestimo"
                value="{{ old('data_emprestimo', $isEdit ? optional($emprestimo)->data_emprestimo?->format('Y-m-d') : $dataEmprestimo) }}"
                required
                class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
            >
        </div>

        {{-- Data prevista para devolução --}}
        <div>
            <label
                for="data_devolucao_prevista"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                Data prevista para devolução
            </label>

            <input
                type="date"
                id="data_devolucao_prevista"
                name="data_devolucao_prevista"
                value="{{ old('data_devolucao_prevista', $isEdit ? optional($emprestimo)->data_devolucao_prevista?->format('Y-m-d') : $dataDevolucaoPrevista) }}"
                required
                class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
            >
        </div>

    </div>

    @if ($isEdit)

        {{-- Data de devolução + Status --}}
        <div class="grid gap-5 sm:grid-cols-2">

            {{-- Data de devolução --}}
            <div>
                <label
                    for="data_devolucao"
                    class="mb-2 block text-sm font-medium text-slate-700"
                >
                    Data de devolução
                </label>

                <input
                    type="date"
                    id="data_devolucao"
                    name="data_devolucao"
                    value="{{ old('data_devolucao', optional($emprestimo)->data_devolucao?->format('Y-m-d')) }}"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                >
            </div>

            {{-- Status --}}
            <div>
                <label
                    for="emprestado"
                    class="mb-2 block text-sm font-medium text-slate-700"
                >
                    Status
                </label>

                <select
                    id="emprestado"
                    name="emprestado"
                    required
                    class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-slate-800 shadow-sm outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                >
                    <option
                        value="1"
                        {{ old('emprestado', optional($emprestimo)->emprestado) == 1 ? 'selected' : '' }}
                    >
                        Emprestado
                    </option>

                    <option
                        value="0"
                        {{ old('emprestado', optional($emprestimo)->emprestado) == 0 ? 'selected' : '' }}
                    >
                        Devolvido
                    </option>
                </select>
            </div>

        </div>

    @endif

    {{-- Observações --}}
    <div>
        <label
            for="observacoes"
            class="mb-2 block text-sm font-medium text-slate-700"
        >
            Observações
        </label>

        <textarea
            id="observacoes"
            name="observacoes"
            rows="5"
            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
        >{{ old('observacoes', $isEdit ? optional($emprestimo)->observacoes : '') }}</textarea>
    </div>

</div>