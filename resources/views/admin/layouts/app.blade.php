<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - AutoPrime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Exo 2', 'Arial Narrow', Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 50%, #2d2d2d 100%);
            color: #ffffff;
            font-weight: 300;
            letter-spacing: 0.5px;
            min-height: 100vh;
        }

        .sidebar {
            background: linear-gradient(180deg, rgba(15, 15, 15, 0.95) 0%, rgba(45, 45, 45, 0.95) 100%);
            backdrop-filter: blur(15px);
            width: 280px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            transition: all 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            background: rgba(255, 255, 255, 0.02);
        }

        .admin-logo {
            color: #ffffff;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .admin-subtitle {
            color: #b0b0b0;
            font-size: 0.85rem;
            font-weight: 300;
        }

        .sidebar-nav {
            padding: 1.5rem 0;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            color: #b0b0b0;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            font-weight: 400;
        }

        .nav-link:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.05);
            border-left-color: #ffffff;
        }

        .nav-link.active {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.08);
            border-left-color: #ffffff;
            font-weight: 600;
        }

        .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
            text-align: center;
        }

        .main-content {
            margin-left: 280px;
            transition: all 0.3s ease;
            min-height: 100vh;
        }

        .main-content.expanded {
            margin-left: 70px;
        }

        .top-navbar {
            background: rgba(20, 20, 20, 0.95);
            backdrop-filter: blur(15px);
            padding: 1.2rem 2rem;
            border-bottom: 1px solid rgba(0, 180, 216, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        .toggle-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            font-size: 1.2rem;
            color: #ffffff;
            cursor: pointer;
            padding: 0.5rem;
            transition: all 0.3s ease;
        }

        .toggle-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: scale(1.05);
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .admin-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #4a4a4a, #2a2a2a);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.5);
        }

        .content-area {
            padding: 2.5rem;
        }

        .page-title {
            color: #ffffff;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .page-subtitle {
            color: #b0b0b0;
            font-size: 1rem;
            margin-bottom: 2rem;
            font-weight: 300;
        }

        .card {
            background: rgba(40, 40, 40, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            margin-bottom: 2rem;
        }

        .card-header {
            color: #ffffff;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.8rem;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #4a4a4a, #2a2a2a);
            border: none;
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.6);
        }

        .btn-secondary {
            background: rgba(108, 117, 125, 0.3);
            border: 1px solid rgba(108, 117, 125, 0.5);
            color: #b0b0b0;
        }

        .btn-danger {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid rgba(220, 53, 69, 0.5);
            color: #dc3545;
        }

        .btn-danger:hover {
            background: rgba(220, 53, 69, 0.3);
            color: #fff;
        }

        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(0, 180, 216, 0.3);
            color: #ffffff;
            padding: 0.75rem 1rem;
            border-radius: 8px;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #ffffff;
            color: #ffffff;
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.15);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-label {
            color: #ffffff;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .table {
            color: #ffffff;
        }

        .table thead th {
            background: rgba(0, 180, 216, 0.1);
            color: #00b4d8;
            border-color: rgba(0, 180, 216, 0.3);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
        }

        .table tbody tr {
            border-color: rgba(255, 255, 255, 0.1);
        }

        .table tbody tr:hover {
            background: rgba(0, 180, 216, 0.05);
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.2);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.3);
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        .btn-logout {
            background: linear-gradient(135deg, #dc3545, #c82333);
            border: none;
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-logout:hover {
            background: linear-gradient(135deg, #c82333, #bd2130);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            
            .main-content {
                margin-left: 70px;
            }
            
            .content-area {
                padding: 1.5rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="admin-logo">AutoPrime</div>
            <div class="admin-subtitle">Painel Administrativo</div>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.veiculos.index') }}" class="nav-link {{ request()->routeIs('admin.veiculos.*') ? 'active' : '' }}">
                    <i class="fas fa-car"></i>
                    <span class="nav-text">Veículos</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.marcas.index') }}" class="nav-link {{ request()->routeIs('admin.marcas.*') ? 'active' : '' }}">
                    <i class="fas fa-trademark"></i>
                    <span class="nav-text">Marcas</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.modelos.index') }}" class="nav-link {{ request()->routeIs('admin.modelos.*') ? 'active' : '' }}">
                    <i class="fas fa-car-side"></i>
                    <span class="nav-text">Modelos</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.cores.index') }}" class="nav-link {{ request()->routeIs('admin.cores.*') ? 'active' : '' }}">
                    <i class="fas fa-palette"></i>
                    <span class="nav-text">Cores</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.clientes.index') }}" class="nav-link {{ request()->routeIs('admin.clientes.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">Clientes</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.categoria') }}" class="nav-link {{ request()->routeIs('admin.categoria') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i>
                    <span class="nav-text">Categorias</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <button class="toggle-btn" id="toggleBtn">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="admin-info">
                <span>Bem-vindo, <strong>{{ Auth::user()->name ?? 'Administrador' }}</strong></span>
                <div class="admin-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-logout">
                        <i class="fas fa-sign-out-alt me-1"></i>Sair
                    </button>
                </form>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Sidebar
        document.getElementById('toggleBtn').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

        // Auto-hide alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                if (alert.classList.contains('show')) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            });
        }, 5000);
    </script>
    @stack('scripts')
</body>
</html>
