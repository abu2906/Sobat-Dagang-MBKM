<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\DataIkm;

class Modal extends Model
{
    use HasFactory;

    protected $table = 'modal';
    protected $primaryKey = 'id_modal';

    protected $fillable = [
        'id_ikm',
        'jenis_barang',
        'pembelian_penambahan_perbaikan',
        'pengurangan_barang_modal',
        'penyusutan_barang',
        'nilai_taksiran',
    ];

    // Relasi ke tabel data_ikm
    public function dataIkm(): BelongsTo
    {
        return $this->belongsTo(DataIkm::class, 'id_ikm', 'id_ikm');
    }
}
