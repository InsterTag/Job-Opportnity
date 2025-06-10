<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Unemployed;

class UserController extends Controller
{
    public function create() {
        return view('register');
    }

    public function agg_user(Request $request) {
        // Validación de los campos
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'type' => ['required', 'in:unemployed,company'],
        ]);

        // Crear y guardar el usuario
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Encriptar la contraseña
        $user->type = $request->type;
        $user->email_verified_at = now();
        $user->save();

        // Iniciar sesión automáticamente
        Auth::login($user);

        // Redirigir según el tipo de usuario
        if ($user->type == 'unemployed') {
            return redirect()->route('unemployed-form'); // Ruta al formulario de desempleado
        } else {
            return redirect()->route('company-form'); // Ruta al formulario de empresa
        }
    }

    public function login(Request $request) {
    $credentials = [
        "email" => $request->email,
        "password" => $request->password
    ];

    $remember = $request->remember ? true : false;
    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();
        return redirect()->intended(route('home'));
    } else {
        // Redirigir con mensaje de error
        return redirect()->back()->withErrors([
            'email' => 'Correo electrónico o contraseña incorrectos.',
        ])->withInput($request->only('email'));
    }
}

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }
}
