@extends('admin.layouts.app')
@section('title', 'Cores')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title"><i class="fas fa-palette me-3"></i>Gerenciar Cores</h1>
        <p class="page-subtitle">Cores de veículos cadastradas</p>
    </div>
    <a href="{{ route('admin.cores.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Nova Cor</a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show"><i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

<div class="card">
    <div class="card-header"><i class="fas fa-list me-2"></i>Cores Cadastradas</div>
    
    @if($cores->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr><th>ID</th><th>Cor</th><th>Código Hex</th><th>Status</th><th>Veículos</th><th>Ações</th></tr>
                </thead>
                <tbody>
                    @foreach($cores as $cor)
                        <tr>
                            <td>#{{ $cor->id }}</td>
                            <td>
                                <span style="display: inline-block; width: 30px; height: 30px; border-radius: 50%; background-color: {{ $cor->codigo_hex ?? '#ccc' }}; border: 2px solid rgba(0, 180, 216, 0.3); vertical-align: middle; margin-right: 10px;"></span>
                                <strong>{{ $cor->nome }}</strong>
                            </td>
                            <td><code>{{ $cor->codigo_hex ?? 'N/A' }}</code></td>
                            <td><span class="badge bg-{{ $cor->ativo ? 'success' : 'secondary' }}">{{ $cor->ativo ? 'Ativa' : 'Inativa' }}</span></td>
                            <td>{{ $cor->veiculos->count() ?? 0 }}</td>
                            <td>
                                <a href="{{ route('admin.cores.edit', $cor->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.cores.destroy', $cor->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">{{ $cores->links() }}</div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-palette" style="font-size: 4rem; opacity: 0.3;"></i>
            <h4 class="mt-3">Nenhuma cor cadastrada</h4>
            <a href="{{ route('admin.cores.create') }}" class="btn btn-primary mt-3"><i class="fas fa-plus me-2"></i>Adicionar Cor</a>
        </div>
    @endif
</div>
@endsection
