<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class ResepsionisTransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('reservasi.reservasiPelanggan.pelanggan', 'reservasi.reservasiKamar.kamar.jenisKamar')->get();
        return view('resepsionis.transaksi', compact('transaksis'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('reservasi.reservasiPelanggan.pelanggan', 'reservasi.reservasiKamar.kamar.jenisKamar')->findOrFail($id);
        foreach ($transaksi->reservasi->reservasiKamar as $reservasiKamar) {
            $reservasiKamar->kamar->formatted_harga = formatRupiah($reservasiKamar->kamar->harga);
        }
        return response()->json($transaksi);
    }
}

if (!function_exists('formatRupiah')) {
    function formatRupiah($angka, $prefix = 'Rp')
    {
        $numberString = preg_replace('/[^0-9]/', '', $angka);
        $split = explode(',', $numberString);
        $sisa = strlen($split[0]) % 3;
        $rupiah = substr($split[0], 0, $sisa);
        $ribuan = substr($split[0], $sisa);

        $ribuan = str_split($ribuan, 3);
        $ribuan = implode('.', $ribuan);

        $rupiah .= $ribuan;
        $rupiah = $split[1] != '' ? $rupiah . ',' . $split[1] : $rupiah;
        return $prefix . $rupiah;
    }
}
