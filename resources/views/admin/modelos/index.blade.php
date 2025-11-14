@extends('admin.layouts.app')
@section('title', 'Modelos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title"><i class="fas fa-car-side me-3"></i>Gerenciar Modelos</h1>
        <p class="page-subtitle">Modelos de veículos cadastrados</p>
    </div>
    <a href="{{ route('admin.modelos.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Novo Modelo</a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show"><i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

<div class="card">
    <div class="card-header"><i class="fas fa-list me-2"></i>Modelos Cadastrados</div>
    
    @if($modelos->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr><th>ID</th><th>Marca</th><th>Modelo</th><th>Tipo</th><th>Status</th><th>Veículos</th><th>Ações</th></tr>
                </thead>
                <tbody>
                    @foreach($modelos as $modelo)
                        <tr>
                            <td>#{{ $modelo->id }}</td>
                            <td>{{ $modelo->marca->nome ?? 'N/A' }}</td>
                            <td><strong>{{ $modelo->nome }}</strong></td>
                            <td>{{ $modelo->tipo ?? 'N/A' }}</td>
                            <td><span class="badge bg-{{ $modelo->ativo ? 'success' : 'secondary' }}">{{ $modelo->ativo ? 'Ativo' : 'Inativo' }}</span></td>
                            <td>{{ $modelo->veiculos->count() ?? 0 }}</td>
                            <td>
                                <a href="{{ route('admin.modelos.edit', $modelo->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.modelos.destroy', $modelo->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">{{ $modelos->links() }}</div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-car-side" style="font-size: 4rem; opacity: 0.3;"></i>
            <h4 class="mt-3">Nenhum modelo cadastrado</h4>
            <a href="{{ route('admin.modelos.create') }}" class="btn btn-primary mt-3"><i class="fas fa-plus me-2"></i>Adicionar Modelo</a>
        </div>
    @endif
</div>
@endsection
