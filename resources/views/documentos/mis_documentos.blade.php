
    <h1>Mis Documentos</h1>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Tipo</th>
                <th>Proceso</th>
                <th>Ubicación Actual</th>
                <th>Estado</th>
                <th>Creado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documentos as $doc)
                <tr>
                    <td>{{ $doc->titulo }}</td>
                    <td>{{ $doc->tipoDocumento->nombre_documento ?? 'N/A' }}</td>
                    <td>{{ $doc->tipoProceso->nombre_proceso ?? 'N/A' }}</td>
                    <td>{{ $doc->ubicacionActual->ubicacion->nombre_ubicacion ?? 'No asignado' }}</td>
                    <td>{{ $doc->estadoActual->estado->nombre_estado ?? 'Sin estado' }}</td>
                    <td>{{ $doc->fecha_creacion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
