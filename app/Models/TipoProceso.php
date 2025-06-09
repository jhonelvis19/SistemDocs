<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProceso extends Model
{
    protected $table = 'Tipos_Proceso';
    protected $primaryKey = 'id_tipo_proceso';
    public $timestamps = false;

    protected $fillable = ['nombre_proceso', 'descripcion'];
}
