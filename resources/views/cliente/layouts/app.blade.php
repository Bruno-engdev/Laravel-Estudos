<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AutoPrime - Loja Automotiva')</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/2972/2972361.png" type="image/x-icon">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Estilos Personalizados -->
    <link rel="stylesheet" href="{{ asset('FrontCliente/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('FrontCliente/css/components/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('FrontCliente/css/components/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('FrontCliente/css/components/cards.css') }}">
    
    @stack('styles')
</head>
<body class="@yield('body-class')">
    
    @yield('preloader')
    
    <!-- Navbar -->
    @include('cliente.partials.navbar')
    
    <!-- Conteúdo Principal -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('cliente.partials.footer')
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>
