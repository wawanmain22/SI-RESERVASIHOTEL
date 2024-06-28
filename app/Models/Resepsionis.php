<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resepsionis extends Model
{
    use HasFactory;

    protected $table = 'resepsionis';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'no_hp',
        'alamat',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
