<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
</head>
<body>
    <h1>Registrar nuevo usuario</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('registro.guardar') }}" method="POST">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}" required><br>
        <input type="text" name="apellido" placeholder="Apellido" value="{{ old('apellido') }}" required><br>
        <input type="email" name="correo_electronico" placeholder="Correo Electrónico" value="{{ old('correo_electronico') }}" required><br>
        <input type="text" name="dni" placeholder="DNI" value="{{ old('dni') }}" required><br>
        <input type="password" name="password" placeholder="Contraseña" required><br>
        <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña" required><br>
        <button type="submit">Registrar</button>
    </form>

    <br>
    <a href="{{ route('login') }}">Regresar al login</a>
</body>
</html>
