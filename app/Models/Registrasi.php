<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{
    protected $table = 'registrasi'; 
    protected $fillable = [
        'password', 
        'nama_lengkap', 
        'email_aktif', 
        'jenis_kelamin', 
        'nik', 
        'nib', 
        'nomor_hp', 
        'alamat_lengkap',
        'kabupaten',  
        'kecamatan',  
        'kelurahan'   
    ];

    // Fungsi untuk validasi registrasi tambahan
    public static function validateRegistration($data)
    {
        $existingUser = Registrasi::where('email_aktif', $data['email_aktif'])->first();
        if ($existingUser) {
            return false; 
        }

        // Tambahkan validasi lainnya sesuai kebutuhan
        // Contoh: cek apakah NIK sudah terdaftar
        $existingNik = Registrasi::where('nik', $data['nik'])->first();
        if ($existingNik) {
            return false; 
        }

        return true; 
    }
}
