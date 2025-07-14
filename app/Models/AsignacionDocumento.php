<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignacionDocumento extends Model
{
    protected $table = 'asignaciones_documentos';
    protected $primaryKey = 'id_asignacion';
    public $timestamps = false;

    protected $fillable = [
        'id_documento',
        'id_usuario',
        'fecha_asignacion'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function documento()
    {
        return $this->belongsTo(Documento::class, 'id_documento');
    }
}
