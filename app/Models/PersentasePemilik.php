<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\DataIkm;

class PersentasePemilik extends Model
{
    use HasFactory;

    protected $table = 'persentase_pemilik';
    protected $primaryKey = 'id_pemilik';

    protected $fillable = [
        'id_ikm',
        'pemerintah_pusat',
        'pemerintah_daerah',
        'swasta_nasional',
        'asing',
    ];

    // Relasi ke DataIkm
    public function dataIkm(): BelongsTo
    {
        return $this->belongsTo(DataIkm::class, 'id_ikm', 'id_ikm');
    }
}
