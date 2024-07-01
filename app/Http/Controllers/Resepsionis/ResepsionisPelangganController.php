<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class ResepsionisPelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::with('reservasiPelanggan.reservasi')->get();
        return view('resepsionis.pelanggan', compact('pelanggans'));
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::with('reservasiPelanggan.reservasi.reservasiKamar.kamar.jenisKamar')->findOrFail($id);
        foreach ($pelanggan->reservasiPelanggan as $reservasiPelanggan) {
            foreach ($reservasiPelanggan->reservasi->reservasiKamar as $reservasiKamar) {
                $reservasiKamar->kamar->formatted_harga = formatRupiah($reservasiKamar->kamar->harga);
            }
        }
        return response()->json($pelanggan);
    }
}
