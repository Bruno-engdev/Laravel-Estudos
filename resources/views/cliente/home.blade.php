@extends('cliente.layouts.app')

@section('title', 'Home - AutoPrime Loja Automotiva')

@section('body-class', 'no-scroll')

@push('styles')
<link rel="stylesheet" href="{{ asset('FrontCliente/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('FrontCliente/css/pages/home.css') }}">
@endpush

@section('preloader')
<!-- Preloader -->
<div id="preloader" role="status" aria-live="polite">
    <img src="{{ asset('FrontCliente/TelaInicial/logosite.png') }}" alt="Logo" class="preloader-logo">
</div>
@endsection

@section('content')
<!-- Hero Section com Carousel -->
<section class="hero">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('FrontCliente/TelaInicial/img1.jpg') }}" class="d-block w-100" alt="Carro Esportivo">
                <div class="carousel-caption d-none d-md-block" style="right:70%; top:35%">
                    <h2 class="fw-bold text-uppercase" style="font-size: 24px">NOVO BMW</h2>
                    <h1 class="fw-bold text-uppercase" style="font-size: 120px">M4</h1>
                    <button type="button" class="btn btn-primary btn-lg">Descubra</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('FrontCliente/TelaInicial/sw4.png') }}" class="d-block w-100" alt="SUV Familiar" style="background-position: center 100%">
                <div class="carousel-caption d-none d-md-block" style="left:40%">
                    <h2 class="fw-bold text-uppercase" style="font-size: 24px">NOVO TOYOTA</h2>
                    <h1 class="fw-bold text-uppercase" style="font-size: 120px">SW4</h1>
                    <button type="button" class="btn btn-primary btn-lg">Detalhes</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('FrontCliente/TelaInicial/byd.png') }}" class="d-block w-100" alt="Carro Elétrico">
                <div class="carousel-caption d-none d-md-block" style="top:80%">
                    <h2 class="fw-bold text-uppercase">O futuro chegou. E é silencioso.</h2>
                    <p>Tecnologia elétrica, potência sustentável!</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>
</section>

<!-- Seção de Veículos -->
<section class="services text-center my-5 px-3" style="padding-top: 200px;">
    <h2>Encontre seu veículo</h2>
    <section class="veiculos py-5">
        <div class="container text-center">
            <div class="row justify-content-center g-4 flex-nowrap overflow-auto">
                @foreach($veiculos as $veiculo)
                <div class="col-md-4">
                    <div class="card vehicle-card">
                        <img src="{{ asset('FrontCliente/TelaInicial/img1.jpg') }}" class="card-img-top" alt="{{ $veiculo->modelo }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $veiculo->marca }} {{ $veiculo->modelo }}</h5>
                            <p class="card-text">{{ Str::limit($veiculo->descricao, 50) }}</p>
                            <a href="{{ route('cliente.veiculo.show', $veiculo->id) }}" class="btn btn-outline-primary">Ver Detalhes</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</section>
@endsection

@push('scripts')
<script>
// Preloader com tempo mínimo de exibição
const startTime = Date.now();
const MIN_PRELOAD = 3000; // 3 segundos

window.addEventListener('load', () => {
    const preloader = document.getElementById('preloader');
    const elapsed = Date.now() - startTime;
    const remaining = Math.max(0, MIN_PRELOAD - elapsed);

    setTimeout(() => {
        preloader.classList.add('fade-out');
        document.body.classList.remove('no-scroll');
        setTimeout(() => preloader.remove(), 700);
    }, remaining);
});

// Garantia: se 'load' demorar muito (>8s), força saída
setTimeout(() => {
    if (!document.body.classList.contains('no-scroll')) return;
    const preloader = document.getElementById('preloader');
    preloader.classList.add('fade-out');
    document.body.classList.remove('no-scroll');
    setTimeout(() => preloader.remove(), 700);
}, 8000);

// Navbar esconde ao rolar para baixo e mostra ao rolar para cima
let lastScrollTop = 0;
const navbar = document.querySelector('.navbar');

window.addEventListener('scroll', () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop) {
        navbar.classList.add('hidden');
    } else {
        navbar.classList.remove('hidden');
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
});
</script>
@endpush
