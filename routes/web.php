<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Cliente\ClienteFrontController;
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
    Route::get('/login', function () {
        return view('cliente.auth.login');
    })->name('login');
    
    Route::get('/register', function () {
        return view('cliente.auth.register');
    })->name('register');
    
    Route::middleware('auth:cliente')->group(function () {
        Route::get('/dashboard', function () {
            return view('cliente.dashboard');
        })->name('dashboard');
        
        Route::post('/logout', function () {
            auth()->guard('cliente')->logout();
            return redirect()->route('cliente.home');
        })->name('logout');
    });
});

/*
|--------------------------------------------------------------------------
| Rotas do Admin (Backend)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/categoria', [CategoriaController::class, 'index'])->name('categoria');
    
    // Rotas CRUD de Clientes (Admin)
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::post('/clientes', [ClienteController::class, 'salvarCliente'])->name('clientes.store');
    Route::put('/clientes/{id}', [ClienteController::class, 'alterarCliente'])->name('clientes.update');
    Route::delete('/clientes/{id}', [ClienteController::class, 'deletarCliente'])->name('clientes.destroy');
});