<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Cliente\ClienteFrontController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CorController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
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

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    });
});

// Aliases mínimos exigidos pelo Laravel/middleware (ex.: redirecionamento padrão).
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

/*
|--------------------------------------------------------------------------
| Rotas de Administração
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Login do admin (sem middleware admin, para permitir autenticar)
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login']);

    // Tudo abaixo exige autenticação + papel admin
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        // Clientes
        Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
        Route::post('/clientes', [ClienteController::class, 'salvarCliente'])->name('clientes.store');
        Route::put('/clientes/{id}', [ClienteController::class, 'alterarCliente'])->name('clientes.update');
        Route::delete('/clientes/{id}', [ClienteController::class, 'deletarCliente'])->name('clientes.destroy');

        // CRUDs principais
        Route::resource('veiculos', VeiculoController::class);
        Route::resource('marcas', MarcaController::class);
        Route::resource('modelos', ModeloController::class);
        Route::resource('cores', CorController::class);

        // Perfil do admin
        Route::get('/profile', [AdminController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
        Route::put('/profile/password', [AdminController::class, 'updatePassword'])->name('profile.password.update');
    });
});
