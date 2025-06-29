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
        'nama_usaha',
        'alamat',
        'no_sertifikasi_halal',
        'tanggal_sah',
        'tanggal_exp',
        'sertifikat',
        'status',
    ];

}