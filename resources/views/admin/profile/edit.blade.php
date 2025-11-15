@extends('admin.layouts.app')

@section('title', 'Meu Perfil')

@section('content')
<div class="mb-4">
    <h1 class="page-title">
        <i class="fas fa-user-cog me-3"></i>Meu Perfil
    </h1>
    <p class="page-subtitle">Gerencie suas informações pessoais e segurança da conta</p>
</div>

<!-- Mensagens de sucesso/erro -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <!-- Card de Informações Pessoais -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-user me-2"></i>Informações Pessoais
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.profile.update') }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="fas fa-id-card me-2"></i>Nome Completo
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $user->name) }}"
                            required
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-2"></i>Email
                        </label>
                        <input 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" 
                            name="email" 
                            value="{{ old('email', $user->email) }}"
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-white-50 d-block mt-2">
                            <i class="fas fa-info-circle me-1"></i>
                            Este é o email que você usa para fazer login no sistema.
                        </small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-calendar me-2"></i>Membro desde
                        </label>
                        <input 
                            type="text" 
                            class="form-control" 
                            value="{{ $user->created_at->format('d/m/Y H:i') }}"
                            readonly
                            disabled
                        >
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Card de Segurança -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-lock me-2"></i>Segurança da Conta
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.profile.password.update') }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="current_password" class="form-label">
                            <i class="fas fa-key me-2"></i>Senha Atual
                        </label>
                        <input 
                            type="password" 
                            class="form-control @error('current_password') is-invalid @enderror" 
                            id="current_password" 
                            name="current_password"
                            required
                        >
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-2"></i>Nova Senha
                        </label>
                        <input 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            id="password" 
                            name="password"
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-white-50 d-block mt-2">
                            <i class="fas fa-info-circle me-1"></i>
                            Mínimo de 6 caracteres
                        </small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">
                            <i class="fas fa-lock me-2"></i>Confirmar Nova Senha
                        </label>
                        <input 
                            type="password" 
                            class="form-control" 
                            id="password_confirmation" 
                            name="password_confirmation"
                            required
                        >
                    </div>
                    
                    <div class="alert alert-warning" style="background: rgba(255, 193, 7, 0.1); border: 1px solid rgba(255, 193, 7, 0.3); color: #ffc107;">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Atenção!</strong> Ao alterar sua senha, você permanecerá conectado, mas precisará usar a nova senha no próximo login.
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-key me-2"></i>Alterar Senha
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Card de Informações de Segurança -->
        <div class="card mt-4">
            <div class="card-header">
                <i class="fas fa-shield-alt me-2"></i>Informações de Segurança
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-clock text-white-50 me-3" style="font-size: 1.5rem;"></i>
                    <div>
                        <small class="text-white-50 d-block">Última atualização</small>
                        <strong>{{ $user->updated_at->format('d/m/Y H:i') }}</strong>
                    </div>
                </div>
                
                <div class="d-flex align-items-center">
                    <i class="fas fa-id-badge text-white-50 me-3" style="font-size: 1.5rem;"></i>
                    <div>
                        <small class="text-white-50 d-block">ID do Usuário</small>
                        <strong>#{{ $user->id }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle me-2"></i>Dicas de Segurança
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="d-flex">
                            <i class="fas fa-shield-alt text-success me-3" style="font-size: 2rem;"></i>
                            <div>
                                <h6 class="text-white mb-2">Use uma senha forte</h6>
                                <p class="text-white-50 small mb-0">Combine letras maiúsculas, minúsculas, números e símbolos.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="d-flex">
                            <i class="fas fa-sync-alt text-info me-3" style="font-size: 2rem;"></i>
                            <div>
                                <h6 class="text-white mb-2">Altere regularmente</h6>
                                <p class="text-white-50 small mb-0">Recomendamos mudar sua senha a cada 3 meses.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="d-flex">
                            <i class="fas fa-user-secret text-warning me-3" style="font-size: 2rem;"></i>
                            <div>
                                <h6 class="text-white mb-2">Mantenha privado</h6>
                                <p class="text-white-50 small mb-0">Nunca compartilhe suas credenciais com terceiros.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
