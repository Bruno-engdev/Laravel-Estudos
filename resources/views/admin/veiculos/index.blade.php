@extends('admin.layouts.app')

@section('title', 'Veículos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title">
            <i class="fas fa-car me-3"></i>Gerenciar Veículos
        </h1>
        <p class="page-subtitle">Lista completa de veículos cadastrados</p>
    </div>
    <a href="{{ route('admin.veiculos.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Novo Veículo
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <i class="fas fa-list me-2"></i>Veículos Cadastrados
    </div>
    
    @if($veiculos->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Ano</th>
                        <th>Cor</th>
                        <th>Preço Venda</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($veiculos as $veiculo)
                        <tr>
                            <td>#{{ $veiculo->id }}</td>
                            <td>{{ $veiculo->marca->nome ?? 'N/A' }}</td>
                            <td>{{ $veiculo->modelo->nome ?? 'N/A' }}</td>
                            <td>{{ $veiculo->ano_modelo }}</td>
                            <td>
                                @if($veiculo->cor)
                                    <span style="display: inline-block; width: 20px; height: 20px; border-radius: 50%; background-color: {{ $veiculo->cor->codigo_hex ?? '#ccc' }}; vertical-align: middle;"></span>
                                    {{ $veiculo->cor->nome }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="text-success fw-bold">R$ {{ number_format($veiculo->preco_venda, 2, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $veiculo->status == 'Disponível' ? 'success' : ($veiculo->status == 'Vendido' ? 'danger' : 'warning') }}">
                                    {{ $veiculo->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.veiculos.show', $veiculo->id) }}" class="btn btn-sm btn-info" title="Visualizar">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.veiculos.edit', $veiculo->id) }}" class="btn btn-sm btn-primary" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.veiculos.destroy', $veiculo->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir este veículo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Excluir">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $veiculos->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-car-side" style="font-size: 4rem; opacity: 0.3;"></i>
            <h4 class="mt-3">Nenhum veículo cadastrado</h4>
            <p class="text-muted">Comece adicionando um novo veículo.</p>
            <a href="{{ route('admin.veiculos.create') }}" class="btn btn-primary mt-3">
                <i class="fas fa-plus me-2"></i>Adicionar Veículo
            </a>
        </div>
    @endif
</div>
@endsection
