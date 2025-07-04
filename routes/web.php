<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentoController;

// Redirigir la raíz '/' al login
Route::redirect('/', '/login');

// Mostrar formulario de login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Procesar login
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas por middleware y roles
Route::middleware(['auth', 'rol:admin'])->get('/admin', function () {
    return view('admin');
})->name('admin.panel');

Route::middleware(['auth', 'rol:usuario'])->get('/usuario', function () {
    return view('usuario');
})->name('usuario.panel');


Route::get('/registrar', [UsuarioController::class, 'showFormulario'])->name('registro.formulario');
Route::post('/registrar', [UsuarioController::class, 'registrar'])->name('registro.guardar');


Route::middleware(['auth', 'rol:admin'])->group(function () {
    Route::get('/documentos/crear', [DocumentoController::class, 'create'])->name('documentos.create');
    Route::post('/documentos', [DocumentoController::class, 'store'])->name('documentos.store');
    Route::get('/documentos', [DocumentoController::class, 'index'])->name('documentos.index'); // opcional
});

Route::post('/documentos/{id}/avanzar', [DocumentoController::class, 'avanzar'])->name('documentos.avanzar');

Route::post('/documentos/{id}/rechazar', [DocumentoController::class, 'rechazar'])->name('documentos.rechazar');

Route::get('/documentos/{id}/editar', [DocumentoController::class, 'edit'])->name('documentos.edit');
Route::put('/documentos/{id}', [DocumentoController::class, 'update'])->name('documentos.update');
Route::delete('/documentos/{id}', [DocumentoController::class, 'destroy'])->name('documentos.destroy');

