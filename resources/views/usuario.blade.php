@extends('layouts.menu_user')
@section('contenido')
<link rel="stylesheet" href="{{ asset('css/panel-user.css') }}">

<div class="admin-container">
<h1>Bienvenido: {{ Auth::user()->nombre_completo }}</h1>
    <p class="lead">Aquí puedes gestionar y revisar tus documentos.</p>

    <div class="cards-container">
        <div class="info-card">
            <i class="fas fa-file-alt"></i>
            <p>📄 Ver Mis Documentos <br> Consulta y da seguimiento a los documentos que has registrado o recibido.</p>
        </div>
        <div class="info-card">
            <i class="fas fa-history"></i>
            <p>🕒 Historial de Estados <br> Visualiza los cambios y movimientos de tus documentos.</p>
        </div>
        <div class="info-card">
            <i class="fas fa-map-marker-alt"></i>
            <p>📍 Ubicación Actual <br> Consulta en qué dependencia u oficina se encuentra tu documento.</p>
        </div>
        <div class="info-card">
            <i class="fas fa-user-shield"></i>
            <p>🔒 Seguridad <br> Tus documentos están protegidos mediante control de acceso.</p>
        </div>
    </div>

    <a href="{{ route('documentos.usuario') }}" class="btn btn-primary">
        📄 Ver Mis Documentos
    </a>

    <div class="footer-phrase">
        Gracias por utilizar el sistema de validación de documentos municipales.
    </div>
</div>
@endsection
