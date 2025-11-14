<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Cliente\ClienteFrontController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VeiculoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas do Front-End do Cliente (Loja)
|--------------------------------------------------------------------------
*/
Route::get('/', [ClienteFrontController::class, 'home'])->name('cliente.home');
Route::get('/modelos', [ClienteFrontController::class, 'modelos'])->name('cliente.modelos');
Route::get('/veiculo/{id}', [ClienteFrontController::class, 'show'])->name('cliente.veiculo.show');
Route::post('/newsletter/subscribe', [ClienteFrontController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');

/*
|--------------------------------------------------------------------------
| Rotas de Autenticação do Cliente
|--------------------------------------------------------------------------
*/
Route::prefix('cliente')->name('cliente.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Rotas protegidas por autenticação
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    });
});

/*
|--------------------------------------------------------------------------
| Rotas de Autenticação Geral (Mantidas para compatibilidade)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Rotas de Administração
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Rotas de autenticação do admin
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    
    // Rotas protegidas do admin
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    });
    
    // Rotas CRUD existentes do admin
    Route::get('/categoria', [CategoriaController::class, 'index'])->name('categoria');
    
    // Rotas CRUD de Clientes (Admin)
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::post('/clientes', [ClienteController::class, 'salvarCliente'])->name('clientes.store');
    Route::put('/clientes/{id}', [ClienteController::class, 'alterarCliente'])->name('clientes.update');
    Route::delete('/clientes/{id}', [ClienteController::class, 'deletarCliente'])->name('clientes.destroy');
});

/*
|--------------------------------------------------------------------------
| Rotas de Veículos
|--------------------------------------------------------------------------
*/
Route::prefix('veiculos')->name('veiculos.')->group(function () {
    Route::get('/', [VeiculoController::class, 'index'])->name('index');
    Route::get('/create', [VeiculoController::class, 'create'])->name('create');
    Route::post('/', [VeiculoController::class, 'store'])->name('store');
    Route::get('/{id}', [VeiculoController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [VeiculoController::class, 'edit'])->name('edit');
    Route::put('/{id}', [VeiculoController::class, 'update'])->name('update');
    Route::delete('/{id}', [VeiculoController::class, 'destroy'])->name('destroy');
    
    // Rotas adicionais
    Route::get('/filtrar/status', [VeiculoController::class, 'filtrarPorStatus'])->name('filtrar.status');
    Route::get('/buscar/termo', [VeiculoController::class, 'buscar'])->name('buscar');
    Route::patch('/{id}/status', [VeiculoController::class, 'alterarStatus'])->name('alterar.status');
});