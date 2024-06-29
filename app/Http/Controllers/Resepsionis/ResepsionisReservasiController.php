<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Pelanggan;
use App\Models\ReservasiPelanggan;
use App\Models\ReservasiKamar;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResepsionisReservasiController extends Controller
{
    public function index()
    {
        $reservasis = Reservasi::with('reservasiPelanggan.pelanggan', 'reservasiKamar.kamar.jenisKamar')->get();
        $kamars = Kamar::where('status', 'Available')->get();
        return view('resepsionis.reservasi', compact('reservasis', 'kamars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggans.*.nama' => 'required|string',
            'pelanggans.*.jenis_kelamin' => 'required|string',
            'pelanggans.*.no_hp' => 'required|string',
            'pelanggans.*.alamat' => 'required|string',
            'tgl_checkin' => 'required|date',
            'tgl_checkout' => 'required|date',
            'kamars' => 'required|array|min:1',
            'kamars.*' => 'exists:kamars,id'
        ]);

        // Generate Kode Reservasi
        $today = date('Y-m-d');
        $countToday = Reservasi::whereDate('created_at', $today)->count() + 1;
        $kodeReservasi = 'RSR-' . str_pad($countToday, 2, '0', STR_PAD_LEFT) . '-' . date('dmY');

        $reservasi = Reservasi::create([
            'kode_reservasi' => $kodeReservasi,
            'user_id' => Auth::id(),
            'tgl_checkin' => $request->tgl_checkin,
            'tgl_checkout' => $request->tgl_checkout,
        ]);

        foreach ($request->pelanggans as $pelangganData) {
            $pelanggan = Pelanggan::create($pelangganData);
            ReservasiPelanggan::create([
                'id_reservasi_pelanggan' => $reservasi->id,
                'id_pelanggan' => $pelanggan->id,
            ]);
        }

        foreach ($request->kamars as $kamarId) {
            ReservasiKamar::create([
                'id_reservasi_kamar' => $reservasi->id,
                'id_kamar' => $kamarId,
            ]);

            // Update Kamar status to Occupied
            $kamar = Kamar::find($kamarId);
            $kamar->status = 'Occupied';
            $kamar->save();
        }

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $kodeReservasi)
    {
        $reservasi = Reservasi::where('kode_reservasi', $kodeReservasi)->firstOrFail();

        $request->validate([
            'tgl_checkin' => 'required|date',
            'tgl_checkout' => 'required|date'
        ]);

        $reservasi->update([
            'tgl_checkin' => $request->tgl_checkin,
            'tgl_checkout' => $request->tgl_checkout,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($kodeReservasi)
    {
        $reservasi = Reservasi::where('kode_reservasi', $kodeReservasi)->firstOrFail();

        // Update Kamar status to Available
        foreach ($reservasi->reservasiKamar as $reservasiKamar) {
            $kamar = Kamar::find($reservasiKamar->id_kamar);
            $kamar->status = 'Available';
            $kamar->save();
        }

        $reservasi->delete();

        return response()->json(['success' => true]);
    }

    public function show($kodeReservasi)
    {
        $reservasi = Reservasi::with(['reservasiPelanggan.pelanggan', 'reservasiKamar.kamar.jenisKamar'])
            ->where('kode_reservasi', $kodeReservasi)
            ->firstOrFail();

        // Format harga kamar
        foreach ($reservasi->reservasiKamar as $reservasiKamar) {
            $reservasiKamar->kamar->formatted_harga = formatRupiah($reservasiKamar->kamar->harga);
        }

        return response()->json($reservasi);
    }
}
