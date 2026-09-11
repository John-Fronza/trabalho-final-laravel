<nav class="bg-slate-800 shadow-md">
    <div class="mx-auto flex max-w-6xl items-center gap-2 px-4 py-3">

        <span class="mr-6 text-xl font-semibold text-white">
            📚 Biblioteca
        </span>

        <a
            href="{{ route('livros.index') }}"
            class="rounded-md px-3 py-2 text-sm font-medium text-slate-200 transition hover:bg-slate-700 hover:text-white"
        >
            Livros
        </a>

        <a
            href="{{ route('usuarios.index') }}"
            class="rounded-md px-3 py-2 text-sm font-medium text-slate-200 transition hover:bg-slate-700 hover:text-white"
        >
            Usuários
        </a>

        <a
            href="{{ route('emprestimos.index') }}"
            class="rounded-md px-3 py-2 text-sm font-medium text-slate-200 transition hover:bg-slate-700 hover:text-white"
        >
            Empréstimos
        </a>

        <a
            href="{{ route('busca.index') }}"
            class="rounded-md px-3 py-2 text-sm font-medium text-slate-200 transition hover:bg-slate-700 hover:text-white"
        >
            Buscar
        </a>

    </div>
</nav>