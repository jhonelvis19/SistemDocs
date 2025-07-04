<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoDocumento extends Model
{
    protected $table = 'estados_documento';
    protected $primaryKey = 'id_estado';
    public $timestamps = false;

    protected $fillable = [
        'nombre_estado',
    ];

    public function historial()
    {
        return $this->hasMany(HistorialEstado::class, 'id_estado');
    }
}
