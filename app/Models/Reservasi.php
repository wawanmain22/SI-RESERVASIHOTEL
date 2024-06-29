<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis';

    protected $fillable = [
        'kode_reservasi',
        'user_id',
        'status',
        'tgl_checkin',
        'tgl_checkout',
        'waktu_pemesanan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reservasiPelanggan()
    {
        return $this->hasMany(ReservasiPelanggan::class, 'id_reservasi_pelanggan');
    }
    public function reservasiKamar()
    {
        return $this->hasMany(ReservasiKamar::class, 'id_reservasi_kamar');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'id_reservasi');
    }
}

