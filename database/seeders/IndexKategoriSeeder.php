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
            ['id_index_kategori' => 1, 'nama_kategori' => 'Beras',   'created_at' => $now, 'updated_at' => $now],
            ['id_index_kategori' => 2, 'nama_kategori' => 'Cabe',    'created_at' => $now, 'updated_at' => $now],
            ['id_index_kategori' => 3, 'nama_kategori' => 'Ayam',    'created_at' => $now, 'updated_at' => $now],
            ['id_index_kategori' => 4, 'nama_kategori' => 'Bawang',  'created_at' => $now, 'updated_at' => $now],
            ['id_index_kategori' => 5, 'nama_kategori' => 'Telur',   'created_at' => $now, 'updated_at' => $now],
            ['id_index_kategori' => 6, 'nama_kategori' => 'Daging',  'created_at' => $now, 'updated_at' => $now],
            ['id_index_kategori' => 7, 'nama_kategori' => 'Ikan',    'created_at' => $now, 'updated_at' => $now],
            ['id_index_kategori' => 8, 'nama_kategori' => 'Tahu',    'created_at' => $now, 'updated_at' => $now],
            ['id_index_kategori' => 9, 'nama_kategori' => 'Tempe',   'created_at' => $now, 'updated_at' => $now],
            ['id_index_kategori' => 10, 'nama_kategori' => 'Tomat',  'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
