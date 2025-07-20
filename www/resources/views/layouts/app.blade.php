<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'NekoERP')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="image/logo.png" type="image/png">

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

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
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="/img/logo.png" alt="NekoERP" height="40" class="me-2">
                <strong>NekoERP</strong>
            </a>

            <div class="ms-auto">
                <a href={{ route ('carrinho.index' )}} type="button" class="btn btn-outline-primary position-relative">
                    <i class="bi bi-cart3"></i> Carrinho
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ isset(session('carrinho-produtos')['produtos']) ? count(session('carrinho-produtos')['produtos']) : 0 }}
                        <span class="visually-hidden">itens no carrinho</span>
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <x-modal-carrinho-de-compras />

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
