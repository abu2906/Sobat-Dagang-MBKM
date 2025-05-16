<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suratMetrologi extends Model
{
    use HasFactory;

    protected $table = 'surat_metrologi';
    protected $primaryKey = 'id_surat';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'alamat_alat',
        'jenis_surat',
        'dokumen',
        'dokumen_balasan',
        'status',
        'status_admin',
        'status_kabid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
