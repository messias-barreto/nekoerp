<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'NekoERP')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Estilos personalizados (opcional) --}}
    <style>
        body {
            background-color: #fef6f8;
        }
        .card {
            border-radius: 1rem;
        }
        .btn {
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>
    {{-- Navbar simples --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="/img/logo.png" alt="NekoERP" height="40" class="me-2">
                <strong>NekoERP</strong>
            </a>
        </div>
    </nav>

    {{-- Conteúdo principal --}}
    <main class="container">
        @yield('content')
    </main>

    {{-- Bootstrap JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Scripts adicionais --}}
    @stack('scripts')
</body>
</html>