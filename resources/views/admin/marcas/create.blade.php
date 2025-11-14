@extends('admin.layouts.app')

@section('title', 'Nova Marca')

@section('content')
<div class="mb-4">
    <h1 class="page-title">
        <i class="fas fa-plus-circle me-3"></i>Cadastrar Nova Marca
    </h1>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <form action="{{ route('admin.marcas.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="nome" class="form-label">Nome *</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
        </div>
        
        <div class="mb-3">
            <label for="pais_origem" class="form-label">País de Origem</label>
            <input type="text" class="form-control" id="pais_origem" name="pais_origem" value="{{ old('pais_origem') }}">
        </div>
        
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ old('descricao') }}</textarea>
        </div>
        
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" {{ old('ativo', true) ? 'checked' : '' }}>
            <label class="form-check-label" for="ativo">Ativa</label>
        </div>
        
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.marcas.index') }}" class="btn btn-secondary">Voltar</a>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>
</div>
@endsection
