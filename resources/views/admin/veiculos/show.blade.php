@extends('admin.layouts.app')

@section('title', 'Detalhes do Veículo')

@section('content')
<div class="mb-4">
    <h1 class="page-title">
        <i class="fas fa-car me-3"></i>Detalhes do Veículo
    </h1>
    <p class="page-subtitle">Visualização completa dos dados do veículo</p>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-info-circle me-2"></i>{{ $veiculo->marca->nome ?? 'N/A' }} {{ $veiculo->modelo->nome ?? 'N/A' }}</span>
        <div>
            <a href="{{ route('admin.veiculos.edit', $veiculo->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit me-1"></i>Editar
            </a>
            <a href="{{ route('admin.veiculos.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <div class="row">
            <!-- Coluna Esquerda - Imagem Principal -->
            <div class="col-lg-5 mb-4">
                @if($veiculo->foto1)
                    <img src="{{ $veiculo->foto1 }}" class="img-fluid rounded shadow-sm w-100" style="max-height: 400px; object-fit: cover;" alt="{{ $veiculo->marca->nome ?? '' }} {{ $veiculo->modelo->nome ?? '' }}">
                @else
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="height: 400px;">
                        <i class="fas fa-car fa-5x text-white-50"></i>
                    </div>
                @endif
                
                <!-- Fotos Adicionais -->
                @if($veiculo->foto2 || $veiculo->foto3 || $veiculo->foto4 || $veiculo->foto5)
                <div class="mt-3">
                    <h6 class="text-white mb-2">Fotos Adicionais:</h6>
                    <div class="row g-2">
                        @if($veiculo->foto2)
                        <div class="col-6">
                            <img src="{{ $veiculo->foto2 }}" class="img-fluid rounded" style="height: 100px; width: 100%; object-fit: cover;" alt="Foto 2">
                        </div>
                        @endif
                        @if($veiculo->foto3)
                        <div class="col-6">
                            <img src="{{ $veiculo->foto3 }}" class="img-fluid rounded" style="height: 100px; width: 100%; object-fit: cover;" alt="Foto 3">
                        </div>
                        @endif
                        @if($veiculo->foto4)
                        <div class="col-6">
                            <img src="{{ $veiculo->foto4 }}" class="img-fluid rounded" style="height: 100px; width: 100%; object-fit: cover;" alt="Foto 4">
                        </div>
                        @endif
                        @if($veiculo->foto5)
                        <div class="col-6">
                            <img src="{{ $veiculo->foto5 }}" class="img-fluid rounded" style="height: 100px; width: 100%; object-fit: cover;" alt="Foto 5">
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Coluna Direita - Informações -->
            <div class="col-lg-7">
                <!-- Informações Básicas -->
                <div class="mb-4">
                    <h5 class="text-white border-bottom pb-2 mb-3">
                        <i class="fas fa-info-circle me-2"></i>Informações Básicas
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="text-white-50 small">Marca:</label>
                            <p class="text-white fw-bold mb-0">{{ $veiculo->marca->nome ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-white-50 small">Modelo:</label>
                            <p class="text-white fw-bold mb-0">{{ $veiculo->modelo->nome ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-white-50 small">Cor:</label>
                            <p class="text-white fw-bold mb-0">{{ $veiculo->cor->nome ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-white-50 small">Tipo:</label>
                            <p class="text-white fw-bold mb-0">{{ $veiculo->tipo }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-white-50 small">Ano Fabricação/Modelo:</label>
                            <p class="text-white fw-bold mb-0">{{ $veiculo->ano_fabricacao }}/{{ $veiculo->ano_modelo }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-white-50 small">Status:</label>
                            <p class="mb-0">
                                <span class="badge bg-{{ $veiculo->status == 'Disponível' ? 'success' : ($veiculo->status == 'Vendido' ? 'danger' : 'warning') }}">
                                    {{ $veiculo->status }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Especificações Técnicas -->
                <div class="mb-4">
                    <h5 class="text-white border-bottom pb-2 mb-3">
                        <i class="fas fa-cogs me-2"></i>Especificações Técnicas
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="text-white-50 small">Combustível:</label>
                            <p class="text-white fw-bold mb-0">{{ $veiculo->combustivel }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-white-50 small">Câmbio:</label>
                            <p class="text-white fw-bold mb-0">{{ $veiculo->cambio }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-white-50 small">Motor:</label>
                            <p class="text-white fw-bold mb-0">{{ $veiculo->motor ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-white-50 small">Portas:</label>
                            <p class="text-white fw-bold mb-0">{{ $veiculo->portas }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-white-50 small">Quilometragem:</label>
                            <p class="text-white fw-bold mb-0">{{ number_format($veiculo->quilometragem, 0, ',', '.') }} km</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-white-50 small">Categoria:</label>
                            <p class="text-white fw-bold mb-0">{{ $veiculo->categoria }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Documentação -->
                @if($veiculo->placa || $veiculo->chassi || $veiculo->renavam)
                <div class="mb-4">
                    <h5 class="text-white border-bottom pb-2 mb-3">
                        <i class="fas fa-file-alt me-2"></i>Documentação
                    </h5>
                    <div class="row g-3">
                        @if($veiculo->placa)
                        <div class="col-md-4">
                            <label class="text-white-50 small">Placa:</label>
                            <p class="text-white fw-bold mb-0">{{ $veiculo->placa }}</p>
                        </div>
                        @endif
                        @if($veiculo->chassi)
                        <div class="col-md-4">
                            <label class="text-white-50 small">Chassi:</label>
                            <p class="text-white fw-bold mb-0">{{ $veiculo->chassi }}</p>
                        </div>
                        @endif
                        @if($veiculo->renavam)
                        <div class="col-md-4">
                            <label class="text-white-50 small">Renavam:</label>
                            <p class="text-white fw-bold mb-0">{{ $veiculo->renavam }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                
                <!-- Valores -->
                <div class="mb-4">
                    <h5 class="text-white border-bottom pb-2 mb-3">
                        <i class="fas fa-dollar-sign me-2"></i>Valores
                    </h5>
                    <div class="row g-3">
                        @if($veiculo->preco_compra)
                        <div class="col-md-6">
                            <label class="text-white-50 small">Preço de Compra:</label>
                            <p class="text-white fw-bold mb-0">R$ {{ number_format($veiculo->preco_compra, 2, ',', '.') }}</p>
                        </div>
                        @endif
                        @if($veiculo->preco_venda)
                        <div class="col-md-6">
                            <label class="text-white-50 small">Preço de Venda:</label>
                            <p class="text-success fw-bold mb-0 fs-5">R$ {{ number_format($veiculo->preco_venda, 2, ',', '.') }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Descrição -->
                @if($veiculo->descricao)
                <div class="mb-4">
                    <h5 class="text-white border-bottom pb-2 mb-3">
                        <i class="fas fa-align-left me-2"></i>Descrição
                    </h5>
                    <p class="text-white-50">{{ $veiculo->descricao }}</p>
                </div>
                @endif
                
                <!-- Informações de Registro -->
                <div class="mt-4 pt-3 border-top">
                    <small class="text-white-50">
                        <i class="fas fa-clock me-1"></i>
                        Cadastrado em: {{ $veiculo->created_at->format('d/m/Y H:i') }}
                        @if($veiculo->updated_at != $veiculo->created_at)
                            | Atualizado em: {{ $veiculo->updated_at->format('d/m/Y H:i') }}
                        @endif
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
