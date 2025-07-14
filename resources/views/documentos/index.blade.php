@extends('layouts.menu_adm')

@section('titulo', 'Lista de Documentos')

@section('contenido')
    <h1>Lista de Documentos</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Script para tooltips --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-primary text-center">
            <tr>
                <th>Título</th>
                <th>Tipo de Documento</th>
                <th>Usuario Asignado</th>
                <th>Proceso</th>
                <th>Ubicación Actual</th>
                <th>Fecha de Creación</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documentos as $doc)
                <tr>
                    <td>{{ $doc->titulo }}</td>
                    <td>{{ $doc->tipoDocumento->nombre_documento ?? 'N/A' }}</td>
                    <td>{{ $doc->usuarioAsignado->nombre_completo ?? 'No asignado' }}</td> 
                    <td>{{ $doc->tipoProceso->nombre_proceso ?? 'N/A' }}</td>
                    <td>{{ $doc->ubicacionActual->ubicacion->nombre_ubicacion ?? 'No asignado' }}</td>
                    <td>{{ $doc->fecha_creacion }}</td>
                    <td>{{ $doc->estadoActual->estado->nombre_estado ?? 'Sin estado' }}</td>
                    <td class="text-center">
                    @if($doc->estadoActual && $doc->estadoActual->estado->nombre_estado !== 'Rechazado')
                        {{-- Botón Avanzar --}}
                        <form action="{{ route('documentos.avanzar', $doc->id_documento) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-success me-1" data-bs-toggle="tooltip" title="Avanzar">
                                <i class="fas fa-forward"></i>
                            </button>
                        </form>

                        {{-- Botón Editar --}}
                        <a href="{{ route('documentos.edit', $doc->id_documento) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Editar">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    @endif

                    {{-- Botón Rechazar --}}
                    @if($doc->estadoActual && $doc->estadoActual->estado->nombre_estado !== 'Rechazado')
                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalRechazo{{ $doc->id_documento }}" title="Rechazar">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    @endif

                    

                    {{-- Botón Eliminar (siempre visible) --}}
                    <form action="{{ route('documentos.destroy', $doc->id_documento) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar este documento?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="Eliminar">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </form>
                </td>

                </tr>
            @endforeach
            @foreach ($documentos as $doc)
            <!-- Modal de Rechazo -->
            <div class="modal fade" id="modalRechazo{{ $doc->id_documento }}" tabindex="-1" aria-labelledby="modalLabel{{ $doc->id_documento }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('documentos.rechazar', $doc->id_documento) }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="modalLabel{{ $doc->id_documento }}">Motivo de Rechazo</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="observaciones">Ingrese el motivo del rechazo:</label>
                                    <textarea name="observaciones" class="form-control" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger">Rechazar Documento</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach

        </tbody>
    </table>

    <a href="{{ route('admin.panel') }}" class="btn btn-secondary mt-3">Volver al Panel</a>
@endsection
