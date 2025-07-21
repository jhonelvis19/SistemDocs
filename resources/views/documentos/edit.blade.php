@extends('layouts.menu_adm')

@section('titulo', 'Editar Documento')
<link rel="stylesheet" href="{{ asset('css/editar-documento.css') }}">
@section('contenido')
<h1>Editar Documento</h1>

<form method="POST" action="{{ route('documentos.update', $documento->id_documento) }}">
    @csrf
    @method('PUT')

    <label>Título:</label><br>
    <input type="text" name="titulo" value="{{ old('titulo', $documento->titulo) }}"><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion">{{ old('descripcion', $documento->descripcion) }}</textarea><br><br>

    <label>Tipo de Documento:</label><br>
    <select name="id_tipo_documento">
        @foreach($tiposDocumento as $tipo)
            <option value="{{ $tipo->id_tipo_documento }}" {{ $documento->id_tipo_documento == $tipo->id_tipo_documento ? 'selected' : '' }}>
                {{ $tipo->nombre_documento }}
            </option>
        @endforeach
    </select><br><br>

    <label>Tipo de Proceso:</label><br>
    <select name="id_tipo_proceso">
        @foreach($tiposProceso as $proceso)
            <option value="{{ $proceso->id_tipo_proceso }}" {{ $documento->id_tipo_proceso == $proceso->id_tipo_proceso ? 'selected' : '' }}>
                {{ $proceso->nombre_proceso }}
            </option>
        @endforeach
    </select><br><br>

    <button type="submit" class="btn btn-success">Actualizar</button>
</form>
@endsection
