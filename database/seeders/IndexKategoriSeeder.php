<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class IndexKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('index_kategori')->insert([
            ['nama_kategori' => 'Beras',   'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Cabe',    'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Ayam',    'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Bawang',  'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Telur',   'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Daging',  'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Ikan',    'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Tahu',    'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Tempe',   'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Tomat',  'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
