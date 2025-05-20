<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\DataIkm;

class PengelolaanLimbah extends Model
{
    use HasFactory;

    protected $table = 'pengelolaan_limbah';
    protected $primaryKey = 'id_limbah';

    protected $fillable = [
        'id_ikm',
        'jenis_limbah',
        'jumlah',
        'bentuk_pengelolaan',
        'parameter',
        'banyaknya',
    ];

    // Relasi ke DataIkm
    public function dataIkm(): BelongsTo
    {
        return $this->belongsTo(DataIkm::class, 'id_ikm', 'id_ikm');
    }

    public function bentukPengelolaan()
    {
        return $this->hasOne(BentukPengelolaan::class, 'id_limbah', 'id_limbah');
    }
}
