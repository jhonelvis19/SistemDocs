@extends('layouts.menu_adm')

@section('titulo', 'Crear Documento')

@section('contenido')
    <!-- Vínculos de fuentes y estilos -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/crear_documento.css') }}">

    <div class="form-container">

        @if ($errors->any())
            <div class="alert">
                <h5>Errores encontrados:</h5>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('documentos.store') }}" enctype="multipart/form-data">
            @csrf

            <label for="titulo">Título:</label>
            <input type="text" name="titulo" value="{{ old('titulo') }}" required>


            <label for="dni_usuario">DNI del Usuario asignado:</label>
            <input type="text" name="dni_usuario" required>

            <label for="id_tipo_documento">Tipo de Documento:</label>
            <select name="id_tipo_documento" required>
                <option value="">Seleccione un tipo</option>
                @foreach($tiposDocumento as $tipo)
                    <option value="{{ $tipo->id_tipo_documento }}" {{ old('id_tipo_documento') == $tipo->id_tipo_documento ? 'selected' : '' }}>
                        {{ $tipo->nombre_documento }}
                    </option>
                @endforeach
            </select>

            <label for="id_tipo_proceso">Tipo de Proceso:</label>
            <select name="id_tipo_proceso" required>
                <option value="">Seleccione un proceso</option>
                @foreach($tiposProceso as $proceso)
                    <option value="{{ $proceso->id_tipo_proceso }}" {{ old('id_tipo_proceso') == $proceso->id_tipo_proceso ? 'selected' : '' }}>
                        {{ $proceso->nombre_proceso }}
                    </option>
                @endforeach
            </select>

            <label for="archivo">Archivo:</label>
            <input type="file" name="archivo" required>

            <button type="submit">Guardar Documento</button>
        </form>
    </div>
@endsection
