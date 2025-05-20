<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\PengelolaanLimbah;

class BentukPengelolaan extends Model
{
    use HasFactory;

    protected $table = 'bentuk_pengelolaan';
    protected $primaryKey = 'id_bentuk_pengelolaan';

    protected $fillable = [
        'id_limbah',
        'dikumpulkan_di_tps',
        'dikerjasamakan_dengan_pihak_lain_yang_telah_berizin',
        'dimanfaatkan_untuk_internal_industri',
    ];

    // Relasi ke pengelolaan_limbah
    public function pengelolaanLimbah(): BelongsTo
    {
        return $this->belongsTo(PengelolaanLimbah::class, 'id_limbah', 'id_limbah');
    }
}
