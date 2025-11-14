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
        <div class="row">
            <!-- Galeria de Imagens -->
            <div class="col-lg-7">
                <div class="veiculo-gallery">
                    <img src="{{ asset('FrontCliente/TelaInicial/img1.jpg') }}" class="img-fluid w-100 mb-3" alt="{{ $veiculo->modelo }}">
                </div>
            </div>

            <!-- Informações do Veículo -->
            <div class="col-lg-5">
                <div class="text-white">
                    <h1 class="display-4 fw-bold mb-3">{{ $veiculo->marca->nome ?? 'N/A' }} {{ $veiculo->modelo->nome ?? 'N/A' }}</h1>
                    
                    @if($veiculo->preco_venda)
                    <h2 class="text-info mb-4">{{ $veiculo->preco_venda_formatado }}</h2>
                    @endif

                    <div class="specs-table mb-4">
                        <div class="row">
                            <div class="col-6 text-white-50">Ano:</div>
                            <div class="col-6 text-end fw-bold">{{ $veiculo->ano_fabricacao }}/{{ $veiculo->ano_modelo }}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-white-50">Cor:</div>
                            <div class="col-6 text-end fw-bold">{{ $veiculo->cor->nome ?? 'N/A' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-white-50">Combustível:</div>
                            <div class="col-6 text-end fw-bold">{{ $veiculo->combustivel }}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-white-50">Câmbio:</div>
                            <div class="col-6 text-end fw-bold">{{ $veiculo->cambio }}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-white-50">Portas:</div>
                            <div class="col-6 text-end fw-bold">{{ $veiculo->portas }}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-white-50">Quilometragem:</div>
                            <div class="col-6 text-end fw-bold">{{ number_format($veiculo->quilometragem, 0, ',', '.') }} km</div>
                        </div>
                        @if($veiculo->motor)
                        <div class="row">
                            <div class="col-6 text-white-50">Motor:</div>
                            <div class="col-6 text-end fw-bold">{{ $veiculo->motor }}</div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-6 text-white-50">Tipo:</div>
                            <div class="col-6 text-end fw-bold">{{ $veiculo->tipo }}</div>
                        </div>
                    </div>

                    @if($veiculo->descricao)
                    <div class="mb-4">
                        <h5 class="mb-3">Descrição</h5>
                        <p class="text-white-50">{{ $veiculo->descricao }}</p>
                    </div>
                    @endif

                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-primary btn-lg">Entre em Contato</a>
                        <a href="#" class="btn btn-outline-light btn-lg">Agendar Test Drive</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Veículos Relacionados -->
        @if($relacionados->count() > 0)
        <div class="mt-5 pt-5">
            <h3 class="text-white mb-4">Outros Veículos da {{ $veiculo->marca->nome ?? 'Marca' }}</h3>
            <div class="row g-4">
                @foreach($relacionados as $relacionado)
                <div class="col-lg-4">
                    <div class="card h-100" style="background-color: #1e2936; border: 1px solid rgba(255,255,255,0.1);">
                        <img src="{{ asset('FrontCliente/TelaInicial/img1.jpg') }}" class="card-img-top" alt="{{ $relacionado->modelo->nome ?? 'Veículo' }}">
                        <div class="card-body text-white">
                            <h5 class="card-title">{{ $relacionado->marca->nome ?? 'N/A' }} {{ $relacionado->modelo->nome ?? 'N/A' }}</h5>
                            @if($relacionado->preco_venda)
                            <p class="text-info">{{ $relacionado->preco_venda_formatado }}</p>
                            @endif
                            <a href="{{ route('cliente.veiculo.show', $relacionado->id) }}" class="btn btn-primary">Ver Detalhes</a>
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
