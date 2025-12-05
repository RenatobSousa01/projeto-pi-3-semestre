<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ecommerce PI')</title>

    {{-- ✅ CORREÇÃO: Usando o arquivo style.css que criamos manualmente na pasta public/css/ --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <main>
        {{-- Aqui entrará o conteúdo de todas as páginas (@yield('content')) --}}
        @yield('content')
    </main>

    {{-- ✅ CORREÇÃO: Removemos a referência ao Vue.js (app.js) --}}
    
</body>
</html>