@extends('layouts.menu_adm')

@section('titulo', 'Crear Documento')

@section('contenido')
    <h1>Crear Documento</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('documentos.store') }}" enctype="multipart/form-data">
        @csrf

        <label for="titulo">Título:</label><br>
        <input type="text" name="titulo" value="{{ old('titulo') }}"><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea name="descripcion">{{ old('descripcion') }}</textarea><br><br>

        <label for="dni_usuario">DNI del Usuario asignado:</label><br>
        <input type="text" name="dni_usuario" required><br><br>

        <label for="id_tipo_documento">Tipo de Documento:</label><br>
        <select name="id_tipo_documento" required>
            <option value="">Seleccione un tipo</option>
            @foreach($tiposDocumento as $tipo)
                <option value="{{ $tipo->id_tipo_documento }}" {{ old('id_tipo_documento') == $tipo->id_tipo_documento ? 'selected' : '' }}>
                    {{ $tipo->nombre_documento }}
                </option>
            @endforeach
        </select><br><br>

        <label for="id_tipo_proceso">Tipo de Proceso:</label><br>
        <select name="id_tipo_proceso" required>
            <option value="">Seleccione un proceso</option>
            @foreach($tiposProceso as $proceso)
                <option value="{{ $proceso->id_tipo_proceso }}" {{ old('id_tipo_proceso') == $proceso->id_tipo_proceso ? 'selected' : '' }}>
                    {{ $proceso->nombre_proceso }}
                </option>
            @endforeach
        </select><br><br>

        <label for="archivo">Archivo:</label><br>
        <input type="file" name="archivo" required><br><br>

        <button type="submit">Guardar Documento</button>
    </form>
@endsection
