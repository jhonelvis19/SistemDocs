<!DOCTYPE html>
<html>
<head>
    <title>Lista de Documentos</title>
</head>
<body>
    <h1>Lista de Documentos</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Título</th>
                <th>Tipo de Documento</th>
                <th>Usuario Asignado</th>
                <th>Proceso</th>
                <th>Fecha de Creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documentos as $doc)
                <tr>
                    <td>{{ $doc->titulo }}</td>
                    <td>{{ $doc->tipoDocumento->nombre_documento ?? 'N/A' }}</td>
                    <td>{{ $doc->usuario->nombre ?? 'N/A' }} {{ $doc->usuario->apellido ?? '' }}</td>
                    <td>{{ $doc->tipoProceso->nombre_proceso ?? 'N/A' }}</td>
                    <td>{{ $doc->fecha_creacion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <a href="{{ route('admin.panel') }}">Volver al Panel</a>
</body>
</html>
