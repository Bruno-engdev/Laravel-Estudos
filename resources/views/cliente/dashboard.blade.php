
@extends('cliente.layouts.app')

@section('title', 'Minha Conta')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-user me-2"></i>Minha Conta</h2>
                <form method="POST" action="{{ route('cliente.logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt me-2"></i>Sair
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Card de Boas-vindas -->
        <div class="col-12 mb-4">
            <div class="card" style="background: linear-gradient(135deg, #00b4d8, #0077b6); color: white;">
                <div class="card-body p-4">
                    <h4><i class="fas fa-user-circle me-2"></i>Olá, {{ Auth::user()->name }}!</h4>
                    <p class="mb-0">Bem-vindo(a) ao seu painel pessoal da AutoPrime. Gerencie suas informações e explore nossos veículos.</p>
                </div>
            </div>
        </div>

        <!-- Informações da Conta -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-id-card me-2"></i>Suas Informações</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong><i class="fas fa-user me-2 text-primary"></i>Nome:</strong><br>
                        <span class="text-muted ms-4">{{ Auth::user()->name }}</span>
                    </div>
                    <div class="mb-3">
                        <strong><i class="fas fa-envelope me-2 text-primary"></i>Email:</strong><br>
                        <span class="text-muted ms-4">{{ Auth::user()->email }}</span>
                    </div>
                    @if(Auth::user()->phone)
                    <div class="mb-3">
                        <strong><i class="fas fa-phone me-2 text-primary"></i>Telefone:</strong><br>
                        <span class="text-muted ms-4">{{ Auth::user()->formatted_phone ?? Auth::user()->phone }}</span>
                    </div>
                    @endif
                    @if(Auth::user()->cpf)
                    <div class="mb-3">
                        <strong><i class="fas fa-id-card me-2 text-primary"></i>CPF:</strong><br>
                        <span class="text-muted ms-4">{{ Auth::user()->formatted_cpf ?? Auth::user()->cpf }}</span>
                    </div>
                    @endif
                    <div>
                        <strong><i class="fas fa-calendar me-2 text-primary"></i>Cliente desde:</strong><br>
                        <span class="text-muted ms-4">{{ Auth::user()->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ações Rápidas -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Ações Rápidas</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('cliente.home') }}" class="btn btn-outline-primary">
                            <i class="fas fa-home me-2"></i>Voltar ao Início
                        </a>
                        <a href="{{ route('cliente.modelos') }}" class="btn btn-outline-info">
                            <i class="fas fa-car me-2"></i>Ver Veículos Disponíveis
                        </a>
                        <hr>
                        <button class="btn btn-outline-secondary" disabled>
                            <i class="fas fa-edit me-2"></i>Editar Perfil
                            <small class="d-block text-muted">Em breve</small>
                        </button>
                        <button class="btn btn-outline-warning" disabled>
                            <i class="fas fa-lock me-2"></i>Alterar Senha
                            <small class="d-block text-muted">Em breve</small>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards Informativos -->
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                    <h6>Dados Protegidos</h6>
                    <p class="text-muted small mb-0">Suas informações estão seguras</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-headset fa-3x text-success mb-3"></i>
                    <h6>Suporte 24/7</h6>
                    <p class="text-muted small mb-0">Estamos aqui para ajudar</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-star fa-3x text-warning mb-3"></i>
                    <h6>Ofertas Exclusivas</h6>
                    <p class="text-muted small mb-0">Melhores condições para você</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection