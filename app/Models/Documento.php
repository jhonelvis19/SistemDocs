<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';
    protected $primaryKey = 'id_documento';
    public $timestamps = false;

    protected $fillable = [
        'titulo', 'descripcion', 'fecha_creacion',
        'id_tipo_documento', 'id_tipo_proceso', 'id_usuario_creador', 'archivo'
    ];

    // Usuario creador del documento
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_creador', 'id_usuario');
    }

    // Tipo de documento
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'id_tipo_documento', 'id_tipo_documento');
    }

    // Tipo de proceso
    public function tipoProceso()
    {
        return $this->belongsTo(TipoProceso::class, 'id_tipo_proceso', 'id_tipo_proceso');
    }

    // Historial de ubicaciones
    public function ubicaciones()
    {
        return $this->hasMany(UbicacionDocumento::class, 'id_documento');
    }

    // Última ubicación registrada
    public function ubicacionActual()
    {
        return $this->hasOne(UbicacionDocumento::class, 'id_documento')->latestOfMany('fecha_registro');
    }

    // Último estado del documento
    public function estadoActual()
    {
        return $this->hasOne(HistorialEstado::class, 'id_documento')->latestOfMany('fecha_cambio');
    }
    public function historialEstado()
    {
        return $this->hasMany(HistorialEstado::class, 'id_documento');
    }

    public function ubicacion()
    {
        return $this->hasMany(UbicacionDocumento::class, 'id_documento');
    }

}
