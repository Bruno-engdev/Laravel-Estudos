@extends('admin.layouts.app')
@section('title', 'Novo Modelo')

@section('content')
<div class="mb-4"><h1 class="page-title"><i class="fas fa-plus-circle me-3"></i>Cadastrar Novo Modelo</h1></div>

@if ($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
@endif

<div class="card">
    <form action="{{ route('admin.modelos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="marca_id" class="form-label">Marca *</label>
            <select class="form-select" id="marca_id" name="marca_id" required>
                <option value="">Selecione a marca</option>
                @foreach($marcas as $marca)
                    <option value="{{ $marca->id }}" {{ old('marca_id') == $marca->id ? 'selected' : '' }}>{{ $marca->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Nome *</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-select" id="tipo" name="tipo">
                <option value="">Selecione</option>
                <option value="Sedan">Sedan</option>
                <option value="SUV">SUV</option>
                <option value="Hatchback">Hatchback</option>
                <option value="Picape">Picape</option>
                <option value="Esportivo">Esportivo</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ old('descricao') }}</textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" checked>
            <label class="form-check-label" for="ativo">Ativo</label>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.modelos.index') }}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>
</div>
@endsection
