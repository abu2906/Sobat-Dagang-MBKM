<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\DataIkm;

class Listrik extends Model
{
    use HasFactory;

    protected $table = 'listrik';
    protected $primaryKey = 'id_listrik';

    protected $fillable = [
        'id_ikm',
        'sumber',
        'banyaknya',
        'nilai',
        'peruntukkan',
    ];

    public function dataIkm(): BelongsTo
    {
        return $this->belongsTo(DataIkm::class, 'id_ikm', 'id_ikm');
    }
}
