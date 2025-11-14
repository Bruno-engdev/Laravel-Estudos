@extends('admin.layouts.app')

@section('title', 'Marcas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title">
            <i class="fas fa-trademark me-3"></i>Gerenciar Marcas
        </h1>
        <p class="page-subtitle">Marcas de veículos cadastradas</p>
    </div>
    <a href="{{ route('admin.marcas.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Nova Marca
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
        <i class="fas fa-list me-2"></i>Marcas Cadastradas
    </div>
    
    @if($marcas->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>País de Origem</th>
                        <th>Status</th>
                        <th>Veículos</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($marcas as $marca)
                        <tr>
                            <td>#{{ $marca->id }}</td>
                            <td><strong>{{ $marca->nome }}</strong></td>
                            <td>{{ $marca->pais_origem ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-{{ $marca->ativo ? 'success' : 'secondary' }}">
                                    {{ $marca->ativo ? 'Ativa' : 'Inativa' }}
                                </span>
                            </td>
                            <td>{{ $marca->veiculos->count() ?? 0 }}</td>
                            <td>
                                <a href="{{ route('admin.marcas.edit', $marca->id) }}" class="btn btn-sm btn-primary" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.marcas.destroy', $marca->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir esta marca?');">
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
            {{ $marcas->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-trademark" style="font-size: 4rem; opacity: 0.3;"></i>
            <h4 class="mt-3">Nenhuma marca cadastrada</h4>
            <a href="{{ route('admin.marcas.create') }}" class="btn btn-primary mt-3">
                <i class="fas fa-plus me-2"></i>Adicionar Marca
            </a>
        </div>
    @endif
</div>
@endsection
