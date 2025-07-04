<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialEstado extends Model
{
    protected $table = 'historial_estado';
    protected $primaryKey = 'id_historial';
    public $timestamps = false;

    protected $fillable = [
        'id_documento',
        'id_estado',
        'fecha_cambio',
        'observaciones',
    ];

    // Relación con Documento
    public function documento()
    {
        return $this->belongsTo(Documento::class, 'id_documento', 'id_documento');
    }

    // Relación con Estado del documento
    public function estado()
    {
        return $this->belongsTo(EstadoDocumento::class, 'id_estado', 'id_estado');
    }
}
