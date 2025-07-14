<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Fuente Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome v4.7 para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Tu archivo de estilos -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    <div class="form-area">
        <div class="wrapper">
            <h2 style="color: white;">Login</h2>

            @if(session('error'))
                <p class="error-message">{{ session('error') }}</p>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <label for="correo" style="color: white;">Correo:</label>    
                <div class="box">
                    <input type="email" id="correo" name="correo_electronico" placeholder="Ingrese su correo electrónico" required>
                    <i class="fa fa-user"></i>
                </div>

                <label for="Contraseña" style="color: white;">Contraseña:</label>
                <div class="box">
                    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>
                    <i class="fa fa-lock"></i>
                </div>



                <button type="submit">Ingresar</button>
            </form>

            <p>¿No tienes cuenta? <a href="{{ route('registro.formulario') }}">Regístrate aquí</a></p>
        </div>
    </div>

</body>
</html>
