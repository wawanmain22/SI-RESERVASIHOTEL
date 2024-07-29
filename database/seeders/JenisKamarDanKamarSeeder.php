<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisKamar;
use App\Models\Kamar;

class JenisKamarDanKamarSeeder extends Seeder
{
    public function run()
    {
        // Seed jenis kamar
        $jenisKamar = [
            [
                'nama' => 'Standard Room',
                'fasilitas' => 'TV, AC, Wi-Fi, Kamar mandi dalam',
                'deskripsi' => 'Kamar nyaman untuk 2 orang dengan fasilitas standar hotel.'
            ],
            [
                'nama' => 'Deluxe Room',
                'fasilitas' => 'TV, AC, Wi-Fi, Kamar mandi dalam, Mini bar',
                'deskripsi' => 'Kamar lebih luas dengan tambahan mini bar untuk kenyamanan ekstra.'
            ],
            [
                'nama' => 'Junior Suite',
                'fasilitas' => 'TV, AC, Wi-Fi, Kamar mandi dalam, Mini bar, Ruang tamu terpisah',
                'deskripsi' => 'Kamar mewah dengan ruang tamu terpisah, cocok untuk keluarga atau tamu bisnis.'
            ],
            [
                'nama' => 'Family Room',
                'fasilitas' => 'TV, AC, Wi-Fi, Kamar mandi dalam, 2 tempat tidur besar',
                'deskripsi' => 'Kamar luas dengan 2 tempat tidur besar, ideal untuk keluarga atau grup.'
            ],
            [
                'nama' => 'Executive Suite',
                'fasilitas' => 'TV, AC, Wi-Fi, Kamar mandi dalam, Mini bar, Ruang kerja, Jacuzzi',
                'deskripsi' => 'Kamar super mewah dengan fasilitas lengkap termasuk jacuzzi dan ruang kerja.'
            ]
        ];

        foreach ($jenisKamar as $jenis) {
            JenisKamar::create($jenis);
        }

        // Kode dan harga untuk setiap jenis kamar
        $detailKamar = [
            'Standard Room' => ['kode' => 'SR', 'harga' => 500000],
            'Deluxe Room' => ['kode' => 'DR', 'harga' => 750000],
            'Junior Suite' => ['kode' => 'JS', 'harga' => 1000000],
            'Family Room' => ['kode' => 'FR', 'harga' => 1250000],
            'Executive Suite' => ['kode' => 'ES', 'harga' => 1500000]
        ];

        // Seed kamar
        $jenisKamars = JenisKamar::all();

        foreach ($jenisKamars as $jenisKamar) {
            $detail = $detailKamar[$jenisKamar->nama];
            for ($i = 1; $i <= 10; $i++) {
                Kamar::create([
                    'id_jeniskamar' => $jenisKamar->id,
                    'nomor_kamar' => $detail['kode'] . sprintf('%03d', $i), // Format: [kode jenis kamar][nomor urut 3 digit]
                    'harga' => $detail['harga'],
                    'status' => 'Available'
                ]);
            }
        }
    }
}