<?php

namespace App\Http\Controllers;

use App\Models\Resepsionis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResepsionisController extends Controller
{
    public function index()
    {
        $resepsionis = Resepsionis::all();
        return view('admin.resepsionis', compact('resepsionis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:resepsionis,username',
            'password' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        Resepsionis::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return response()->json(['success' => true]);
    }

    public function show($username)
    {
        $resepsionis = Resepsionis::where('username', $username)->firstOrFail();
        return response()->json($resepsionis);
    }

    public function update(Request $request, $username)
    {
        $request->validate([
            'username' => 'required|unique:resepsionis,username,' . $username . ',username',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $resepsionis = Resepsionis::where('username', $username)->firstOrFail();
        $resepsionis->update([
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $resepsionis->password,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($username)
    {
        $resepsionis = Resepsionis::where('username', $username)->firstOrFail();
        $resepsionis->delete();

        return response()->json(['success' => true]);
    }
}
