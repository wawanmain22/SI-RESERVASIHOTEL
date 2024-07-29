<?php

namespace App\Http\Controllers\Resepsionis;

use App\Models\Kamar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ResepsionisKamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::with([
            'jenisKamar',
            'reservasiKamar.reservasi' => function ($query) {
                $query->where('status', 'Checkin');
            }
        ])->get();

        $kamars = $kamars->map(function ($kamar) {
            $reservasi = $kamar->reservasiKamar->first() ? $kamar->reservasiKamar->first()->reservasi : null;
            $kamar->status_display = $kamar->status === 'Occupied' && $reservasi
                ? "Occupied until " . Carbon::parse($reservasi->tgl_checkout)->format('d/m/Y')
                : $kamar->status;
            return $kamar;
        });

        return view('resepsionis.kamar', compact('kamars'));
    }

    public function show($nomor_kamar)
    {
        $kamar = Kamar::with([
            'jenisKamar',
            'reservasiKamar.reservasi' => function ($query) {
                $query->where('status', 'Checkin');
            }
        ])->where('nomor_kamar', $nomor_kamar)->firstOrFail();

        $reservasi = $kamar->reservasiKamar->first() ? $kamar->reservasiKamar->first()->reservasi : null;
        $kamar->status_display = $kamar->status === 'Occupied' && $reservasi
            ? "Occupied until " . Carbon::parse($reservasi->tgl_checkout)->format('d/m/Y')
            : $kamar->status;

        return response()->json($kamar);
    }
}