<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);
    $allowedUsers = [
        'raihan' => '12345',
    ];
    if (isset($allowedUsers[$request->username]) &&
        $allowedUsers[$request->username] === $request->password) {

        session(['logged_in' => true, 'username' => $request->username]);

        return redirect()->route('dashboard');
    }
    return back()->with('error', 'Username atau password salah!');
}


    public function logout(Request $request)
    {
        session()->forget(['logged_in', 'username']); 
        session()->flush();

        return redirect()->route('login')->with('success', 'Berhasil logout!');
    }
}
