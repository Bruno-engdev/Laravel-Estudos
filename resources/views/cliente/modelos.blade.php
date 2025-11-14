@extends('cliente.layouts.app')

@section('title', 'Modelos - AutoPrime')

@section('body-class', 'modelos-page')

@push('styles')
<link rel="stylesheet" href="{{ asset('FrontCliente/css/pages/modelos.css') }}">
@endpush

@section('content')
<main class="container my-5">
    <h1 class="text-center mb-5 text-white" style="padding-top: 100px;">Nossos Modelos</h1>
    
    <div class="row g-4">
        @forelse($veiculos as $veiculo)
        <div class="col-lg-4 col-md-6">
            <div class="card h-100" style="background-color: #1e2936; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 8px 32px rgba(0,0,0,0.3);">
                <img src="{{ asset('FrontCliente/TelaInicial/img1.jpg') }}" class="card-img-top" alt="{{ $veiculo->modelo->nome ?? 'Veículo' }}">
                <div class="card-body d-flex flex-column text-white">
                    <h5 class="card-title text-white">{{ $veiculo->marca->nome ?? 'N/A' }} {{ $veiculo->modelo->nome ?? 'N/A' }}</h5>
                    <p class="card-text text-light">
                        @if($veiculo->descricao)
                            {{ Str::limit($veiculo->descricao, 80) }}
                        @else
                            Ano {{ $veiculo->ano_modelo }} • {{ $veiculo->combustivel }} • {{ $veiculo->cambio }}
                        @endif
                    </p>
                    <div class="mt-auto">
                        @if($veiculo->preco_venda)
                        <p class="h5 text-info mb-2">A partir de {{ $veiculo->preco_venda_formatado }}</p>
                        @endif
                        <a href="{{ route('cliente.veiculo.show', $veiculo->id) }}" class="btn btn-primary">Ver Detalhes</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <h4>Nenhum veículo disponível no momento</h4>
                <p>Estamos atualizando nosso estoque. Volte em breve!</p>
            </div>
        </div>
        @endforelse
    </div>
    
    <!-- Paginação -->
    @if($veiculos->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $veiculos->links() }}
    </div>
    @endif
</main>
@endsection
