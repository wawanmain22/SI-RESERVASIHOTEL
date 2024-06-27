<?php

namespace App\Http\Controllers\Admin;

use App\Models\JenisKamar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class JenisKamarController extends Controller
{
    public function index()
    {
        $jenis_kamars = JenisKamar::all();
        return view('admin.jenis-kamar', compact('jenis_kamars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:jenis_kamars,nama',
            'fasilitas' => 'required',
            'deskripsi' => 'required',
        ]);

        JenisKamar::create([
            'nama' => $request->nama,
            'fasilitas' => $request->fasilitas,
            'deskripsi' => $request->deskripsi,
        ]);

        return response()->json(['success' => true]);
    }

    public function show($nama)
    {
        $jenis_kamar = JenisKamar::where('nama', $nama)->firstOrFail();
        return response()->json($jenis_kamar);
    }

    public function update(Request $request, $nama)
    {
        $request->validate([
            'nama' => 'required|unique:jenis_kamars,nama,' . $nama . ',nama',
            'fasilitas' => 'required',
            'deskripsi' => 'required',
        ]);

        $jenis_kamar = JenisKamar::where('nama', $nama)->firstOrFail();
        $jenis_kamar->update([
            'nama' => $request->nama,
            'fasilitas' => $request->fasilitas,
            'deskripsi' => $request->deskripsi,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($nama)
    {
        $jenis_kamar = JenisKamar::where('nama', $nama)->firstOrFail();
        $jenis_kamar->delete();

        return response()->json(['success' => true]);
    }
}
