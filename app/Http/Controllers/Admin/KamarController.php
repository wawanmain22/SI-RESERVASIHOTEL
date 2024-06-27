<?php

namespace App\Http\Controllers\Admin;

use App\Models\JenisKamar;
use App\Models\Kamar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class KamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::with('jenisKamar')->get();
        $jenisKamars = JenisKamar::all();
        return view('admin.kamar', compact('kamars', 'jenisKamars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jeniskamar' => 'required',
            'nomor_kamar' => 'required|unique:kamars,nomor_kamar',
            'harga' => 'required|numeric',
        ]);

        Kamar::create([
            'id_jeniskamar' => $request->id_jeniskamar,
            'nomor_kamar' => $request->nomor_kamar,
            'harga' => $request->harga,
            'status' => 'Available',
        ]);

        return response()->json(['success' => true]);
    }

    public function show($nomor_kamar)
    {
        $kamar = Kamar::with('jenisKamar')->where('nomor_kamar', $nomor_kamar)->firstOrFail();
        return response()->json($kamar);
    }

    public function update(Request $request, $nomor_kamar)
    {
        $request->validate([
            'id_jeniskamar' => 'required',
            'nomor_kamar' => 'required|unique:kamars,nomor_kamar,' . $nomor_kamar . ',nomor_kamar',
            'harga' => 'required|numeric',
        ]);

        $kamar = Kamar::where('nomor_kamar', $nomor_kamar)->firstOrFail();
        $kamar->update([
            'id_jeniskamar' => $request->id_jeniskamar,
            'nomor_kamar' => $request->nomor_kamar,
            'harga' => $request->harga,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($nomor_kamar)
    {
        $kamar = Kamar::where('nomor_kamar', $nomor_kamar)->firstOrFail();
        $kamar->delete();

        return response()->json(['success' => true]);
    }
}
