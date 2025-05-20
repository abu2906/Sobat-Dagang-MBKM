<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikatHalal extends Model
{
    use HasFactory;

    protected $table = 'sertifikat_halal'; // Nama tabel di database

    protected $primaryKey = 'id_halal'; // Primary key

    public $incrementing = true; // Primary key auto increment

    protected $keyType = 'int'; // Tipe primary key

    protected $fillable = [
        'id_user',
        'id_ikm',
        'nama_ikm',
        'nomor_sertifikat',
        'alamat',
        'tanggal_sah',
        'tanggal_exp',
        'link_dokumen',
    ];

    // Relasi ke tabel user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke tabel data ikm
    public function dataIkm()
    {
        return $this->belongsTo(DataIkm::class, 'id_ikm', 'id_ikm');
    }
}
