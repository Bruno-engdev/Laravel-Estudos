<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Sistema de Carros</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card register-card">
            <div class="auth-header">
                <div class="logo">
                    <i class="fas fa-car"></i>
                    <h1>AutoManager</h1>
                </div>
                <h2>Crie sua conta</h2>
                <p>Cadastre-se para começar a usar nosso sistema</p>
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

            <form class="auth-form" method="POST" action="{{ route('cliente.register') }}">
                @csrf
                
                <div class="form-row">
                    <div class="form-group half">
                        <label for="name">
                            <i class="fas fa-user"></i>
                            Nome Completo
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    </div>
                    
                    <div class="form-group half">
                        <label for="email">
                            <i class="fas fa-envelope"></i>
                            Email
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label for="phone">
                            <i class="fas fa-phone"></i>
                            Telefone
                        </label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                    </div>
                    
                    <div class="form-group half">
                        <label for="cpf">
                            <i class="fas fa-id-card"></i>
                            CPF
                        </label>
                        <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half">
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
                    
                    <div class="form-group half">
                        <label for="password_confirmation">
                            <i class="fas fa-lock"></i>
                            Confirmar Senha
                        </label>
                        <div class="password-input">
                            <input type="password" id="password_confirmation" name="password_confirmation" required>
                            <button type="button" class="toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-options">
                    <label class="checkbox-container">
                        <input type="checkbox" name="terms" required>
                        <span class="checkmark"></span>
                        Aceito os <a href="#">termos de uso</a> e <a href="#">política de privacidade</a>
                    </label>
                </div>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-user-plus"></i>
                    Criar Conta
                </button>

                <div class="auth-footer">
                    <p>Já tem uma conta? <a href="{{ route('cliente.login') }}">Faça login aqui</a></p>
                </div>
            </form>
        </div>
        
        <div class="auth-bg">
            <div class="bg-overlay"></div>
            <div class="bg-content">
                <h3>Junte-se a nós hoje!</h3>
                <p>Milhares de usuários já confiam em nosso sistema</p>
                <div class="features">
                    <div class="feature">
                        <i class="fas fa-users"></i>
                        <span>Comunidade Ativa</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-headset"></i>
                        <span>Suporte 24/7</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-rocket"></i>
                        <span>Fácil de Usar</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>