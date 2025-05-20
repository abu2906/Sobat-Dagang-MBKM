<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\DataIkm;

class Pendapatan extends Model
{
    use HasFactory;

    protected $table = 'pendapatan';
    protected $primaryKey = 'id_pendapatan';

    protected $fillable = [
        'id_ikm',
        'nilai',
        'sumber',
    ];

    // Relasi ke DataIkm
    public function dataIkm(): BelongsTo
    {
        return $this->belongsTo(DataIkm::class, 'id_ikm', 'id_ikm');
    }
}
