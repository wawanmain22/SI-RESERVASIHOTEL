<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis';

    protected $fillable = [
        'user_id',
        'id_pelanggan',
        'status',
        'tgl_checkin',
        'tgl_checkout',
        'waktu_pemesanan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function reservasiKamar()
    {
        return $this->hasMany(ReservasiKamar::class, 'id_reservasi');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'id_reservasi');
    }
}

