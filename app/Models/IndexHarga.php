<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class IndexHarga extends Model
{
    protected $table = 'index_harga';
    public $timestamps = false;

    public function barang() {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function kategori() {
        return $this->belongsTo(IndexKategori::class, 'id_index_kategori');
    }
}
