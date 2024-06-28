<?php

namespace App\Http\Controllers\Admin;

use App\Models\Resepsionis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class ResepsionisController extends Controller
{
    public function index()
    {
        $resepsionis = Resepsionis::with('user')->get();
        return view('admin.resepsionis', compact('resepsionis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->username . '@example.com', // or any default email
            'password' => Hash::make($request->password),
            'role' => 'resepsionis',
        ]);

        Resepsionis::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return response()->json(['success' => true]);
    }

    public function show($username)
    {
        $resepsionis = Resepsionis::whereHas('user', function ($query) use ($username) {
            $query->where('username', $username);
        })->with('user')->firstOrFail();

        return response()->json($resepsionis);
    }

    public function update(Request $request, $username)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $username . ',username',
            'password' => 'nullable|confirmed',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $resepsionis = Resepsionis::whereHas('user', function ($query) use ($username) {
            $query->where('username', $username);
        })->firstOrFail();

        $user = $resepsionis->user;
        $user->update([
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        $resepsionis->update([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($username)
    {
        $resepsionis = Resepsionis::whereHas('user', function ($query) use ($username) {
            $query->where('username', $username);
        })->firstOrFail();

        $user = $resepsionis->user;
        $resepsionis->delete();
        $user->delete();

        return response()->json(['success' => true]);
    }
}
