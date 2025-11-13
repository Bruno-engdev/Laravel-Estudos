<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

Route::get(
    '/categoria', 
    [CategoriaController::class, 'index'] 
)->name("categoria");

Route::get('/', [ClienteController::class, 'index']);
Route::put('/clientes/{id}', [ClienteController::class, 'alterarCliente']);
Route::delete('/clientes/{id}', [ClienteController::class, 'deletarCliente']);
Route::post('/clientes', [ClienteController::class, 'salvarCliente']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';