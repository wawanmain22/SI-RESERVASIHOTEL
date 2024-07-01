<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Resepsionis;

class ResepsionisProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $resepsionis = $user->resepsionis;

        return view('resepsionis.profile', compact('user', 'resepsionis'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $resepsionis = $user->resepsionis;

        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:15'],
            'alamat' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $resepsionis->nama = $request->nama;
        $resepsionis->no_hp = $request->no_hp;
        $resepsionis->alamat = $request->alamat;
        $resepsionis->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully.',
        ]);
    }
}
