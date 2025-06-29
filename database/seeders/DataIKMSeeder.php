<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataIkm;
use Illuminate\Support\Str;

class DataIKMSeeder extends Seeder
{
    public function run(): void
    {
        $dataWilayah = [
            'Bacukiki' => [
                'Lompoe',
                'WT. Bacukiki',
                'Lemoe',
                'Galung Maloang'
            ],
            'Ujung' => [
                'Labukkang',
                'Ujung Sabbang',
                'Ujung Bulu',
                'Lapadde',
                'Mallusetasi'
            ],
            'Soreang' => [
                'Lakessi',
                'Ujung Baru',
                'Watang Soreang',
                'Kampung Pisang',
                'Ujung Lare',
                'Bukit Indah',
                'Bukit Harapan'
            ],
            'Bacukiki Barat' => [
                'Kampung Baru',
                'Cappa Galung',
                'Lumpue',
                'Tiro Sompe',
                'Sumpang Minangae',
                'Bumi Harapan'
            ],
        ];

        $jenisIndustriList = [
            'Sandang',
            'Pangan',
            'Kimia & Bahan Bangunan',
            'Logam & Elektronika',
            'Kerajinan'
        ];

        $komoditiList = ['Komoditi 1', 'Komoditi 2', 'Komoditi 3'];
        $genderList = ['Laki-laki', 'Perempuan'];

        for ($i = 1; $i <= 40; $i++) {
            // Ambil kecamatan secara acak
            $kecamatan = array_rand($dataWilayah);
            // Ambil kelurahan berdasarkan kecamatan
            $kelurahanList = $dataWilayah[$kecamatan];
            $kelurahan = $kelurahanList[array_rand($kelurahanList)];

            $ikm = DataIkm::create([
                'nama_ikm' => 'IKM-' . Str::random(5),
                'luas' => rand(50, 300) . ' m2',
                'nama_pemilik' => 'Pemilik-' . $i,
                'jenis_kelamin' => $genderList[array_rand($genderList)],
                'kecamatan' => $kecamatan,
                'kelurahan' => $kelurahan,
                'komoditi' => $komoditiList[array_rand($komoditiList)],
                'jenis_industri' => $jenisIndustriList[array_rand($jenisIndustriList)],
                'alamat' => 'Jl. Contoh No.' . $i,
                'nib' => 'NIB' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'no_telp' => '08' . rand(1000000000, 9999999999),
                'tenaga_kerja' => rand(1, 100),
            ]);

            $ikm->level = $ikm->hitungLevel();
            $ikm->save();
        }
    }
}
