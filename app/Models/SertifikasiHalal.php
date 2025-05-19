<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikasiHalal extends Model
{
    use HasFactory;

    protected $table = 'sertifikasi_halal';
    protected $primaryKey = 'id_halal';

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

    // Relasi: Sertifikasi Halal milik satu IKM
    public function ikm()
    {
        return $this->belongsTo(Ikm::class, 'id_ikm', 'id_ikm');
    }

    // Relasi: Sertifikasi Halal milik satu User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
