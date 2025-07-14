<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';
    protected $primaryKey = 'id_documento';
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_creacion',
        'id_tipo_documento',
        'id_tipo_proceso',
        'id_usuario_creador',
        'archivo',
    ];

    // Relaciones principales
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_creador', 'id_usuario');
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'id_tipo_documento', 'id_tipo_documento');
    }

    public function tipoProceso()
    {
        return $this->belongsTo(TipoProceso::class, 'id_tipo_proceso', 'id_tipo_proceso');
    }

    // Relación con asignación de documentos
    public function asignaciones()
    {
        return $this->hasMany(AsignacionDocumento::class, 'id_documento', 'id_documento');
    }

    public function usuarioAsignado()
    {
        return $this->hasOneThrough(
            Usuario::class,
            AsignacionDocumento::class,
            'id_documento',
            'id_usuario',
            'id_documento',
            'id_usuario'
        );
    }

    // Ubicación actual
    public function ubicaciones()
    {
        return $this->hasMany(UbicacionDocumento::class, 'id_documento');
    }

    public function ubicacionActual()
    {
        return $this->hasOne(UbicacionDocumento::class, 'id_documento')->latestOfMany('fecha_registro');
    }

    // Estado actual
    public function historialEstado()
    {
        return $this->hasMany(HistorialEstado::class, 'id_documento');
    }

    public function estadoActual()
    {
        return $this->hasOne(HistorialEstado::class, 'id_documento')->latestOfMany('fecha_cambio');
    }
}
