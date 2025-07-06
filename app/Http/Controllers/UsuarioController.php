<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Mostrar formulario
    public function showFormulario()
    {
        return view('registro');
    }

    // Procesar registro
    public function registrar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo_electronico' => 'required|string|email|max:255|unique:usuarios,correo_electronico',
            'dni' => 'required|string|max:20',
            'password' => 'required|string|confirmed|min:6',
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo_electronico' => $request->correo_electronico,
            'dni' => $request->dni,
            'rol' => 'admin',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login');
    }
}
