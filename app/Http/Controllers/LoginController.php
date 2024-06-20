<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('dashboard')->with('success', 'Login berhasil sebagai Admin. Selamat datang kembali!');
        }

        if (Auth::guard('resepsionis')->attempt($credentials)) {
            return redirect()->intended('resepsionis-dashboard')->with('success', 'Login berhasil sebagai Resepsionis. Selamat datang kembali!');
        }

        return redirect()->back()->withErrors([
            'username' => 'Username atau kata sandi yang Anda masukkan tidak cocok.',
        ])->withInput()->with('error', 'Login gagal. Silakan cek kembali username dan kata sandi Anda.');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        if (Auth::guard('resepsionis')->check()) {
            Auth::guard('resepsionis')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
