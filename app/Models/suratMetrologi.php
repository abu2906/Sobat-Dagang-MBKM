<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suratMetrologi extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk_metrologi';

    protected $fillable = [
        'user_id',
        'titik_koordinat',
        'dokumen',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
