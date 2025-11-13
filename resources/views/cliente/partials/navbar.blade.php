<header>
    @if(Request::is('/') || Request::is('home'))
    <div class="a-login">Login</div>
    @endif
    
    <nav class="navbar navbar-expand-lg navbar-light floating-nav">
        <div class="container-fluid justify-content-center position-relative">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mx-3">
                        <a href="{{ route('cliente.home') }}">
                            <img src="{{ asset('FrontCliente/TelaInicial/logosite.png') }}" alt="Logo" style="height: 100px;">
                        </a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link {{ Request::is('modelos') ? 'active' : '' }}" href="{{ route('cliente.modelos') }}">Modelos</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">Eventos</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">Financiamento</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">Ofertas</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">Test Ride</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">Concessionárias</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">Suporte</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">Contato</a>
                    </li>
                    @auth('cliente')
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="{{ route('cliente.dashboard') }}">Minha Conta</a>
                    </li>
                    <li class="nav-item mx-3">
                        <form action="{{ route('cliente.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link">Sair</button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="{{ route('cliente.login') }}">Login</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
