<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validar campos
        $request->validate([
            'correo_electronico' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('correo_electronico', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->rol === 'admin') {
                return redirect()->route('admin.panel');
            } else {
                return redirect()->route('usuario.panel');
            }
        }

        return back()->with('error', 'Credenciales incorrectas.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
