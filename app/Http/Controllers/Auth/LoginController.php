<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return redirect()->intended('dashboard');
            } elseif (Auth::user()->role == 'resepsionis') {
                return redirect()->intended('dashboard-resepsionis');
            }
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->intended('dashboard')->with('success', 'Login berhasil sebagai Admin. Selamat datang kembali!');
            } elseif (Auth::user()->role == 'resepsionis') {
                return redirect()->intended('dashboard-resepsionis')->with('success', 'Login berhasil sebagai Resepsionis. Selamat datang kembali!');
            }
        }

        return redirect()->back()->withErrors([
            'username' => 'Username atau kata sandi yang Anda masukkan tidak cocok.',
        ])->withInput()->with('error', 'Login gagal. Silakan cek kembali username dan kata sandi Anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
