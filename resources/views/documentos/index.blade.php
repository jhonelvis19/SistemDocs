@extends('layouts.menu_adm')

@section('titulo', 'Lista de Documentos')

@section('contenido')
    <h1>Lista de Documentos</h1>

    <table class="table table-bordered">
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

    <a href="{{ route('admin.panel') }}" class="btn btn-secondary mt-3">Volver al Panel</a>
@endsection
