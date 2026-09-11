@props([
    'mode' => 'create',
    'usuario' => null,
])

@php
    $isEdit = $mode === 'edit';
@endphp

<div class="space-y-5">

    {{-- CPF + Nome --}}
    <div class="grid gap-5 sm:grid-cols-2">

        {{-- CPF --}}
        <div>
            <label
                for="cpf"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                CPF
            </label>

            <input
                type="text"
                id="cpf"
                name="cpf"
                value="{{ old('cpf', $isEdit ? optional($usuario)->cpf : '') }}"
                maxlength="11"
                required
                class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
            >
        </div>

        {{-- Nome --}}
        <div>
            <label
                for="nome"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                Nome
            </label>

            <input
                type="text"
                id="nome"
                name="nome"
                value="{{ old('nome', $isEdit ? optional($usuario)->nome : '') }}"
                required
                class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
            >
        </div>

    </div>

    {{-- E-mail + Telefone --}}
    <div class="grid gap-5 sm:grid-cols-2">

        {{-- E-mail --}}
        <div>
            <label
                for="email"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                E-mail
            </label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $isEdit ? optional($usuario)->email : '') }}"
                required
                class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
            >
        </div>

        {{-- Telefone --}}
        <div>
            <label
                for="telefone"
                class="mb-2 block text-sm font-medium text-slate-700"
            >
                Telefone
            </label>

            <input
                type="text"
                id="telefone"
                name="telefone"
                value="{{ old('telefone', $isEdit ? optional($usuario)->telefone : '') }}"
                required
                class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
            >
        </div>

    </div>

</div>