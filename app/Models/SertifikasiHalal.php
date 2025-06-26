<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SertifikasiHalal extends Model
{
    use HasFactory;

    protected $table = 'sertifikasi_halal';

    protected $primaryKey = 'id_halal';

    protected $fillable = [
        'id_user',                      
        'id_ikm',                       
        'nama_usaha',
        'alamat',
        'no_sertifikasi_halal',
        'tanggal_sah',
        'tanggal_exp',
        'sertifikat',
        'status',                      

        'umur_sertifikat_teks',
        'klasifikasi_risiko',
        'rekomendasi_tindakan',
        'sisa_berlaku_teks',
    ];

    protected $casts = [
        'tanggal_sah' => 'date',
        'tanggal_exp' => 'date',
    ];
}
