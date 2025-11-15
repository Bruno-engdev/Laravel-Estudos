<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - AutoPrime</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{ asset('admin/css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            /* Sobrescrever cores para tema preto e branco */
            body {
                background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 50%, #2d2d2d 100%);
            }
            .sb-topnav {
                background: rgba(20, 20, 20, 0.95) !important;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }
            .navbar-brand {
                color: #ffffff !important;
                font-weight: 700;
            }
            .sb-sidenav-dark {
                background: linear-gradient(180deg, rgba(15, 15, 15, 0.95) 0%, rgba(45, 45, 45, 0.95) 100%) !important;
                border-right: 1px solid rgba(255, 255, 255, 0.1);
            }
            .sb-sidenav-dark .sb-sidenav-menu-heading {
                color: #b0b0b0 !important;
            }
            .sb-sidenav-dark .nav-link {
                color: #b0b0b0 !important;
                border-left: 3px solid transparent;
            }
            .sb-sidenav-dark .nav-link:hover {
                color: #ffffff !important;
                background: rgba(255, 255, 255, 0.05) !important;
                border-left-color: #ffffff;
            }
            .sb-sidenav-dark .nav-link.active {
                color: #ffffff !important;
                background: rgba(255, 255, 255, 0.08) !important;
                border-left-color: #ffffff;
            }
            .sb-sidenav-dark .sb-sidenav-footer {
                background: rgba(0, 0, 0, 0.3);
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                color: #b0b0b0;
            }
            .btn-primary {
                background: linear-gradient(135deg, #4a4a4a, #2a2a2a) !important;
                border: none !important;
            }
            .btn-primary:hover {
                background: linear-gradient(135deg, #5a5a5a, #3a3a3a) !important;
            }
            #layoutSidenav_content {
                background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 50%, #2d2d2d 100%);
            }
            .card {
                background: rgba(40, 40, 40, 0.95);
                border: 1px solid rgba(255, 255, 255, 0.1);
                color: #ffffff;
            }
            .card-header {
                background: rgba(30, 30, 30, 0.95);
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                color: #ffffff;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ route('admin.veiculos.index') }}">AutoPrime</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-fw"></i> {{ Auth::user()->name ?? 'Administrador' }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-1"></i>Sair
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Gestão</div>
                            <a class="nav-link {{ request()->routeIs('admin.veiculos.*') ? 'active' : '' }}" href="{{ route('admin.veiculos.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-car"></i></div>
                                Veículos
                            </a>
                            <a class="nav-link {{ request()->routeIs('admin.marcas.*') ? 'active' : '' }}" href="{{ route('admin.marcas.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-trademark"></i></div>
                                Marcas
                            </a>
                            <a class="nav-link {{ request()->routeIs('admin.modelos.*') ? 'active' : '' }}" href="{{ route('admin.modelos.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-car-side"></i></div>
                                Modelos
                            </a>
                            <a class="nav-link {{ request()->routeIs('admin.cores.*') ? 'active' : '' }}" href="{{ route('admin.cores.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-palette"></i></div>
                                Cores
                            </a>
                            <a class="nav-link {{ request()->routeIs('admin.clientes.*') ? 'active' : '' }}" href="{{ route('admin.clientes.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Clientes
                            </a>
                            <a class="nav-link {{ request()->routeIs('admin.categoria') ? 'active' : '' }}" href="{{ route('admin.categoria') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                                Categorias
                            </a>
                            <div class="sb-sidenav-menu-heading">Configurações</div>
                            <a class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}" href="{{ route('admin.profile.edit') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-cog"></i></div>
                                Meu Perfil
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Conectado como:</div>
                        {{ Auth::user()->name ?? 'Administrador' }}
                    </div>
                </nav>
            </div>
            @yield("admin")
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="admin/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="admin/assets/demo/chart-area-demo.js"></script>
        <script src="admin/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="admin/js/datatables-simple-demo.js"></script>
    </body>
</html>