<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiKamar extends Model
{
    use HasFactory;

    protected $table = 'reservasi_kamars';

    protected $fillable = [
        'id_reservasi_kamar',
        'id_kamar',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi_kamar');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar');
    }
}
