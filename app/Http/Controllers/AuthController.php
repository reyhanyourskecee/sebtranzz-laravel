<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // logika login nanti bisa ditambahkan
        return redirect()->route('dashboard');
    }

    // ==== INI MASUK KE DALAM CLASS ====
    public function logout(Request $request)
    {
        auth()->logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout!');
    }
}
