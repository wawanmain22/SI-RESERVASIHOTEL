<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;



class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->intended('dashboard');
        }

        if (Auth::guard('resepsionis')->check()) {
            return redirect()->intended('resepsionis-dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }

        Admin::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Registrasi berhasil! Silakan masuk menggunakan akun Anda.');
    }
}
