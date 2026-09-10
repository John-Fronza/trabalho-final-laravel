<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Biblioteca')</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }

        nav {
            background-color: #333;
            padding: 15px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
        }

        main {
            max-width: 1100px;
            margin: 30px auto;
            background-color: white;
            padding: 25px;
        }

        .sucesso {
            background-color: #d4edda;
            padding: 10px;
            margin-bottom: 15px;
        }

        .erro {
            background-color: #f8d7da;
            padding: 10px;
            margin-bottom: 15px;
        }
    </style>

    @stack('styles')
</head>
<body>

    @include('includes.navbar')

    <main>
        @if (session('sucesso'))
            <div class="sucesso">
                {{ session('sucesso') }}
            </div>
        @endif

        @if (session('erro'))
            <div class="erro">
                {{ session('erro') }}
            </div>
        @endif

        @yield('content')
    </main>

    @stack('scripts')

</body>
</html>