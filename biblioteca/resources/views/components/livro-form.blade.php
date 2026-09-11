@props([
    'mode' => 'create',
    'livro' => null,
])

@php
    $isEdit = $mode === 'edit';
@endphp

<div class="space-y-5">

    {{-- Título + Autor --}}
    <div class="grid gap-5 sm:grid-cols-2">

        {{-- Título --}}
        <div>
            <label
                for="titulo"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                Título
            </label>

            <input
                type="text"
                id="titulo"
                name="titulo"
                value="{{ old('titulo', $isEdit ? optional($livro)->titulo : '') }}"
                required
                class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
            >
        </div>

        {{-- Autor --}}
        <div>
            <label
                for="autor"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                Autor
            </label>

            <input
                type="text"
                id="autor"
                name="autor"
                value="{{ old('autor', $isEdit ? optional($livro)->autor : '') }}"
                required
                class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
            >
        </div>

    </div>

    {{-- ISBN + Categoria --}}
    <div class="grid gap-5 sm:grid-cols-2">

        {{-- ISBN --}}
        <div>
            <label
                for="isbn"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                ISBN
            </label>

            <input
                type="text"
                id="isbn"
                name="isbn"
                value="{{ old('isbn', $isEdit ? optional($livro)->isbn : '') }}"
                class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
            >
        </div>

        {{-- Categoria --}}
        <div>
            <label
                for="categoria"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                Categoria
            </label>

            <select
                id="categoria"
                name="categoria"
                required
                class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-slate-800 shadow-sm outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
            >
                <option value="">
                    Selecione uma categoria
                </option>

                @foreach ([
                    'Fantasia',
                    'Ficção',
                    'Romance',
                    'Aventura',
                    'Terror',
                    'Mistério',
                    'Biografia'
                ] as $categoria)

                    <option
                        value="{{ $categoria }}"
                        {{ old('categoria', $isEdit ? optional($livro)->categoria : '') === $categoria ? 'selected' : '' }}
                    >
                        {{ $categoria }}
                    </option>

                @endforeach

            </select>
        </div>

    </div>

    {{-- Ano + Exemplares totais --}}
    <div class="grid gap-5 sm:grid-cols-2">

        {{-- Ano de publicação --}}
        <div>
            <label
                for="ano_publicacao"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                Ano de publicação
            </label>

            <input
                type="number"
                id="ano_publicacao"
                name="ano_publicacao"
                value="{{ old('ano_publicacao', $isEdit ? optional($livro)->ano_publicacao : '') }}"
                min="1"
                class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
            >
        </div>

        {{-- Exemplares totais --}}
        <div>
            <label
                for="exemplares_totais"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                Exemplares totais
            </label>

            <input
                type="number"
                id="exemplares_totais"
                name="exemplares_totais"
                value="{{ old('exemplares_totais', $isEdit ? optional($livro)->exemplares_totais : 1) }}"
                min="1"
                required
                class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
            >
        </div>

    </div>

    {{-- Exemplares disponíveis --}}
    <div>
        <label
            for="exemplares_disponiveis"
            class="mb-2 block text-sm font-medium text-slate-700"
        >
            Exemplares disponíveis
        </label>

        <input
            type="number"
            id="exemplares_disponiveis"
            name="exemplares_disponiveis"
            value="{{ old('exemplares_disponiveis', $isEdit ? optional($livro)->exemplares_disponiveis : 1) }}"
            min="0"
            required
            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
        >
    </div>

    {{-- Descrição --}}
    <div>
        <label
            for="descricao"
            class="mb-2 block text-sm font-medium text-slate-700"
        >
            Descrição
        </label>

        <textarea
            id="descricao"
            name="descricao"
            rows="5"
            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
        >{{ old('descricao', $isEdit ? optional($livro)->descricao : '') }}</textarea>
    </div>

</div>