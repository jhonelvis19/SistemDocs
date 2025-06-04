<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
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

</body>
</html>
