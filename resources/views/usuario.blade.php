@extends('layouts.menu_user')
@section('contenido')
<!DOCTYPE html>
<html>
<head>
    <title>Panel Usuario</title>
</head>
<body>
    <h1>Bienvenido, Usuario</h1>
    <p>Este es tu panel de usuario.</p>
    <a href="{{ route('documentos.usuario') }}" class="btn btn-primary">
    📄 Ver Mis Documentos
</body>
</html>
@endsection