<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('correo_electronico', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirigir según rol
            $rol = Auth::user()->rol;

            if ($rol === 'admin') {
                return redirect()->route('admin.panel');
            } elseif ($rol === 'usuario') {
                return redirect()->route('usuario.panel');
            }
        }

        return back()->with('error', 'Credenciales inválidas.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
