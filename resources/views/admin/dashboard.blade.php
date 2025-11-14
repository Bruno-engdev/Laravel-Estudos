<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - AutoPrime</title>
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
            border-right: 1px solid rgba(0, 180, 216, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(0, 180, 216, 0.2);
            text-align: center;
            background: rgba(0, 180, 216, 0.1);
        }

        .sidebar.collapsed .sidebar-header {
            padding: 1.5rem 1rem;
        }

        .admin-logo {
            color: #00b4d8;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .sidebar.collapsed .admin-logo {
            font-size: 1.2rem;
        }

        .admin-subtitle {
            color: #b0b0b0;
            font-size: 0.85rem;
            font-weight: 300;
        }

        .sidebar.collapsed .admin-subtitle {
            display: none;
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
            position: relative;
        }

        .sidebar.collapsed .nav-link {
            padding: 1rem;
            justify-content: center;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #00b4d8, #0096c7);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: #00b4d8;
            background: rgba(0, 180, 216, 0.1);
            border-left-color: #00b4d8;
            text-shadow: 1px 1px 2px rgba(0, 180, 216, 0.3);
        }

        .nav-link.active {
            color: #00b4d8;
            background: rgba(0, 180, 216, 0.15);
            border-left-color: #00b4d8;
            font-weight: 600;
        }

        .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
            text-align: center;
        }

        .sidebar.collapsed .nav-link i {
            margin-right: 0;
        }

        .sidebar.collapsed .nav-text {
            display: none;
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
            background: rgba(0, 180, 216, 0.1);
            border: 1px solid rgba(0, 180, 216, 0.3);
            border-radius: 8px;
            font-size: 1.2rem;
            color: #00b4d8;
            cursor: pointer;
            padding: 0.5rem;
            transition: all 0.3s ease;
        }

        .toggle-btn:hover {
            background: rgba(0, 180, 216, 0.2);
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
            background: linear-gradient(135deg, #00b4d8, #0096c7);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 4px 16px rgba(0, 180, 216, 0.3);
        }

        .content-area {
            padding: 2.5rem;
        }

        .page-title {
            color: #00b4d8;
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

        .stats-row {
            margin-bottom: 3rem;
        }

        .stat-card {
            background: rgba(40, 40, 40, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid rgba(0, 180, 216, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #00b4d8, #0096c7);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 50px rgba(0, 180, 216, 0.2);
            border-color: #00b4d8;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #00b4d8;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .stat-label {
            color: #b0b0b0;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 400;
        }

        .stat-icon {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            font-size: 2.5rem;
            opacity: 0.2;
            color: #00b4d8;
        }

        .vehicles-section {
            background: rgba(40, 40, 40, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid rgba(0, 180, 216, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .section-title {
            color: #00b4d8;
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.8rem;
            border-bottom: 2px solid #00b4d8;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .vehicles-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .vehicles-table thead th {
            background: rgba(0, 180, 216, 0.1);
            color: #00b4d8;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid rgba(0, 180, 216, 0.3);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .vehicles-table tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .vehicles-table tbody tr:hover {
            background: rgba(0, 180, 216, 0.05);
            transform: scale(1.01);
        }

        .vehicles-table tbody td {
            padding: 1rem;
            color: #ffffff;
            font-weight: 300;
        }

        .vehicle-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            border: 2px solid rgba(0, 180, 216, 0.3);
        }

        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-disponivel {
            background: rgba(40, 167, 69, 0.2);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.3);
        }

        .status-vendido {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        .status-reservado {
            background: rgba(255, 193, 7, 0.2);
            color: #ffc107;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        .status-em-manutencao {
            background: rgba(108, 117, 125, 0.2);
            color: #6c757d;
            border: 1px solid rgba(108, 117, 125, 0.3);
        }

        .status-indisponivel {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        .price-tag {
            color: #28a745;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .btn-action {
            background: rgba(0, 180, 216, 0.1);
            border: 1px solid rgba(0, 180, 216, 0.3);
            color: #00b4d8;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-size: 0.8rem;
            transition: all 0.3s ease;
            margin: 0 0.2rem;
        }

        .btn-action:hover {
            background: rgba(0, 180, 216, 0.2);
            color: #ffffff;
            transform: scale(1.05);
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

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.3;
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

            .vehicles-table {
                font-size: 0.8rem;
            }

            .vehicles-table th,
            .vehicles-table td {
                padding: 0.6rem;
            }
        }

        /* Scrollbar personalizada */
        .vehicles-section::-webkit-scrollbar {
            width: 8px;
        }

        .vehicles-section::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }

        .vehicles-section::-webkit-scrollbar-thumb {
            background: rgba(0, 180, 216, 0.6);
            border-radius: 4px;
        }

        .vehicles-section::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 180, 216, 0.8);
        }
    </style>
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
                <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#vehicles" class="nav-link">
                    <i class="fas fa-car"></i>
                    <span class="nav-text">Veículos</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.clientes.index') }}" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">Clientes</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.categoria') }}" class="nav-link">
                    <i class="fas fa-tags"></i>
                    <span class="nav-text">Categorias</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-bar"></i>
                    <span class="nav-text">Relatórios</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span class="nav-text">Configurações</span>
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
            <h1 class="page-title">
                <i class="fas fa-tachometer-alt me-3"></i>Dashboard Administrativo
            </h1>
            <p class="page-subtitle">Visão geral completa da AutoPrime</p>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="row stats-row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <div class="stat-number">{{ $totalVeiculos ?? 0 }}</div>
                        <div class="stat-label">Total de Veículos</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-number">{{ $veiculosAtivos ?? 0 }}</div>
                        <div class="stat-label">Veículos Disponíveis</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-number">{{ $totalClientes ?? 0 }}</div>
                        <div class="stat-label">Total de Clientes</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-number">R$ 0</div>
                        <div class="stat-label">Vendas do Mês</div>
                    </div>
                </div>
            </div>

            <!-- Vehicles Table -->
            <div class="vehicles-section" id="vehicles">
                <h3 class="section-title">
                    <i class="fas fa-car me-3"></i>Todos os Veículos Cadastrados
                </h3>
                
                @if(isset($todosVeiculos) && $todosVeiculos->count() > 0)
                    <div style="overflow-x: auto;">
                        <table class="vehicles-table">
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th>Veículo</th>
                                    <th>Ano</th>
                                    <th>Cor</th>
                                    <th>Preço</th>
                                    <th>Status</th>
                                    <th>Cadastrado em</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($todosVeiculos as $veiculo)
                                    <tr>
                                        <td>
                                            @if($veiculo->imagem ?? false)
                                                <img src="{{ asset('storage/' . $veiculo->imagem) }}" 
                                                     alt="{{ $veiculo->marca }} {{ $veiculo->modelo }}" 
                                                     class="vehicle-image">
                                            @else
                                                <div class="vehicle-image d-flex align-items-center justify-content-center" 
                                                     style="background: rgba(0, 180, 216, 0.1);">
                                                    <i class="fas fa-car text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $veiculo->marca }} {{ $veiculo->modelo }}</strong>
                                            @if($veiculo->descricao)
                                                <br><small class="text-muted">{{ Str::limit($veiculo->descricao, 50) }}</small>
                                            @endif
                                        </td>
                                        <td>{{ $veiculo->ano_fabricacao ?? $veiculo->ano_modelo ?? 'N/A' }}</td>
                                        <td>{{ $veiculo->cor ?? 'N/A' }}</td>
                                        <td>
                                            <span class="price-tag">
                                                R$ {{ number_format($veiculo->preco_venda ?? 0, 2, ',', '.') }}
                                            </span>
                                        </td>
                                        <td>
                                            @php
                                                $status = strtolower(str_replace(' ', '-', $veiculo->status ?? 'disponível'));
                                                $statusClass = 'status-' . $status;
                                            @endphp
                                            <span class="status-badge {{ $statusClass }}">
                                                {{ $veiculo->status ?? 'Disponível' }}
                                            </span>
                                        </td>
                                        <td>{{ $veiculo->created_at ? $veiculo->created_at->format('d/m/Y') : 'N/A' }}</td>
                                        <td>
                                            <button class="btn-action" title="Visualizar">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn-action" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-action" title="Excluir" style="border-color: #dc3545; color: #dc3545;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-car-side"></i>
                        <h4>Nenhum veículo cadastrado</h4>
                        <p>Quando houver veículos cadastrados, eles aparecerão aqui.</p>
                    </div>
                @endif
            </div>
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

        // Smooth scroll para seção de veículos
        document.querySelector('a[href="#vehicles"]').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('vehicles').scrollIntoView({
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>