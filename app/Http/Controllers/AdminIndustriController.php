<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataIkm;

class AdminIndustriController extends Controller
{
    public function showDashboard()
    {
        return view('admin.bidangIndustri.dashboardAdmin');
    }

    public function showDataIKM()
    {
        return view('admin.bidangIndustri.dataIKM');
    }

    public function showFormIKM()
    {
        $json = file_get_contents(public_path('assets/data/wilayah.json'));
        $wilayah = json_decode($json, true);

        return view('admin.bidangIndustri.formIKM', compact('wilayah'));
    }

    public function storeDataIKM(Request $request)
    {
        $validatedDataIKM = $request->validate([
            'nama_pemilik' => 'required|string|max:255',
            'nama_ikm' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'luas' => 'required|string|max:255',
            'jenis_industri' => 'required|string|max:255',
            'komoditi' => 'required|string|max:255',
            'jumlah_tenaga_kerja' => 'required|integer|min:0',
            'nilai_investasi' => 'required|numeric|min:0',
            'nib' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
        ]);

        $validatedKaryawan = $request->validate([
            'jumlah_karyawan' => 'required|integer|min:0',
            'sd' => 'required|integer|min:0',
            'smp' => 'required|integer|min:0',
            'sma_smk' => 'required|integer|min:0',
            's1_d4' => 'required|integer|min:0',
            's2' => 'required|integer|min:0',
            's3' => 'required|integer|min:0',
            'status' => 'required|string|in:tetap,tidak tetap',
        ]);

        $validatedPersentasePemilik = $request->validate([
            'pemerintah_pusat' => 'required|numeric|min:0|max:100',
            'pemerintah_daerah' => 'required|numeric|min:0|max:100',
            'swasta_nasional' => 'required|numeric|min:0|max:100',
            'asing' => 'required|numeric|min:0|max:100',
        ]);

        $validatedPemakaianBahan = $request->validate([
            'nama_bahan' => 'required|array',
            'nama_bahan.*' => 'required|string|max:255',

            'jenis_bahan' => 'required|array',
            'jenis_bahan.*' => 'required|string|max:255',

            'spesifikasi' => 'required|array',
            'spesifikasi.*' => 'required|string|max:255',

            'kode_hs' => 'required|array',
            'kode_hs.*' => 'required|string|max:255',

            'satuan_standar_bahan' => 'required|array',
            'satuan_standar_bahan.*' => 'required|string|max:255',

            'jumlah_dalam_negeri' => 'required|array',
            'jumlah_dalam_negeri.*' => 'required|integer|min:0',

            'nilai_dalam_negeri' => 'required|array',
            'nilai_dalam_negeri.*' => 'required|numeric|min:0',

            'jumlah_impor' => 'required|array',
            'jumlah_impor.*' => 'required|integer|min:0',

            'nilai_impor' => 'required|array',
            'nilai_impor.*' => 'required|numeric|min:0',

            'negara_asal_impor' => 'required|array',
            'negara_asal_impor.*' => 'required|string|max:255',
        ]);

        $validatedPenggunaanAir = $request->validate([
            'sumber_air' => 'required|string|max:255',
            'banyaknya_penggunaan_m3' => 'required|numeric|min:0',
            'biaya' => 'required|numeric|min:0',
        ]);

        $validatedPengeluaran = $request->validate([
            'upah_gaji' => 'required|numeric|min:0',
            'lainnya' => 'required|numeric|min:0',
        ]);

        $validatedPenggunaanBahanBakar = $request->validate([
            'jenis_bahan_bakar' => 'required|array',
            'jenis_bahan_bakar.*' => 'required|string|max:255',

            'satuan_standar' => 'required|array',
            'satuan_standar.*' => 'required|string|max:255',

            'banyaknya_proses_produksi' => 'required|array',
            'banyaknya_proses_produksi.*' => 'required|numeric|min:0',

            'nilai_proses_produksi' => 'required|array',
            'nilai_proses_produksi.*' => 'required|numeric|min:0',

            'banyaknya_ptl' => 'required|array',
            'banyaknya_ptl.*' => 'required|numeric|min:0',

            'nilai_ptl' => 'required|array',
            'nilai_ptl.*' => 'required|numeric|min:0',
        ]);



        $validatedListrik = $request->validate([
            'sumber_listrik' => 'required|string|max:255',
            'banyaknya_penggunaan_listrik' => 'required|numeric|min:0',
            'nilai_penggunaan_listrik' => 'required|numeric|min:0',
            'peruntukkan_listrik' => 'required|string|max:255',
        ]);

        $validatedMesinProduksi = $request->validate([
            'jenis_mesin' => 'required|string|max:255',
            'nama_mesin' => 'required|string|max:255',
            'merk_type' => 'required|string|max:255',
            'teknologi' => 'required|string|max:255',
            'negara_pembuat' => 'required|string|max:255',
            'tahun_perolehan' => 'required|integer|min:1900|max:' . date('Y'),
            'tahun_pembuatan' => 'required|integer|min:1900|max:' . date('Y'),
            'jumlah_unit' => 'nullable|integer|min:1',
        ]);

        $validatedProduksi = $request->validate([
            'jenis_produksi' => 'required|string|max:255',
            'kbli' => 'required|string|max:255',
            'produksi_kode_hs' => 'required|string|max:255',
            'produksi_spesifikasi' => 'required|string|max:255',
            'jumlah_produksi' => 'required|numeric|min:0',
            'nilai_produksi' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:255',
            'persentase_ekspor' => 'required|numeric|min:0|max:100',
            'negara_ekspor' => 'nullable|string|max:255',
            'kapasitas_tahun' => 'required|integer|min:0',
        ]);



        $validatedPersediaan = $request->validate([
            'jenis_persediaan' => 'required|string|max:255',
            'awal' => 'required|numeric|min:0',
            'akhir' => 'required|numeric|min:0',
        ]);

        $validatedPendapatan = $request->validate([
            'nilai' => 'required|numeric|min:0',
            'sumber' => 'required|string|max:255',
        ]);


        $validatedPengelolaanLimbah = $request->validate([
            'jenis_limbah' => 'required|string|max:255',
            'jumlah_limbah' => 'required|numeric|min:0',
            'bentuk_pengelolaan' => 'required|string|max:255',
            'parameter_limbah' => 'required|string|max:255',
        ]);

        $validatedBentukPengelolaan = $request->validate([
            'dikumpulkan_di_tps' => 'required|string|max:255',
            'dikerjasamakan_dengan_pihak_lain' => 'required|string|max:255',
            'dimanfaatkan_untuk_internal_industri' => 'required|string|max:255',
        ]);


        $validatedModal = $request->validate([
            'jenis_barang' => 'required|string|max:255',
            'pembelian_penambahan_perbaikan' => 'required|numeric|min:0',
            'pengurangan_barang_modal' => 'required|numeric|min:0',
            'penyusutan_barang' => 'required|numeric|min:0',
            'nilai_taksiran' => 'required|numeric|min:0',
        ]);


        DB::beginTransaction();

        try {
            $idIkm = $this->saveDataIKM($validatedDataIKM);
            $this->saveKaryawan($idIkm, $validatedKaryawan);
            $this->savePersentasePemilik($idIkm, $validatedPersentasePemilik);
            $this->savePemakaianBahan($idIkm, $validatedPemakaianBahan);
            $this->savePenggunaanAir($idIkm, $validatedPenggunaanAir);
            $this->savePengeluaran($idIkm, $validatedPengeluaran);
            $this->savePenggunaanBahanBakar($idIkm, $validatedPenggunaanBahanBakar);
            $this->saveListrik($idIkm, $validatedListrik);
            $this->saveMesinProduksi($idIkm, $validatedMesinProduksi);
            $this->saveProduksi($idIkm, $validatedProduksi);
            $this->savePersediaan($idIkm, $validatedPersediaan);
            $this->savePendapatan($idIkm, $validatedPendapatan);
            $idLimbah = $this->savePengelolaanLimbah($idIkm, $validatedPengelolaanLimbah);
            $this->saveBentukPengelolaan($idLimbah, $validatedBentukPengelolaan);
            $this->saveModal($idIkm, $validatedModal);

            DB::commit();

            return redirect()->route('admin.industri.dataIKM')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['msg' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    protected function saveDataIKM(array $data)
    {
        return DB::table('data_ikm')->insertGetId([
            'nama_pemilik' => $data['nama_pemilik'],
            'nama_ikm' => $data['nama_ikm'],
            'alamat' => $data['alamat'],
            'no_telp' => $data['no_telp'],
            'luas' => $data['luas'],
            'jenis_industri' => $data['jenis_industri'],
            'komoditi' => $data['komoditi'],
            'jumlah_tenaga_kerja' => $data['jumlah_tenaga_kerja'],
            'nilai_investasi' => $data['nilai_investasi'],
            'nib' => $data['nib'],
            'kecamatan' => $data['kecamatan'],
            'kelurahan' => $data['kelurahan'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function saveKaryawan(int $idIkm, array $data)
    {
        return DB::table('karyawan')->insert([
            'id_ikm' => $idIkm,
            'jumlah_karyawan' => $data['jumlah_karyawan'],
            'sd' => $data['sd'],
            'smp' => $data['smp'],
            'sma_smk' => $data['sma_smk'],
            's1_d4' => $data['s1_d4'],
            's2' => $data['s2'],
            's3' => $data['s3'],
            'status' => $data['status'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function savePersentasePemilik(int $idIkm, array $data)
    {
        return DB::table('persentase_pemilik')->insert([
            'id_ikm' => $idIkm,
            'pemerintah_pusat' => $data['pemerintah_pusat'],
            'pemerintah_daerah' => $data['pemerintah_daerah'],
            'swasta_nasional' => $data['swasta_nasional'],
            'asing' => $data['asing'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function savePemakaianBahan(int $idIkm, array $data)
    {
        $count = count($data['nama_bahan']);
        $records = [];

        for ($i = 0; $i < $count; $i++) {
            $records[] = [
                'id_ikm' => $idIkm,
                'nama_bahan' => $data['nama_bahan'][$i],
                'jenis_bahan' => $data['jenis_bahan'][$i],
                'spesifikasi' => $data['spesifikasi'][$i],
                'kode_hs' => $data['kode_hs'][$i],
                'satuan_standar' => $data['satuan_standar_bahan'][$i],
                'jumlah_dalam_negeri' => $data['jumlah_dalam_negeri'][$i],
                'nilai_dalam_negeri' => $data['nilai_dalam_negeri'][$i],
                'jumlah_impor' => $data['jumlah_impor'][$i],
                'nilai_impor' => $data['nilai_impor'][$i],
                'negara_asal_impor' => $data['negara_asal_impor'][$i],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        return DB::table('pemakaian_bahan')->insert($records);
    }




    protected function savePenggunaanAir(int $idIkm, array $data)
    {
        return DB::table('penggunaan_air')->insert([
            'id_ikm' => $idIkm,
            'sumber_air' => $data['sumber_air'],
            'banyaknya_penggunaan_m3' => $data['banyaknya_penggunaan_m3'],
            'biaya' => $data['biaya'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function savePengeluaran(int $idIkm, array $data)
    {
        return DB::table('pengeluaran')->insert([
            'id_ikm' => $idIkm,
            'upah_gaji' => $data['upah_gaji'],
            'lainnya' => $data['lainnya'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function savePenggunaanBahanBakar(int $idIkm, array $data)
    {
        $count = count($data['jenis_bahan_bakar']);
        $records = [];

        for ($i = 0; $i < $count; $i++) {
            $records[] = [
                'id_ikm' => $idIkm,
                'jenis_bahan_bakar' => $data['jenis_bahan_bakar'][$i],
                'satuan_standar' => $data['satuan_standar'][$i],
                'banyaknya_proses_produksi' => $data['banyaknya_proses_produksi'][$i],
                'nilai_proses_produksi' => $data['nilai_proses_produksi'][$i],
                'banyaknya_pembangkit_tenaga_listrik' => $data['banyaknya_ptl'][$i],
                'nilai_pembangkit_tenaga_listrik' => $data['nilai_ptl'][$i],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        return DB::table('penggunaan_bahan_bakar')->insert($records);
    }





    protected function saveListrik(int $idIkm, array $data)
    {
        return DB::table('listrik')->insert([
            'id_ikm' => $idIkm,
            'sumber' => $data['sumber_listrik'],
            'banyaknya' => $data['banyaknya_penggunaan_listrik'],
            'nilai' => $data['nilai_penggunaan_listrik'],
            'peruntukkan' => $data['peruntukkan_listrik'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function saveMesinProduksi(int $idIkm, array $data)
    {
        return DB::table('mesin_produksi')->insert([
            'id_ikm' => $idIkm,
            'jenis_mesin' => $data['jenis_mesin'],
            'nama_mesin' => $data['nama_mesin'],
            'merk_type' => $data['merk_type'],
            'teknologi' => $data['teknologi'],
            'negara_pembuat' => $data['negara_pembuat'],
            'tahun_perolehan' => $data['tahun_perolehan'],
            'tahun_pembuatan' => $data['tahun_pembuatan'],
            'jumlah_unit' => $data['jumlah_unit'] ?? 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function saveProduksi(int $idIkm, array $data)
    {
        return DB::table('produksi')->insert([
            'id_ikm' => $idIkm,
            'jenis_produksi' => $data['jenis_produksi'],
            'kbli' => $data['kbli'],
            'kode_hs' => $data['produksi_kode_hs'],
            'spesifikasi' => $data['produksi_spesifikasi'],
            'banyaknya' => $data['jumlah_produksi'],
            'nilai' => $data['nilai_produksi'],
            'satuan' => $data['satuan'],
            'presentase_produk_ekspor' => $data['persentase_ekspor'],
            'negara_tujuan_ekspor' => $data['negara_ekspor'] ?? null,
            'kapasitas_terpasang_per_tahun' => $data['kapasitas_tahun'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }



    protected function savePersediaan(int $idIkm, array $data)
    {
        return DB::table('persediaan')->insert([
            'id_ikm' => $idIkm,
            'jenis_persediaan' => $data['jenis_persediaan'],
            'awal' => $data['awal'],
            'akhir' => $data['akhir'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function savePendapatan(int $idIkm, array $data)
    {
        return DB::table('pendapatan')->insert([
            'id_ikm' => $idIkm,
            'nilai' => $data['nilai'],
            'sumber' => $data['sumber'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function savePengelolaanLimbah(int $idIkm, array $data)
    {
        return DB::table('pengelolaan_limbah')->insertGetId([
            'id_ikm' => $idIkm,
            'jenis_limbah' => $data['jenis_limbah'],
            'jumlah' => $data['jumlah_limbah'],
            'bentuk_pengelolaan' => $data['bentuk_pengelolaan'],
            'parameter' => $data['parameter_limbah'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function saveBentukPengelolaan(int $idLimbah, array $data)
    {
        return DB::table('bentuk_pengelolaan')->insert([
            'id_limbah' => $idLimbah,
            'dikumpulkan_di_tps' => $data['dikumpulkan_di_tps'],
            'dikerjasamakan_dengan_pihak_lain_yang_telah_berizin' => $data['dikerjasamakan_dengan_pihak_lain'], // sesuaikan nama input
            'dimanfaatkan_untuk_internal_industri' => $data['dimanfaatkan_untuk_internal_industri'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


    protected function saveModal(int $idIkm, array $data)
    {
        return DB::table('modal')->insert([
            'id_ikm' => $idIkm,
            'jenis_barang' => $data['jenis_barang'],
            'pembelian_penambahan_perbaikan' => $data['pembelian_penambahan_perbaikan'],
            'pengurangan_barang_modal' => $data['pengurangan_barang_modal'],
            'penyusutan_barang' => $data['penyusutan_barang'],
            'nilai_taksiran' => $data['nilai_taksiran'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }












    public function showHalal()
    {
        return view('admin.bidangIndustri.halal');
    }

    public function showSurat()
    {
        return view('admin.bidangIndustri.suratBalasan');
    }
}
