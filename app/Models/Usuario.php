<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido',
        'correo_electronico',
        'rol',
        'dni',
        'password'
    ];

    protected $hidden = [
        'password',
    ];

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'id_usuario_creador');
    }
}
