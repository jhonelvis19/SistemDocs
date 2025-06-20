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
        <div class="mb-3">
            <label class="form-label">Título:</label>
            <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción:</label>
            <textarea name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">DNI del usuario asignado:</label>
            <input type="text" name="dni_usuario" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Archivo:</label>
            <input type="file" name="archivo" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Documento</button>
    </form>
@endsection
