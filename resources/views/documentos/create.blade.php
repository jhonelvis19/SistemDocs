<!DOCTYPE html>
<html>
<head>
    <title>Crear Documento</title>
</head>
<body>
    <h1>Crear Documento</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<form method="POST" action="{{ route('documentos.store') }}" enctype="multipart/form-data">
    @csrf
    <label>Título:</label><br>
    <input type="text" name="titulo" value="{{ old('titulo') }}"><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion">{{ old('descripcion') }}</textarea><br><br>

    <label>Usuario asignado:</label><br>
    <label for="dni_usuario">DNI del usuario asignado:</label>
    <input type="text" name="dni_usuario" required><br><br>

    <label>Archivo:</label><br>
    <input type="file" name="archivo" required><br><br>

    <button type="submit">Guardar Documento</button>
</form>

</html>
