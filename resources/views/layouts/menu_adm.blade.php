<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('titulo', 'Panel')</title>

    {{-- CDN de Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">



    {{-- CSS adicional personalizado si lo necesitas --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    {{-- 🧭 Menú de navegación (navbar) --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SistemaDocs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
                aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('documentos.create') }}">Crear Documento</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('documentos.index') }}">Ver Documentos</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Contenido dinámico --}}
    <div class="container mt-4">
        @yield('contenido')
    </div>

    {{-- Bootstrap JS (opcional, para dropdowns y collapses) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
