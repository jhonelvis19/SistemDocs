<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>

    <!-- Íconos Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
</head>
<body>

    <h1>Registrar nuevo usuario</h1>

    @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('registro.guardar') }}" method="POST">
        @csrf

        <div class="box">
            <input type="text" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}" required>
            <i class="fa fa-user"></i>
        </div>

        <div class="box">
            <input type="text" name="apellido" placeholder="Apellido" value="{{ old('apellido') }}" required>
            <i class="fa fa-user"></i>
        </div>

        <div class="box">
            <input type="email" name="correo_electronico" placeholder="Correo Electrónico" value="{{ old('correo_electronico') }}" required>
            <i class="fa fa-envelope"></i>
        </div>

        <div class="box">
            <input type="text" name="dni" placeholder="DNI" value="{{ old('dni') }}" required>
            <i class="fa fa-id-card"></i>
        </div>

        <div class="box">
            <input type="password" name="password" placeholder="Contraseña" required>
            <i class="fa fa-lock"></i>
        </div>

        <div class="box">
            <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña" required>
            <i class="fa fa-lock"></i>
        </div>

        <button type="submit">Registrar</button>
    </form>

    <a href="{{ route('login') }}">Regresar al login</a>

</body>
</html>
