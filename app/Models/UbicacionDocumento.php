<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UbicacionDocumento extends Model
{
    protected $table = 'ubicacion_documento'; // Nombre exacto de tu tabla
    protected $primaryKey = 'id_ubicacion_doc'; // Llave primaria según tu estructura
    public $timestamps = false;

    protected $fillable = [
        'id_documento',
        'id_ubicacion',
        'fecha_registro',
    ];

    // Relaciones (opcional)
    public function documento()
    {
        return $this->belongsTo(Documento::class, 'id_documento');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
    }
    public function estado()
    {
        return $this->belongsTo(EstadoDocumento::class, 'id_estado');
    }
    public function ubicaciones()
{
    return $this->hasMany(UbicacionDocumento::class, 'id_documento');
}

}
