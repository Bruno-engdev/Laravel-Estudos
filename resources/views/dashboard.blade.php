@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Dashboard</h2>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-user fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Perfil</h5>
                    <p class="card-text">Gerencie suas informações pessoais</p>
                    <a href="#" class="btn btn-primary">Ver Perfil</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-car fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Veículos</h5>
                    <p class="card-text">Gerencie todos os veículos cadastrados</p>
                    <a href="{{ route('veiculos.index') }}" class="btn btn-success">Ver Veículos</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-plus fa-3x text-info mb-3"></i>
                    <h5 class="card-title">Novo Veículo</h5>
                    <p class="card-text">Cadastre um novo veículo no sistema</p>
                    <a href="{{ route('veiculos.create') }}" class="btn btn-info">Cadastrar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Informações do Usuário</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nome:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Telefone:</strong> {{ $user->formatted_phone ?? 'Não informado' }}</p>
                    <p><strong>CPF:</strong> {{ $user->formatted_cpf ?? 'Não informado' }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Estatísticas Rápidas</h5>
                </div>
                <div class="card-body">
                    @php
                        $totalVeiculos = \App\Models\Veiculo::count();
                        $veiculosDisponiveis = \App\Models\Veiculo::where('status', 'Disponível')->count();
                        $veiculosVendidos = \App\Models\Veiculo::where('status', 'Vendido')->count();
                    @endphp
                    <p><strong>Total de Veículos:</strong> {{ $totalVeiculos }}</p>
                    <p><strong>Disponíveis:</strong> <span class="text-success">{{ $veiculosDisponiveis }}</span></p>
                    <p><strong>Vendidos:</strong> <span class="text-danger">{{ $veiculosVendidos }}</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection