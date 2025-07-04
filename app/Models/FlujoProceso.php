<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlujoProceso extends Model
{
    protected $table = 'flujos_proceso'; // nombre real de la tabla
    protected $primaryKey = 'id_flujo_proceso'; // si usas una clave primaria personalizada

    public $timestamps = false;

    protected $fillable = [
        'id_tipo_proceso',
        'id_ubicacion',
        'orden',
    ];

    // Relaciones (opcional)
    public function proceso()
    {
        return $this->belongsTo(TipoProceso::class, 'id_tipo_proceso');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
    }
}
