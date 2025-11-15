@extends('admin.layouts.app')

@section('title', 'Editar Veículo')

@section('content')
<div class="mb-4">
    <h1 class="page-title">
        <i class="fas fa-edit me-3"></i>Editar Veículo
    </h1>
    <p class="page-subtitle">Atualize os dados do veículo</p>
</div>

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h5><i class="fas fa-exclamation-triangle me-2"></i>Erros de validação:</h5>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <i class="fas fa-car me-2"></i>Dados do Veículo
    </div>
    
    <form action="{{ route('admin.veiculos.update', $veiculo->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Marca -->
            <div class="col-md-4 mb-3">
                <label for="marca_id" class="form-label">Marca *</label>
                <select class="form-select" id="marca_id" name="marca_id" required>
                    <option value="">Selecione a marca</option>
                    @foreach($marcas as $marca)
                        <option value="{{ $marca->id }}" {{ (old('marca_id', $veiculo->marca_id) == $marca->id) ? 'selected' : '' }}>
                            {{ $marca->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Modelo -->
            <div class="col-md-4 mb-3">
                <label for="modelo_id" class="form-label">Modelo *</label>
                <select class="form-select" id="modelo_id" name="modelo_id" required>
                    <option value="">Selecione o modelo</option>
                    @foreach($modelos as $modelo)
                        <option value="{{ $modelo->id }}" data-marca="{{ $modelo->marca_id }}" {{ (old('modelo_id', $veiculo->modelo_id) == $modelo->id) ? 'selected' : '' }}>
                            {{ $modelo->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Cor -->
            <div class="col-md-4 mb-3">
                <label for="cor_id" class="form-label">Cor *</label>
                <select class="form-select" id="cor_id" name="cor_id" required>
                    <option value="">Selecione a cor</option>
                    @foreach($cores as $cor)
                        <option value="{{ $cor->id }}" {{ (old('cor_id', $veiculo->cor_id) == $cor->id) ? 'selected' : '' }}>
                            {{ $cor->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="row">
            <!-- Ano Fabricação -->
            <div class="col-md-3 mb-3">
                <label for="ano_fabricacao" class="form-label">Ano Fabricação *</label>
                <input type="number" class="form-control" id="ano_fabricacao" name="ano_fabricacao" 
                       min="1900" max="{{ date('Y') + 1 }}" value="{{ old('ano_fabricacao', $veiculo->ano_fabricacao) }}" required>
            </div>
            
            <!-- Ano Modelo -->
            <div class="col-md-3 mb-3">
                <label for="ano_modelo" class="form-label">Ano Modelo *</label>
                <input type="number" class="form-control" id="ano_modelo" name="ano_modelo" 
                       min="1900" max="{{ date('Y') + 1 }}" value="{{ old('ano_modelo', $veiculo->ano_modelo) }}" required>
            </div>
            
            <!-- Placa -->
            <div class="col-md-3 mb-3">
                <label for="placa" class="form-label">Placa</label>
                <input type="text" class="form-control" id="placa" name="placa" 
                       placeholder="ABC-1234" value="{{ old('placa', $veiculo->placa) }}">
            </div>
            
            <!-- Quilometragem -->
            <div class="col-md-3 mb-3">
                <label for="quilometragem" class="form-label">Quilometragem</label>
                <input type="number" class="form-control" id="quilometragem" name="quilometragem" 
                       placeholder="0" value="{{ old('quilometragem', $veiculo->quilometragem) }}">
            </div>
        </div>
        
        <div class="row">
            <!-- Tipo -->
            <div class="col-md-3 mb-3">
                <label for="tipo" class="form-label">Tipo *</label>
                <select class="form-select" id="tipo" name="tipo" required>
                    <option value="">Selecione</option>
                    <option value="Sedan" {{ old('tipo', $veiculo->tipo) == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                    <option value="SUV" {{ old('tipo', $veiculo->tipo) == 'SUV' ? 'selected' : '' }}>SUV</option>
                    <option value="Hatchback" {{ old('tipo', $veiculo->tipo) == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                    <option value="Picape" {{ old('tipo', $veiculo->tipo) == 'Picape' ? 'selected' : '' }}>Picape</option>
                    <option value="Esportivo" {{ old('tipo', $veiculo->tipo) == 'Esportivo' ? 'selected' : '' }}>Esportivo</option>
                    <option value="Minivan" {{ old('tipo', $veiculo->tipo) == 'Minivan' ? 'selected' : '' }}>Minivan</option>
                </select>
            </div>
            
            <!-- Combustível -->
            <div class="col-md-3 mb-3">
                <label for="combustivel" class="form-label">Combustível *</label>
                <select class="form-select" id="combustivel" name="combustivel" required>
                    <option value="">Selecione</option>
                    <option value="Gasolina" {{ old('combustivel', $veiculo->combustivel) == 'Gasolina' ? 'selected' : '' }}>Gasolina</option>
                    <option value="Etanol" {{ old('combustivel', $veiculo->combustivel) == 'Etanol' ? 'selected' : '' }}>Etanol</option>
                    <option value="Flex" {{ old('combustivel', $veiculo->combustivel) == 'Flex' ? 'selected' : '' }}>Flex</option>
                    <option value="Diesel" {{ old('combustivel', $veiculo->combustivel) == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                    <option value="Elétrico" {{ old('combustivel', $veiculo->combustivel) == 'Elétrico' ? 'selected' : '' }}>Elétrico</option>
                    <option value="Híbrido" {{ old('combustivel', $veiculo->combustivel) == 'Híbrido' ? 'selected' : '' }}>Híbrido</option>
                </select>
            </div>
            
            <!-- Câmbio -->
            <div class="col-md-3 mb-3">
                <label for="cambio" class="form-label">Câmbio *</label>
                <select class="form-select" id="cambio" name="cambio" required>
                    <option value="">Selecione</option>
                    <option value="Manual" {{ old('cambio', $veiculo->cambio) == 'Manual' ? 'selected' : '' }}>Manual</option>
                    <option value="Automático" {{ old('cambio', $veiculo->cambio) == 'Automático' ? 'selected' : '' }}>Automático</option>
                    <option value="Automatizado" {{ old('cambio', $veiculo->cambio) == 'Automatizado' ? 'selected' : '' }}>Automatizado</option>
                    <option value="CVT" {{ old('cambio', $veiculo->cambio) == 'CVT' ? 'selected' : '' }}>CVT</option>
                </select>
            </div>
            
            <!-- Portas -->
            <div class="col-md-3 mb-3">
                <label for="portas" class="form-label">Portas *</label>
                <input type="number" class="form-control" id="portas" name="portas" 
                       min="2" max="5" value="{{ old('portas', $veiculo->portas) }}" required>
            </div>
        </div>
        
        <div class="row">
            <!-- Motor -->
            <div class="col-md-4 mb-3">
                <label for="motor" class="form-label">Motor *</label>
                <input type="text" class="form-control" id="motor" name="motor" 
                       placeholder="Ex: 2.0 Turbo" value="{{ old('motor', $veiculo->motor) }}" required>
            </div>
            
            <!-- Chassi -->
            <div class="col-md-4 mb-3">
                <label for="chassi" class="form-label">Chassi</label>
                <input type="text" class="form-control" id="chassi" name="chassi" 
                       value="{{ old('chassi', $veiculo->chassi) }}">
            </div>
            
            <!-- Renavam -->
            <div class="col-md-4 mb-3">
                <label for="renavam" class="form-label">Renavam</label>
                <input type="text" class="form-control" id="renavam" name="renavam" 
                       value="{{ old('renavam', $veiculo->renavam) }}">
            </div>
        </div>
        
        <div class="row">
            <!-- Preço Compra -->
            <div class="col-md-3 mb-3">
                <label for="preco_compra" class="form-label">Preço de Compra</label>
                <input type="number" class="form-control" id="preco_compra" name="preco_compra" 
                       step="0.01" placeholder="0.00" value="{{ old('preco_compra', $veiculo->preco_compra) }}">
            </div>
            
            <!-- Preço Venda -->
            <div class="col-md-3 mb-3">
                <label for="preco_venda" class="form-label">Preço de Venda *</label>
                <input type="number" class="form-control" id="preco_venda" name="preco_venda" 
                       step="0.01" placeholder="0.00" value="{{ old('preco_venda', $veiculo->preco_venda) }}" required>
            </div>
            
            <!-- Status -->
            <div class="col-md-3 mb-3">
                <label for="status" class="form-label">Status *</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Disponível" {{ old('status', $veiculo->status) == 'Disponível' ? 'selected' : '' }}>Disponível</option>
                    <option value="Vendido" {{ old('status', $veiculo->status) == 'Vendido' ? 'selected' : '' }}>Vendido</option>
                    <option value="Reservado" {{ old('status', $veiculo->status) == 'Reservado' ? 'selected' : '' }}>Reservado</option>
                    <option value="Em Manutenção" {{ old('status', $veiculo->status) == 'Em Manutenção' ? 'selected' : '' }}>Em Manutenção</option>
                </select>
            </div>
            
            <!-- Categoria -->
            <div class="col-md-3 mb-3">
                <label for="categoria" class="form-label">Categoria *</label>
                <select class="form-select" id="categoria" name="categoria" required>
                    <option value="">Selecione</option>
                    <option value="Novo" {{ old('categoria', $veiculo->categoria) == 'Novo' ? 'selected' : '' }}>Novo</option>
                    <option value="Seminovo" {{ old('categoria', $veiculo->categoria) == 'Seminovo' ? 'selected' : '' }}>Seminovo</option>
                    <option value="Usado" {{ old('categoria', $veiculo->categoria) == 'Usado' ? 'selected' : '' }}>Usado</option>
                </select>
            </div>
        </div>
        
        <div class="row">
            <!-- Foto 1 -->
            <div class="col-md-4 mb-3">
                <label for="foto1" class="form-label">Foto 1 (URL)</label>
                <input type="url" class="form-control" id="foto1" name="foto1" 
                       placeholder="https://exemplo.com/foto1.jpg" value="{{ old('foto1', $veiculo->foto1) }}">
            </div>
            
            <!-- Foto 2 -->
            <div class="col-md-4 mb-3">
                <label for="foto2" class="form-label">Foto 2 (URL)</label>
                <input type="url" class="form-control" id="foto2" name="foto2" 
                       placeholder="https://exemplo.com/foto2.jpg" value="{{ old('foto2', $veiculo->foto2) }}">
            </div>
            
            <!-- Foto 3 -->
            <div class="col-md-4 mb-3">
                <label for="foto3" class="form-label">Foto 3 (URL)</label>
                <input type="url" class="form-control" id="foto3" name="foto3" 
                       placeholder="https://exemplo.com/foto3.jpg" value="{{ old('foto3', $veiculo->foto3) }}">
            </div>
        </div>
        
        <div class="row">
            <!-- Foto 4 -->
            <div class="col-md-6 mb-3">
                <label for="foto4" class="form-label">Foto 4 (URL)</label>
                <input type="url" class="form-control" id="foto4" name="foto4" 
                       placeholder="https://exemplo.com/foto4.jpg" value="{{ old('foto4', $veiculo->foto4) }}">
            </div>
            
            <!-- Foto 5 -->
            <div class="col-md-6 mb-3">
                <label for="foto5" class="form-label">Foto 5 (URL)</label>
                <input type="url" class="form-control" id="foto5" name="foto5" 
                       placeholder="https://exemplo.com/foto5.jpg" value="{{ old('foto5', $veiculo->foto5) }}">
            </div>
        </div>
        
        <!-- Descrição -->
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="4" 
                      placeholder="Descreva as características e diferenciais do veículo">{{ old('descricao', $veiculo->descricao) }}</textarea>
        </div>
        
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('admin.veiculos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Voltar
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>Atualizar Veículo
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Filtrar modelos por marca selecionada
    document.getElementById('marca_id').addEventListener('change', function() {
        const marcaId = this.value;
        const modeloSelect = document.getElementById('modelo_id');
        const allOptions = modeloSelect.querySelectorAll('option:not(:first-child)');
        
        allOptions.forEach(option => {
            if (marcaId === '' || option.dataset.marca === marcaId) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        });
        
        modeloSelect.value = '';
    });
</script>
@endpush
