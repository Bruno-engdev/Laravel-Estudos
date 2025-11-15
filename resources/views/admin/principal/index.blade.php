@extends('admin.layouts.app')

@section('title', 'Clientes')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h1 class="page-title">
            <i class="fas fa-users me-3"></i>Gerenciar Clientes
        </h1>
        <p class="page-subtitle">Lista de todos os clientes cadastrados</p>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalIncluir">
        <i class="fas fa-plus me-2"></i>Novo Cliente
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-list me-2"></i>Lista de Clientes ({{ $clientes->count() }})</span>
    </div>
    
    <div class="card-body">
        @if($clientes->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>CPF</th>
                            <th>Data Nasc.</th>
                            <th>Cadastrado em</th>
                            <th style="width: 150px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->id }}</td>
                                <td>
                                    <strong>{{ $cliente->nome }}</strong>
                                </td>
                                <td>{{ $cliente->email }}</td>
                                <td>{{ $cliente->telefone ?? 'Não informado' }}</td>
                                <td>{{ $cliente->CPF ?? 'Não informado' }}</td>
                                <td>{{ $cliente->DataNasc ? \Carbon\Carbon::parse($cliente->DataNasc)->format('d/m/Y') : 'Não informado' }}</td>
                                <td>{{ $cliente->created_at ? $cliente->created_at->format('d/m/Y') : 'N/A' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button 
                                            type="button" 
                                            class="btn btn-sm btn-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalAlteracao"
                                            onclick="setEditData({{ json_encode($cliente) }})"
                                            title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button 
                                            type="button" 
                                            class="btn btn-sm btn-danger" 
                                            onclick="deleteCliente({{ $cliente->id }}, '{{ $cliente->nome }}')"
                                            title="Excluir">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-users fa-3x text-white-50 mb-3"></i>
                <p class="text-white-50">Nenhum cliente cadastrado ainda.</p>
                <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#modalIncluir">
                    <i class="fas fa-plus me-2"></i>Cadastrar Primeiro Cliente
                </button>
            </div>
        @endif
    </div>
</div>

<!-- Modal Incluir Cliente -->
<div class="modal fade" id="modalIncluir" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="background: rgba(40, 40, 40, 0.98); border: 1px solid rgba(255, 255, 255, 0.1);">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                <h5 class="modal-title text-white">
                    <i class="fas fa-user-plus me-2"></i>Novo Cliente
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.clientes.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nome Completo *</label>
                        <input type="text" class="form-control" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telefone</label>
                            <input type="text" class="form-control" name="telefone" id="telefone-create">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">CPF</label>
                            <input type="text" class="form-control" name="CPF" id="cpf-create">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" name="DataNasc">
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Salvar Cliente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Alterar Cliente -->
<div class="modal fade" id="modalAlteracao" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="background: rgba(40, 40, 40, 0.98); border: 1px solid rgba(255, 255, 255, 0.1);">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                <h5 class="modal-title text-white">
                    <i class="fas fa-edit me-2"></i>Editar Cliente
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="formAlterar" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nome Completo *</label>
                        <input type="text" class="form-control" name="nome" id="edit-nome" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" class="form-control" name="email" id="edit-email" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telefone</label>
                            <input type="text" class="form-control" name="telefone" id="edit-telefone">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">CPF</label>
                            <input type="text" class="form-control" name="CPF" id="edit-cpf">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" name="DataNasc" id="edit-datanasc">
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Form para exclusão -->
<form id="formExcluir" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function() {
        // Máscaras
        $('#telefone-create, #edit-telefone').mask('(00) 00000-0000');
        $('#cpf-create, #edit-cpf').mask('000.000.000-00');
    });

    function setEditData(cliente) {
        document.getElementById('edit-nome').value = cliente.nome || '';
        document.getElementById('edit-email').value = cliente.email || '';
        document.getElementById('edit-telefone').value = cliente.telefone || '';
        document.getElementById('edit-cpf').value = cliente.CPF || '';
        document.getElementById('edit-datanasc').value = cliente.DataNasc || '';
        document.getElementById('formAlterar').action = '/admin/clientes/' + cliente.id;
    }

    function deleteCliente(id, nome) {
        if (confirm('Tem certeza que deseja excluir o cliente "' + nome + '"?\n\nEsta ação não pode ser desfeita!')) {
            const form = document.getElementById('formExcluir');
            form.action = '/admin/clientes/' + id;
            form.submit();
        }
    }

    // Auto-hide alerts
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
</script>
@endpush
@endsection
