<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamars';

    protected $fillable = [
        'id_jeniskamar',
        'nomor_kamar',
        'harga',
        'status',
    ];

    public function jenisKamar()
    {
        return $this->belongsTo(JenisKamar::class, 'id_jeniskamar');
    }

    public function reservasiKamar()
    {
        return $this->hasMany(ReservasiKamar::class, 'id_kamar');
    }
}
