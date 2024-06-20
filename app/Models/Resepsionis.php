<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resepsionis extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'resepsionis';

    protected $fillable = [
        'username',
        'password',
        'nama',
        'jenis_kelamin',
        'no_hp',
        'alamat',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
