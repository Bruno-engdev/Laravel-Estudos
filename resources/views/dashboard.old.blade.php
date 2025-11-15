@extends('cliente.layouts.app')

@section('title', 'Minha Conta')

@section('content')
@if(Auth::user()->isAdmin())
    <!-- Se for admin, redirecionar para o painel admin -->
    <script>
        window.location.href = "{{ route('admin.dashboard') }}";
    </script>
@else
    <!-- Dashboard para clientes comuns -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-user me-2"></i>Minha Conta</h2>
                    <form method="POST" action="{{ route('cliente.logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt me-2"></i>Sair da Conta
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Card de Boas-vindas -->
            <div class="col-12 mb-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h4><i class="fas fa-user-circle me-2"></i>Olá, {{ Auth::user()->name }}!</h4>
                        <p class="mb-0">Bem-vindo(a) ao seu painel pessoal. Aqui você pode gerenciar suas informações pessoais e acompanhar suas atividades na AutoPrime.</p>
                    </div>
                </div>
            </div>

            <!-- Informações da Conta -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="fas fa-id-card me-2"></i>Suas Informações</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <strong>Nome Completo:</strong><br>
                                <span class="text-muted">{{ Auth::user()->name }}</span>
                            </div>
                            <div class="col-12 mb-3">
                                <strong>Email:</strong><br>
                                <span class="text-muted">{{ Auth::user()->email }}</span>
                                @if(Auth::user()->email_verified_at)
                                    <span class="badge bg-success ms-2">
                                        <i class="fas fa-check me-1"></i>Verificado
                                    </span>
                                @else
                                    <span class="badge bg-warning ms-2">
                                        <i class="fas fa-clock me-1"></i>Não verificado
                                    </span>
                                @endif
                            </div>
                            @if(Auth::user()->phone)
                            <div class="col-12 mb-3">
                                <strong>Telefone:</strong><br>
                                <span class="text-muted">{{ Auth::user()->formatted_phone ?? Auth::user()->phone }}</span>
                            </div>
                            @endif
                            @if(Auth::user()->cpf)
                            <div class="col-12 mb-3">
                                <strong>CPF:</strong><br>
                                <span class="text-muted">{{ Auth::user()->formatted_cpf ?? Auth::user()->cpf }}</span>
                            </div>
                            @endif
                            <div class="col-12">
                                <strong>Cliente desde:</strong><br>
                                <span class="text-muted">{{ Auth::user()->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ações do Cliente -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="fas fa-cogs me-2"></i>Ações da Conta</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('cliente.home') }}" class="btn btn-outline-primary">
                                <i class="fas fa-home me-2"></i>Voltar à Loja
                            </a>
                            <a href="{{ route('cliente.modelos') }}" class="btn btn-outline-info">
                                <i class="fas fa-car me-2"></i>Ver Veículos
                            </a>
                            <button class="btn btn-outline-secondary" onclick="editProfile()" disabled>
                                <i class="fas fa-edit me-2"></i>Editar Perfil
                                <small class="d-block">Em breve</small>
                            </button>
                            <button class="btn btn-outline-warning" onclick="changePassword()" disabled>
                                <i class="fas fa-lock me-2"></i>Alterar Senha
                                <small class="d-block">Em breve</small>
                            </button>
                            @if(!Auth::user()->email_verified_at)
                            <button class="btn btn-outline-success" onclick="resendVerification()" disabled>
                                <i class="fas fa-envelope me-2"></i>Verificar Email
                                <small class="d-block">Em breve</small>
                            </button>
                            @endif
                            
                            <!-- Botão Sair adicional -->
                            <hr class="my-3">
                            <form method="POST" action="{{ route('cliente.logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-sign-out-alt me-2"></i>Sair da Conta
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informações Adicionais -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="fas fa-info-circle me-2"></i>Informações Importantes</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-shield-alt fa-2x text-primary mb-2"></i>
                                    <h6>Seus Dados Protegidos</h6>
                                    <small class="text-muted">Suas informações estão seguras conosco</small>
                                </div>
                            </div>
                            <div class="col-md-4 text-center mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-headset fa-2x text-success mb-2"></i>
                                    <h6>Suporte 24/7</h6>
                                    <small class="text-muted">Estamos aqui para ajudar você</small>
                                </div>
                            </div>
                            <div class="col-md-4 text-center mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-star fa-2x text-warning mb-2"></i>
                                    <h6>Cliente Especial</h6>
                                    <small class="text-muted">Ofertas exclusivas para você</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function editProfile() {
        alert('Funcionalidade em desenvolvimento. Em breve você poderá editar seu perfil.');
    }

    function changePassword() {
        alert('Funcionalidade em desenvolvimento. Em breve você poderá alterar sua senha.');
    }

    function resendVerification() {
        alert('Funcionalidade em desenvolvimento. Em breve você poderá reenviar o email de verificação.');
    }
    </script>
@endif
@endsection