<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Biblioteca')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="min-h-screen bg-gray-100 text-gray-800">

    @include('includes.navbar')

    <main class="mx-auto max-w-6xl px-4 py-8">

        @if (session('sucesso'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                {{ session('sucesso') }}
            </div>
        @endif

        @if (session('erro'))
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">
                {{ session('erro') }}
            </div>
        @endif

        @yield('content')

    </main>

    @stack('scripts')

</body>
</html>