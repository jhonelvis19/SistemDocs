<?php


use App\Models\HistorialEstado;
use App\Models\Ubicacion;
use App\Models\EstadoDocumento;

...

// Obtener la nueva ubicación
$nuevaUbicacion = Ubicacion::find($siguienteFlujo->id_ubicacion_destino);

if ($nuevaUbicacion) {
    $nuevoEstado = null;

    switch ($nuevaUbicacion->nombre_ubicacion) {
        case 'Mesa de Partes':
            $nuevoEstado = 'Recibido';
            break;
        case 'Oficina de Secretaría General':
        case 'Gerencia de Obras':
        case 'Gerencia de Desarrollo Urbano':
            $nuevoEstado = 'En Revisión';
            break;
        case 'Alcaldía':
            $nuevoEstado = 'Finalizado';
            break;
        default:
            $nuevoEstado = 'Derivado a otra dependencia';
            break;
    }

    // Obtener ID del estado
    $estado = EstadoDocumento::where('nombre_estado', $nuevoEstado)->first();
    if ($estado) {
        HistorialEstado::create([
            'id_documento' => $documento->id_documento,
            'id_estado' => $estado->id_estado,
            'fecha_cambio' => now(),
            'observaciones' => 'Cambio automático por avance de ubicación.',
        ]);
    }
}
