<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanSurat extends Model
{
    use HasFactory;
    protected $keyType = 'string'; // Menggunakan string karena UUID adalah string
    public $incrementing = false; // Nonaktifkan incr
    protected $table = 'form_permohonan';
    protected $primaryKey = 'id_permohonan';
    protected $fillable = [
        'user_id',
        'kecamatan',
        'kelurahan',
        'jenis_surat',
        'status',
        'titik_koordinat',
        'file_balasan',

    ];
    public function document()
    {
        return $this->hasOne(DocumentUser::class, 'id_permohonan', 'id_permohonan');
    }
}
