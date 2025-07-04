<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'tipos_documento';
    protected $primaryKey = 'id_tipo_documento';
    public $timestamps = false;

    protected $fillable = ['nombre_documento', 'descripcion'];
}
