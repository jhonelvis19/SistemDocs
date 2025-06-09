<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'Documentos';
    protected $primaryKey = 'id_documento';
    public $timestamps = false;

    protected $fillable = [
        'titulo', 'descripcion', 'fecha_creacion',
        'id_tipo_documento', 'id_tipo_proceso', 'id_usuario_creador', 'archivo'
    ];

    // Relación con Usuario (creador o asignado)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_creador', 'id_usuario');
    }

    // Relación con TipoDocumento
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'id_tipo_documento', 'id_tipo_documento');
    }

    // Relación con TipoProceso
    public function tipoProceso()
    {
        return $this->belongsTo(TipoProceso::class, 'id_tipo_proceso', 'id_tipo_proceso');
    }
}
