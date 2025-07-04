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
                    <td>{{ $doc->usuario->nombre ?? 'N/A' }} {{ $doc->usuario->apellido ?? '' }}</td>
                    <td>{{ $doc->tipoProceso->nombre_proceso ?? 'N/A' }}</td>
                    <td>{{ $doc->ubicacionActual->ubicacion->nombre_ubicacion ?? 'No asignado' }}</td>
                    <td>{{ $doc->fecha_creacion }}</td>
                    <td>{{ $doc->estadoActual->estado->nombre_estado ?? 'Sin estado' }}</td>
                    <td class="text-center">
                        {{-- Botón Avanzar --}}
                        <form action="{{ route('documentos.avanzar', $doc->id_documento) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-success me-1" data-bs-toggle="tooltip" title="Avanzar">
                                <i class="fas fa-forward"></i>
                            </button>
                        </form>

                        {{-- Botón Rechazar --}}
                        <form action="{{ route('documentos.rechazar', $doc->id_documento) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Está seguro de rechazar este documento?');">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Rechazar">
                                <i class="fas fa-times-circle"></i>
                            </button>
                        </form>
                        {{-- Editar --}}
                        <a href="{{ route('documentos.edit', $doc->id_documento) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Editar">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        {{-- Botón Eliminar --}}
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
        </tbody>
    </table>

    <a href="{{ route('admin.panel') }}" class="btn btn-secondary mt-3">Volver al Panel</a>
@endsection
