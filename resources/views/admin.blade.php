@extends('layouts.menu_adm')

@section('titulo', 'Panel de Administración')

@section('contenido')
    <!-- Fuentes e íconos -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Estilos externos -->
    <link rel="stylesheet" href="{{ asset('css/panel-admin.css') }}">

    <div class="admin-container">
        <h1>Bienvenido, Admin</h1>
        <p class="lead">Este es tu panel de administración para la validación de expedientes.</p>

        <div class="cards-container">
            <div class="info-card">
                <i class="fas fa-folder-open"></i>
                <p>Gestiona y valida expedientes con transparencia y control total.</p>
            </div>
            <div class="info-card">
                <i class="fas fa-check-circle"></i>
                <p>Supervisa cada etapa del proceso y garantiza decisiones informadas.</p>
            </div>
            <div class="info-card">
                <i class="fas fa-shield-alt"></i>
                <p>Tu rol es clave para asegurar la integridad del sistema administrativo.</p>
            </div>
        </div>

        <div class="footer-phrase">
            “Validar un expediente es proteger la integridad del proceso administrativo.”
        </div>
    </div>
@endsection
