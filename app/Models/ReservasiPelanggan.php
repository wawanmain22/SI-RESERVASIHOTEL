<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiPelanggan extends Model
{
    use HasFactory;

    protected $table = 'reservasi_pelanggans';

    protected $fillable = [
        'id_reservasi_pelanggan',
        'id_pelanggan',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi_pelanggan');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
}
