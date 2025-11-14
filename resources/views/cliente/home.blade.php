@extends('cliente.layouts.app')

@section('title', 'Home - AutoPrime Loja Automotiva')

@section('body-class', 'no-scroll')

@push('styles')
<link rel="stylesheet" href="{{ asset('FrontCliente/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('FrontCliente/css/pages/home.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

<!-- NOVA SEÇÃO: Últimos Veículos Cadastrados -->
<section class="latest-vehicles">
    <div class="container">
        <h2>Últimos <span>Veículos</span> Cadastrados</h2>
        
        <div class="vehicles-scroll-container">
            <div class="vehicles-row">
                @forelse($veiculos->take(5) as $veiculo)
                <div class="vehicle-card-latest">
                    <div class="card-image">
                        <img src="{{ asset('FrontCliente/TelaInicial/img1.jpg') }}" 
                             alt="{{ $veiculo->marca }} {{ $veiculo->modelo }}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $veiculo->marca->nome ?? 'N/A' }} {{ $veiculo->modelo->nome ?? 'N/A' }}</h5>
                        <div class="card-info">
                            <span class="card-year">{{ $veiculo->ano_modelo }}</span>
                            <span class="card-price">R$ {{ number_format($veiculo->preco_venda, 2, ',', '.') }}</span>
                        </div>
                        <p class="card-description">
                            {{ $veiculo->descricao ?? 'Veículo em excelente estado de conservação.' }}
                        </p>
                        <a href="{{ route('cliente.veiculo.show', $veiculo->id) }}" class="btn-view">
                            Ver Detalhes
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p style="color: rgba(255,255,255,0.7);">Nenhum veículo cadastrado ainda.</p>
                </div>
                @endforelse
            </div>
        </div>
        
        <div class="scroll-buttons">
            <button class="scroll-btn prev">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="scroll-btn next">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
        
        <a href="{{ route('cliente.modelos') }}" class="view-all-btn">
            Ver Todos os Veículos
        </a>
    </div>
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

// JavaScript para o scroll horizontal dos veículos
document.addEventListener('DOMContentLoaded', function() {
    const scrollContainer = document.querySelector('.vehicles-scroll-container');
    const prevBtn = document.querySelector('.scroll-btn.prev');
    const nextBtn = document.querySelector('.scroll-btn.next');
    
    if (scrollContainer && prevBtn && nextBtn) {
        const cardWidth = 345; // largura do card + gap
        
        // Função para atualizar estado dos botões
        function updateButtons() {
            const scrollLeft = scrollContainer.scrollLeft;
            const maxScroll = scrollContainer.scrollWidth - scrollContainer.clientWidth;
            
            prevBtn.disabled = scrollLeft <= 0;
            nextBtn.disabled = scrollLeft >= maxScroll - 10; // margem de erro
        }
        
        // Scroll para esquerda
        prevBtn.addEventListener('click', () => {
            scrollContainer.scrollBy({
                left: -cardWidth,
                behavior: 'smooth'
            });
            setTimeout(updateButtons, 300);
        });
        
        // Scroll para direita
        nextBtn.addEventListener('click', () => {
            scrollContainer.scrollBy({
                left: cardWidth,
                behavior: 'smooth'
            });
            setTimeout(updateButtons, 300);
        });
        
        // Atualizar botões no scroll
        scrollContainer.addEventListener('scroll', updateButtons);
        
        // Inicializar estado dos botões
        updateButtons();
        
        // Touch/swipe support para mobile
        let isDown = false;
        let startX;
        let scrollLeftStart;
        
        scrollContainer.addEventListener('mousedown', (e) => {
            isDown = true;
            startX = e.pageX - scrollContainer.offsetLeft;
            scrollLeftStart = scrollContainer.scrollLeft;
        });
        
        scrollContainer.addEventListener('mouseleave', () => {
            isDown = false;
        });
        
        scrollContainer.addEventListener('mouseup', () => {
            isDown = false;
        });
        
        scrollContainer.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - scrollContainer.offsetLeft;
            const walk = (x - startX) * 2;
            scrollContainer.scrollLeft = scrollLeftStart - walk;
        });
    }
});
</script>
@endpush
