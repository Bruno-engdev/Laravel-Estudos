<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Carros</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Botão Admin no canto superior direito -->
    <div class="admin-access">
        <a href="{{ route('admin.login') }}" class="admin-btn" title="Acesso Administrativo">
            <i class="fas fa-user-shield"></i>
            <span>Admin</span>
        </a>
    </div>

    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo">
                    <img src="{{ asset('FrontCliente/TelaInicial/logosite.png') }}" alt="Logo do Site" class="site-logo">
                    <h1>AutoPrime</h1>
                </div>
                <h2>Bem-vindo de volta!</h2>
                <p>Faça login para acessar o sistema</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="auth-form" method="POST" action="{{ route('cliente.login') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        Email
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        Senha
                    </label>
                    <div class="password-input">
                        <input type="password" id="password" name="password" required>
                        <button type="button" class="toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-options">
                    <label class="checkbox-container">
                        <input type="checkbox" name="remember">
                        <span class="checkmark"></span>
                        Lembrar de mim
                    </label>
                    <a href="#" class="forgot-password">Esqueceu a senha?</a>
                </div>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-sign-in-alt"></i>
                    Entrar
                </button>

                <div class="auth-footer">
                    <p>Não tem uma conta? <a href="{{ route('cliente.register') }}">Cadastre-se aqui</a></p>
                </div>
            </form>
        </div>
        
        <div class="auth-bg">
            <div class="bg-overlay"></div>
            <div class="bg-content">
                <h3>Gerencie sua frota com facilidade</h3>
                <p>Sistema completo para cadastro e gerenciamento de veículos</p>
                <div class="features">
                    <div class="feature">
                        <i class="fas fa-car"></i>
                        <span>Cadastro de Carros</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-chart-line"></i>
                        <span>Relatórios Detalhados</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-shield-alt"></i>
                        <span>Sistema Seguro</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>