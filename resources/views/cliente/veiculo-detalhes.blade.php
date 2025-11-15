@extends('cliente.layouts.app')

@section('title', ($veiculo->marca->nome ?? 'N/A') . ' ' . ($veiculo->modelo->nome ?? 'N/A') . ' - AutoPrime')

@push('styles')
<link rel="stylesheet" href="{{ asset('FrontCliente/css/pages/modelos.css') }}">
<style>
.veiculo-detalhes {
    padding-top: 120px;
    background-color: #0d1b2a;
    min-height: 100vh;
}
.veiculo-gallery img {
    border-radius: 10px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.3);
}
.specs-table {
    background-color: #1e2936;
    border-radius: 10px;
    padding: 20px;
}
.specs-table .row {
    border-bottom: 1px solid rgba(255,255,255,0.1);
    padding: 10px 0;
}
.specs-table .row:last-child {
    border-bottom: none;
}
</style>
@endpush

@section('content')
<div class="veiculo-detalhes">
    <div class="container">
        <!-- Botão Voltar -->
        <div class="mb-4">
            <a href="{{ route('cliente.modelos') }}" class="btn btn-outline-light">
                <i class="fas fa-arrow-left me-2"></i>Voltar para Veículos
            </a>
        </div>

        <!-- Card Principal com Imagem e Dados -->
        <div class="card mb-5" style="background-color: #1e2936; border: 1px solid rgba(255,255,255,0.1); border-radius: 15px; overflow: hidden;">
            <div class="row g-0">
                <!-- Imagem à Esquerda -->
                <div class="col-lg-6">
                    <div class="position-relative h-100">
                        @if($veiculo->foto1)
                            <img src="{{ $veiculo->foto1 }}" class="w-100 h-100" style="object-fit: cover; min-height: 400px;" alt="{{ $veiculo->marca->nome ?? '' }} {{ $veiculo->modelo->nome ?? '' }}">
                        @else
                            <img src="{{ asset('FrontCliente/TelaInicial/img1.jpg') }}" class="w-100 h-100" style="object-fit: cover; min-height: 400px;" alt="{{ $veiculo->marca->nome ?? '' }} {{ $veiculo->modelo->nome ?? '' }}">
                        @endif
                        
                        <!-- Badge de Status -->
                        <div class="position-absolute top-0 start-0 m-3">
                            <span class="badge bg-success fs-6 px-3 py-2">{{ $veiculo->status }}</span>
                        </div>
                    </div>
                </div>

                <!-- Dados à Direita -->
                <div class="col-lg-6">
                    <div class="p-4 p-lg-5 text-white h-100 d-flex flex-column">
                        <!-- Título e Preço -->
                        <div class="mb-4">
                            <h1 class="display-5 fw-bold mb-3">
                                {{ $veiculo->marca->nome ?? 'N/A' }} {{ $veiculo->modelo->nome ?? 'N/A' }}
                            </h1>
                            
                            @if($veiculo->preco_venda)
                            <h2 class="text-white mb-0" style="font-size: 2.5rem; font-weight: 700;">
                                R$ {{ number_format($veiculo->preco_venda, 2, ',', '.') }}
                            </h2>
                            @endif
                        </div>

                        <!-- Especificações -->
                        <div class="specs-table mb-4 flex-grow-1">
                            <h5 class="mb-3 pb-2 border-bottom border-secondary">Especificações</h5>
                            
                            <div class="row mb-2">
                                <div class="col-5 text-white-50"><i class="fas fa-calendar me-2"></i>Ano:</div>
                                <div class="col-7 fw-bold">{{ $veiculo->ano_fabricacao }}/{{ $veiculo->ano_modelo }}</div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-5 text-white-50"><i class="fas fa-palette me-2"></i>Cor:</div>
                                <div class="col-7 fw-bold">{{ $veiculo->cor->nome ?? 'N/A' }}</div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-5 text-white-50"><i class="fas fa-gas-pump me-2"></i>Combustível:</div>
                                <div class="col-7 fw-bold">{{ $veiculo->combustivel }}</div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-5 text-white-50"><i class="fas fa-cog me-2"></i>Câmbio:</div>
                                <div class="col-7 fw-bold">{{ $veiculo->cambio }}</div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-5 text-white-50"><i class="fas fa-door-open me-2"></i>Portas:</div>
                                <div class="col-7 fw-bold">{{ $veiculo->portas }}</div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-5 text-white-50"><i class="fas fa-tachometer-alt me-2"></i>Km:</div>
                                <div class="col-7 fw-bold">{{ number_format($veiculo->quilometragem, 0, ',', '.') }} km</div>
                            </div>
                            
                            @if($veiculo->motor)
                            <div class="row mb-2">
                                <div class="col-5 text-white-50"><i class="fas fa-engine me-2"></i>Motor:</div>
                                <div class="col-7 fw-bold">{{ $veiculo->motor }}</div>
                            </div>
                            @endif
                            
                            <div class="row mb-2">
                                <div class="col-5 text-white-50"><i class="fas fa-car me-2"></i>Tipo:</div>
                                <div class="col-7 fw-bold">{{ $veiculo->tipo }}</div>
                            </div>

                            @if($veiculo->placa)
                            <div class="row mb-2">
                                <div class="col-5 text-white-50"><i class="fas fa-id-card me-2"></i>Placa:</div>
                                <div class="col-7 fw-bold">{{ $veiculo->placa }}</div>
                            </div>
                            @endif
                        </div>

                        @if($veiculo->descricao)
                        <div class="mb-4">
                            <h5 class="mb-3 pb-2 border-bottom border-secondary">Descrição</h5>
                            <p class="text-white-50">{{ $veiculo->descricao }}</p>
                        </div>
                        @endif

                        <!-- Botões de Ação -->
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-light btn-lg fw-bold">
                                <i class="fas fa-phone me-2"></i>Entre em Contato
                            </a>
                            <a href="#" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-calendar-check me-2"></i>Agendar Test Drive
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fotos Adicionais -->
        @if($veiculo->foto2 || $veiculo->foto3 || $veiculo->foto4 || $veiculo->foto5)
        <div class="mb-5">
            <h3 class="text-white mb-4">Mais Fotos</h3>
            <div class="row g-3">
                @if($veiculo->foto2)
                <div class="col-md-6">
                    <img src="{{ $veiculo->foto2 }}" class="img-fluid rounded" style="width: 100%; height: 300px; object-fit: cover;" alt="Foto 2">
                </div>
                @endif
                @if($veiculo->foto3)
                <div class="col-md-6">
                    <img src="{{ $veiculo->foto3 }}" class="img-fluid rounded" style="width: 100%; height: 300px; object-fit: cover;" alt="Foto 3">
                </div>
                @endif
                @if($veiculo->foto4)
                <div class="col-md-6">
                    <img src="{{ $veiculo->foto4 }}" class="img-fluid rounded" style="width: 100%; height: 300px; object-fit: cover;" alt="Foto 4">
                </div>
                @endif
                @if($veiculo->foto5)
                <div class="col-md-6">
                    <img src="{{ $veiculo->foto5 }}" class="img-fluid rounded" style="width: 100%; height: 300px; object-fit: cover;" alt="Foto 5">
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Veículos Relacionados -->
        @if(isset($veiculosRelacionados) && $veiculosRelacionados->count() > 0)
        <div class="mt-5 pt-5">
            <h3 class="text-white mb-4">Você também pode gostar</h3>
            <div class="row g-4">
                @foreach($veiculosRelacionados as $relacionado)
                <div class="col-lg-3 col-md-6">
                    <div class="card h-100" style="background-color: #1e2936; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; overflow: hidden; transition: transform 0.3s;">
                        @if($relacionado->foto1)
                            <img src="{{ $relacionado->foto1 }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $relacionado->modelo->nome ?? 'Veículo' }}">
                        @else
                            <img src="{{ asset('FrontCliente/TelaInicial/img1.jpg') }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $relacionado->modelo->nome ?? 'Veículo' }}">
                        @endif
                        <div class="card-body text-white">
                            <h6 class="card-title">{{ $relacionado->marca->nome ?? 'N/A' }} {{ $relacionado->modelo->nome ?? 'N/A' }}</h6>
                            <p class="text-white-50 small mb-2">{{ $relacionado->ano_modelo }} • {{ $relacionado->combustivel }}</p>
                            @if($relacionado->preco_venda)
                            <p class="text-white fw-bold mb-3">R$ {{ number_format($relacionado->preco_venda, 2, ',', '.') }}</p>
                            @endif
                            <a href="{{ route('cliente.veiculo.show', $relacionado->id) }}" class="btn btn-outline-light btn-sm w-100">Ver Detalhes</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
