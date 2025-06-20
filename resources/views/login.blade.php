<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"> {{-- Enlace clásico al CSS --}}
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>

        @if(session('error'))
            <p class="error-message">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="correo">Correo:</label>
            <input type="email" name="correo_electronico" required><br>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" required><br>

            <button type="submit">Ingresar</button>
        </form>

        <a href="{{ route('registro.formulario') }}">¿No tienes cuenta? Regístrate aquí</a>
    </div>

</body>
</html>
