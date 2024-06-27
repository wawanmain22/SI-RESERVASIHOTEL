<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {

        if (Auth::guard('admin')->check()) {
            return redirect()->intended('dashboard');
        }

        if (Auth::guard('resepsionis')->check()) {
            return redirect()->intended('resepsionis-dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            return redirect()->intended('dashboard')->with('success', 'Login berhasil sebagai Admin. Selamat datang kembali!');
        }

        if (Auth::guard('resepsionis')->attempt($credentials, $request->remember)) {
            return redirect()->intended('dashboard-resepsionis')->with('success', 'Login berhasil sebagai Resepsionis. Selamat datang kembali!');
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
