<?php

namespace App\Http\Controllers\Resepsionis;

use App\Models\Kamar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResepsionisKamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::with('jenisKamar')->get();
        return view('resepsionis.kamar', compact('kamars'));
    }

    public function show($nomor_kamar)
    {
        $kamar = Kamar::with('jenisKamar')->where('nomor_kamar', $nomor_kamar)->firstOrFail();
        return response()->json($kamar);
    }
}
