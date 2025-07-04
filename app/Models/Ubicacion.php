<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'ubicaciones'; // Asegúrate de que el nombre coincida con tu tabla
    protected $primaryKey = 'id_ubicacion'; // Tu clave primaria
    public $timestamps = false;

    // Relaciones si las necesitas
}
