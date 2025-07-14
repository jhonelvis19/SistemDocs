@extends('layouts.menu_user')

@section('titulo', 'Mis Documentos')

@section('contenido')
    <h2 class="mb-4">Mis Documentos Asignados</h2>

    @if($documentos->isEmpty())
        <div class="alert alert-info">
            No tienes documentos asignados.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Título</th>
                        <th>Estado</th>
                        <th>Ubicación Actual</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documentos as $doc)
                        <tr>
                            <td>{{ $doc->titulo }}</td>
                            <td>{{ $doc->estadoActual->estado->nombre_estado ?? 'Sin estado' }}</td>
                            <td>{{ $doc->ubicacionActual->ubicacion->nombre_ubicacion ?? 'No asignado' }}</td>
                            <td>
                                {{ $doc->estadoActual->observaciones ?? 'Sin observaciones' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <a href="{{ route('usuario.panel') }}" class="btn btn-secondary mt-3">Volver al Panel</a>
@endsection
