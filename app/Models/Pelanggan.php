<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'no_hp',
        'alamat',
        'email',
    ];

    public function reservasiPelanggan()
    {
        return $this->hasMany(ReservasiPelanggan::class, 'id_pelanggan');
    }
}
