@extends('admin.layouts.app')
@section('title', 'Editar Modelo')

@section('content')
<div class="mb-4"><h1 class="page-title"><i class="fas fa-edit me-3"></i>Editar Modelo</h1></div>

@if ($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
@endif

<div class="card">
    <form action="{{ route('admin.modelos.update', $modelo->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="marca_id" class="form-label">Marca *</label>
            <select class="form-select" id="marca_id" name="marca_id" required>
                <option value="">Selecione a marca</option>
                @foreach($marcas as $marca)
                    <option value="{{ $marca->id }}" {{ old('marca_id', $modelo->marca_id) == $marca->id ? 'selected' : '' }}>{{ $marca->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Nome *</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $modelo->nome) }}" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-select" id="tipo" name="tipo">
                <option value="">Selecione</option>
                @foreach(['Sedan', 'SUV', 'Hatchback', 'Picape', 'Esportivo'] as $tipo)
                    <option value="{{ $tipo }}" {{ old('tipo', $modelo->tipo) == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ old('descricao', $modelo->descricao) }}</textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" {{ old('ativo', $modelo->ativo) ? 'checked' : '' }}>
            <label class="form-check-label" for="ativo">Ativo</label>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.modelos.index') }}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </div>
    </form>
</div>
@endsection
