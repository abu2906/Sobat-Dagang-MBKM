<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\DataIkm;

class PenggunaanBahanBakar extends Model
{
    use HasFactory;

    protected $table = 'penggunaan_bahan_bakar';
    protected $primaryKey = 'id_bahan_bakar';

    protected $fillable = [
        'id_ikm',
        'jenis_bahan_bakar',
        'satuan_standar',
        'banyaknya_proses_produksi',
        'nilai_proses_produksi',
        'banyaknya_pembangkit_tenaga_listrik',
        'nilai_pembangkit_tenaga_listrik',
    ];

    // Relasi ke DataIkm
    public function dataIkm(): BelongsTo
    {
        return $this->belongsTo(DataIkm::class, 'id_ikm', 'id_ikm');
    }
}
