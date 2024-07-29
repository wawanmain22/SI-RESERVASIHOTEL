<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\Resepsionis;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        $adminUser = User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        Admin::create([
            'user_id' => $adminUser->id,
            'nama' => 'Admin Utama',
        ]);

        // Resepsionis users
        $resepsionisData = [
            [
                'username' => 'resepsionis1',
                'email' => 'resepsionis1@example.com',
                'nama' => 'Resepsionis Satu',
                'jenis_kelamin' => 'Laki-laki',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Contoh No. 1',
            ],
            [
                'username' => 'resepsionis2',
                'email' => 'resepsionis2@example.com',
                'nama' => 'Resepsionis Dua',
                'jenis_kelamin' => 'Perempuan',
                'no_hp' => '081234567891',
                'alamat' => 'Jl. Contoh No. 2',
            ],
            [
                'username' => 'resepsionis3',
                'email' => 'resepsionis3@example.com',
                'nama' => 'Resepsionis Tiga',
                'jenis_kelamin' => 'Laki-laki',
                'no_hp' => '081234567892',
                'alamat' => 'Jl. Contoh No. 3',
            ],
            [
                'username' => 'resepsionis4',
                'email' => 'resepsionis4@example.com',
                'nama' => 'Resepsionis Empat',
                'jenis_kelamin' => 'Perempuan',
                'no_hp' => '081234567893',
                'alamat' => 'Jl. Contoh No. 4',
            ],
            [
                'username' => 'resepsionis5',
                'email' => 'resepsionis5@example.com',
                'nama' => 'Resepsionis Lima',
                'jenis_kelamin' => 'Laki-laki',
                'no_hp' => '081234567894',
                'alamat' => 'Jl. Contoh No. 5',
            ],
        ];

        foreach ($resepsionisData as $data) {
            $user = User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role' => 'resepsionis',
            ]);

            Resepsionis::create([
                'user_id' => $user->id,
                'nama' => $data['nama'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'no_hp' => $data['no_hp'],
                'alamat' => $data['alamat'],
            ]);
        }
    }
}