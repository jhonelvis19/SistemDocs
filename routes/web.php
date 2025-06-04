<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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
