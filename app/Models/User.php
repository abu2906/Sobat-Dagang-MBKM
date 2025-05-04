<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'user'; // 👈 WAJIB
    protected $primaryKey = 'id_user'; // kalau kamu pakai id_user
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'email',
        'telp',
        'password',
        'alamat_lengkap',
        'nik',
        'nib'
    ];
}
