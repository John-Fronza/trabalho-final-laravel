<nav class="bg-slate-800 shadow-md">

    <div class="mx-auto flex max-w-6xl items-center gap-2 px-4 py-3">

        <a
            href="{{ route('home') }}"
            class="mr-6 text-xl font-semibold text-white transition hover:text-slate-200"
        >
            📚 Biblioteca
        </a>

        {{-- Livros --}}
        <a
            href="{{ route('livros.index') }}"
            class="rounded-md px-3 py-2 text-sm font-medium transition
                {{ request()->routeIs('livros.*')
                    ? 'bg-slate-700 text-white'
                    : 'text-slate-200 hover:bg-slate-700 hover:text-white' }}"
        >
            Livros
        </a>

        {{-- Usuários --}}
        <a
            href="{{ route('usuarios.index') }}"
            class="rounded-md px-3 py-2 text-sm font-medium transition
                {{ request()->routeIs('usuarios.*')
                    ? 'bg-slate-700 text-white'
                    : 'text-slate-200 hover:bg-slate-700 hover:text-white' }}"
        >
            Usuários
        </a>

        {{-- Empréstimos --}}
        <a
            href="{{ route('emprestimos.index') }}"
            class="rounded-md px-3 py-2 text-sm font-medium transition
                {{ request()->routeIs('emprestimos.*')
                    ? 'bg-slate-700 text-white'
                    : 'text-slate-200 hover:bg-slate-700 hover:text-white' }}"
        >
            Empréstimos
        </a>

        {{-- Buscar --}}
        <a
            href="{{ route('busca.index') }}"
            class="rounded-md px-3 py-2 text-sm font-medium transition
                {{ request()->routeIs('busca.*')
                    ? 'bg-slate-700 text-white'
                    : 'text-slate-200 hover:bg-slate-700 hover:text-white' }}"
        >
            Buscar
        </a>

    </div>

</nav>