<!DOCTYPE html>
<html>
<head>
    <title>Panel Admin</title>
</head>
<body>
    <h1>Bienvenido, Admin</h1>
    <p>Este es tu panel de administrador.</p>
    <a href="{{ route('documentos.create') }}" class="btn btn-primary mb-3">Crear nuevo documento</a>
    <a href="{{ route('logout') }}">Cerrar sesión</a>
    <a href="{{ route('documentos.index') }}">Ver Documentos</a>

</body>
</html>
