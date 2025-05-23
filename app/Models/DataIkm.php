<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataIkm extends Model
{
    use HasFactory;

    protected $table = 'data_ikm';
    protected $primaryKey = 'id_ikm';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_ikm',
        'luas',
        'nama_pemilik',
        'jenis_kelamin',
        'kecamatan',
        'kelurahan',
        'komoditi',
        'jenis_industri',
        'alamat',
        'nib',
        'no_telp',
        'tenaga_kerja',
    ];

    // === RELASI KE SEMUA TABEL CHILD ===
    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'id_ikm', 'id_ikm');
    }

    public function persentasePemilik()
    {
        return $this->hasOne(PersentasePemilik::class, 'id_ikm', 'id_ikm');
    }

    public function pemakaianBahan()
    {
        return $this->hasMany(PemakaianBahan::class, 'id_ikm', 'id_ikm');
    }

    public function penggunaanAir()
    {
        return $this->hasOne(PenggunaanAir::class, 'id_ikm', 'id_ikm');
    }

    public function pengeluaran()
    {
        return $this->hasOne(Pengeluaran::class, 'id_ikm', 'id_ikm');
    }

    public function penggunaanBahanBakar()
    {
        return $this->hasMany(PenggunaanBahanBakar::class, 'id_ikm', 'id_ikm');
    }

    public function listrik()
    {
        return $this->hasOne(Listrik::class, 'id_ikm', 'id_ikm');
    }

    public function mesinProduksi()
    {
        return $this->hasMany(MesinProduksi::class, 'id_ikm', 'id_ikm');
    }

    public function produksi()
    {
        return $this->hasMany(Produksi::class, 'id_ikm', 'id_ikm');
    }

    public function persediaan()
    {
        return $this->hasMany(Persediaan::class, 'id_ikm', 'id_ikm');
    }

    public function pendapatan()
    {
        return $this->hasMany(Pendapatan::class, 'id_ikm', 'id_ikm');
    }

    public function bentukPengelolaan()
    {
        return $this->hasMany(BentukPengelolaanLimbah::class, 'id_ikm', 'id_ikm');
    }

    public function modal()
    {
        return $this->hasOne(Modal::class, 'id_ikm', 'id_ikm');
    }
}
