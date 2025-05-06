<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanSurat extends Model
{
    use HasFactory;
    protected $table = 'form_permohonan';
    protected $fillable = [
        'user_id',
        'tanggal_dikirim',
        'jenis_surat',
        'status',
        'file_balasan',
    ];
}
