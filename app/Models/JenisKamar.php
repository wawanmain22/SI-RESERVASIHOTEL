<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKamar extends Model
{
    use HasFactory;

    protected $table = 'jenis_kamars';

    protected $fillable = [
        'nama',
        'fasilitas',
        'deskripsi',
    ];

    public function kamars()
    {
        return $this->hasMany(Kamar::class, 'id_jeniskamar');
    }
}
