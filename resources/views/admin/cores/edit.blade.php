@extends('admin.layouts.app')
@section('title', 'Editar Cor')

@section('content')
<div class="mb-4"><h1 class="page-title"><i class="fas fa-edit me-3"></i>Editar Cor</h1></div>

@if ($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
@endif

<div class="card">
    <form action="{{ route('admin.cores.update', $cor->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome *</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $cor->nome) }}" required>
        </div>
        <div class="mb-3">
            <label for="codigo_hex" class="form-label">Código Hexadecimal (Ex: #FF0000)</label>
            <input type="text" class="form-control" id="codigo_hex" name="codigo_hex" value="{{ old('codigo_hex', $cor->codigo_hex) }}" placeholder="#000000" pattern="^#[0-9A-Fa-f]{6}$">
            <small class="text-muted">Formato: #RRGGBB</small>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" {{ old('ativo', $cor->ativo) ? 'checked' : '' }}>
            <label class="form-check-label" for="ativo">Ativa</label>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.cores.index') }}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </div>
    </form>
</div>
@endsection
