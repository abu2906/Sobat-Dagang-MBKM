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
        'level'
    ];

    // === RELASI ===

    public function karyawan()
    {
        return $this->hasOne(Karyawan::class, 'id_ikm');
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
        return $this->hasOne(PenggunaanAir::class, 'id_ikm');
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
        return $this->hasOne(Listrik::class, 'id_ikm');
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

    public function modal()
    {
        return $this->hasMany(Modal::class, 'id_ikm', 'id_ikm');
    }

    public function bentukPengelolaanLimbah()
    {
        return $this->hasOne(BentukPengelolaanLimbah::class, 'id_ikm', 'id_ikm');
    }

    public function hitungLevel()
    {
        $nilaiDalamNegeri = $this->pemakaianBahan->sum('nilai_dalam_negeri');
        $nilaiImpor = $this->pemakaianBahan->sum('nilai_impor');
        $biaya = $this->penggunaanAir->biaya ?? 0;
        $pengeluaran = $this->pengeluaran;
        $upahGaji = $pengeluaran->upah_gaji ?? 0;
        $pengeluaranIndustriDistribusi = $pengeluaran->pengeluaran_industri_distribusi ?? 0;
        $pengeluaranRnd = $pengeluaran->pengeluaran_rnd ?? 0;
        $pengeluaranTanah = $pengeluaran->pengeluaran_tanah ?? 0;
        $pengeluaranGedung = $pengeluaran->pengeluaran_gedung ?? 0;
        $pengeluaranMesin = $pengeluaran->pengeluaran_mesin ?? 0;
        $lainnya = $pengeluaran->lainnya ?? 0;
        $nilaiProsesProduksi = $this->penggunaanBahanBakar->sum('nilai_proses_produksi');
        $nilaiPtl = $this->penggunaanBahanBakar->sum('nilai_ptl');
        $nilai = $listrik?->nilai_penggunaan_listrik ?? 0;
        $awal = $this->persediaan->sum('awal');
        $akhir = $this->persediaan->sum('akhir');
        $nilaiPendapatan = $this->pendapatan->sum('nilai');
        $pembelianPenambahanPerbaikan = $this->modal->sum('pembelian_penambahan_perbaikan');
        $penguranganBarangModal = $this->modal->sum('pengurangan_barang_modal');
        $penyusutanBarang = $this->modal->sum('penyusutan_barang');
        $nilaiTaksiran = $this->modal->sum('nilai_taksiran');

        return
            $nilaiDalamNegeri
            + $nilaiImpor
            + $biaya
            + $upahGaji
            + $pengeluaranIndustriDistribusi
            + $pengeluaranRnd
            + $pengeluaranTanah
            + $pengeluaranGedung
            + $pengeluaranMesin
            + $lainnya
            + $nilaiProsesProduksi
            + $nilaiPtl
            + $nilai
            + $awal
            + $akhir
            + $nilaiPendapatan
            + $pembelianPenambahanPerbaikan
            + $penguranganBarangModal
            + $penyusutanBarang
            + $nilaiTaksiran;
    }

    protected static function booted()
    {
        static::saving(function ($model) {
            $model->level = $model->hitungLevel();
        });
    }
}
