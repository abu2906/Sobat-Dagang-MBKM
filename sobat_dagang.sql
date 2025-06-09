-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jun 2025 pada 14.29
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sobat_dagang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(191) NOT NULL,
  `id_index_kategori` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `id_index_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Beras Varietas Kristal (Premium)/Kg', 1, NULL, NULL),
(2, 'Beras Varietas Santana (Premium)/Kg', 1, NULL, NULL),
(3, 'Beras Varietas 74 (Premium)/Kg', 1, NULL, NULL),
(4, 'Beras Bulog (Medium)/Kg', 1, NULL, NULL),
(5, 'Beras Varietas Banda (Medium)/Kg', 1, NULL, NULL),
(6, 'Gula Pasir Kristal Putih/Kg', 11, NULL, NULL),
(7, 'Minyak Goreng Tanpa Merek Curah (Sputnik)/Ltr', 12, NULL, NULL),
(8, 'Minyak Goreng Kemasan Sederhana Bantal /Ltr (fortune)', 12, NULL, NULL),
(9, 'Minyak Goreng Kemasan Premium (Bimoli)/ Ltr', 12, NULL, NULL),
(10, 'Minyak Goreng ( Minyak Kita Bantal ) / Ltr', 12, NULL, NULL),
(11, 'Tepung Terigu Kompas/Kg', 13, NULL, NULL),
(12, 'Daging Ayam Broiler/Kg', 3, NULL, NULL),
(13, 'Daging Ayam Kampung/Kg', 3, NULL, NULL),
(14, 'Daging Sapi Paha Depan/Kg', 6, NULL, NULL),
(15, 'Daging Sapi Paha Belakang/Kg', 6, NULL, NULL),
(16, 'Daging Sapi Has Luar (Sirloin)/Kg', 6, NULL, NULL),
(17, 'Daging Sapi Has Dalam (Ternderloin)/Kg', 6, NULL, NULL),
(18, 'Daging Sapi Sandung Lamur (Brisket)/Kg', 6, NULL, NULL),
(19, 'Daging Sapi Tetelan/Kg', 6, NULL, NULL),
(20, 'Daging Sapi Impor Beku/Kg', 6, NULL, NULL),
(21, 'Telur Ayam Ras/Kg', 5, NULL, NULL),
(22, 'Telur Ayam Kampung/Kg', 5, NULL, NULL),
(23, 'Susu Bubuk Balita Dancow Vanila/350gr', 14, NULL, NULL),
(24, 'Susu Bubuk Balita SGM Vanila/400gr', 14, NULL, NULL),
(25, 'Susu Kental Manis Frisian Flag/gr', 14, NULL, NULL),
(26, 'Tahu/Kg', 8, NULL, NULL),
(27, 'Tempe/Kg', 9, NULL, NULL),
(28, 'Bawang Merah (Enrekang)/Kg', 4, NULL, NULL),
(29, 'Bawang Putih (Honan)/Kg', 4, NULL, NULL),
(30, 'Bawang Bombay/kg', 6, NULL, NULL),
(31, 'Ikan Tuna/Kg', 7, NULL, NULL),
(32, 'Ikan Bandeng/Kg', 7, NULL, NULL),
(33, 'Ikan Teri Asin/Kg', 7, NULL, NULL),
(34, 'Ikan Asin/Kg', 7, NULL, NULL),
(35, 'Ikan Cakalang/Kg', 7, NULL, NULL),
(36, 'Ikan Kembung/Kg', 7, NULL, NULL),
(37, 'Garam Bata/Kg', 15, NULL, NULL),
(38, 'Garam Halus/Kg', 15, NULL, NULL),
(39, 'Kedelai Lokal/Kg', 16, NULL, NULL),
(40, 'Kedelai Impor/Kg', 16, NULL, NULL),
(41, 'Mie Instan/Pcs', 17, NULL, NULL),
(42, 'Cabe Merah Keriting/Kg', 2, NULL, NULL),
(43, 'Cabe Merah Besar/Kg', 2, NULL, NULL),
(44, 'Cabe Rawit Merah/Kg', 2, NULL, NULL),
(45, 'Cabe Rawit Hijau/Kg', 2, NULL, NULL),
(46, 'Kacang Tanah/Kg', 18, NULL, NULL),
(47, 'Kacang Hijau/Kg', 18, NULL, NULL),
(48, 'Ubi Ketela Pohon/Kg', 19, NULL, NULL),
(49, 'Jagung Pipilan Kuning/Kg', 20, NULL, NULL),
(50, 'Harga Pupuk Bersubsidi Urea/Kg', 21, NULL, NULL),
(51, 'Harga Pupuk Bersubsidi NPK Phonska/Kg', 21, NULL, NULL),
(52, 'Harga Pupuk Bersubsidi Organik Petroganik/Kg', 21, NULL, NULL),
(53, 'Harga Pupuk Bersubsidi SP-36/Kg', 21, NULL, NULL),
(54, 'Harga Pupuk Bersubsidi ZA/Kg', 21, NULL, NULL),
(55, 'Harga LPG Bersubsidi/3Kg', 22, NULL, NULL),
(56, 'Semen Tonasa/40Kg', 23, NULL, NULL),
(57, 'Semen Bosowa/40Kg', 23, NULL, NULL),
(58, 'Besi Beton 6mm/Btg', 24, NULL, NULL),
(59, 'Besi Beton 8mm/Btg', 24, NULL, NULL),
(60, 'Besi Beton 10mm/Btg', 24, NULL, NULL),
(61, 'Besi Beton 12mm/Btg', 24, NULL, NULL),
(62, 'Baja Ringan/Btg', 25, NULL, NULL),
(63, 'Triplek 6mm/Lmbr', 26, NULL, NULL),
(64, 'Kayu Balok/Btg', 27, NULL, NULL),
(65, 'Kayu Papan/Lmbr', 27, NULL, NULL),
(66, 'Paku 3cm/Kg', 28, NULL, NULL),
(67, 'Paku 4cm/Kg', 28, NULL, NULL),
(68, 'Paku 5cm/Kg', 28, NULL, NULL),
(69, 'Paku 7cm/Kg', 28, NULL, NULL),
(70, 'Paku 10cm/Kg', 28, NULL, NULL),
(71, 'Benih Padi/Kg', 29, NULL, NULL),
(72, 'Benih Jagung/Kg', 29, NULL, NULL),
(73, 'Benih Kedelai/Kg', 29, NULL, NULL),
(74, 'Udang Basah Sedang/kg', 30, NULL, NULL),
(75, 'Jeruk Lokal/kg', 31, NULL, NULL),
(76, 'Pisang Ambon/Sisir', 31, NULL, NULL),
(77, 'Sawi Hijau', 32, NULL, NULL),
(78, 'Tomat', 10, NULL, NULL),
(79, 'Ketimun', 22, NULL, NULL),
(80, 'Kentang', 33, NULL, NULL),
(81, 'Kangkung', 34, NULL, NULL),
(82, 'Kacang Panjang', 35, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_pelaporan`
--

CREATE TABLE `barang_pelaporan` (
  `id_barang_pelaporan` bigint(20) UNSIGNED NOT NULL,
  `id_kategori_barang_pelaporan` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bentuk_pengelolaan_limbah`
--

CREATE TABLE `bentuk_pengelolaan_limbah` (
  `id_bentuk` bigint(20) UNSIGNED NOT NULL,
  `id_ikm` bigint(20) UNSIGNED NOT NULL,
  `jenis_limbah` varchar(191) DEFAULT NULL,
  `jumlah_limbah` double NOT NULL DEFAULT 0,
  `jenis_limbah_b3` varchar(191) DEFAULT NULL,
  `jumlah_limbah_b3` double NOT NULL DEFAULT 0,
  `tps_limbah_b3` varchar(191) DEFAULT NULL,
  `pihak_berizin` varchar(191) DEFAULT NULL,
  `internal_industri` varchar(191) DEFAULT NULL,
  `parameter_limbah_cair` varchar(191) DEFAULT NULL,
  `jumlah_limbah_cair` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` bigint(20) UNSIGNED NOT NULL,
  `id_disdag` bigint(20) UNSIGNED DEFAULT NULL,
  `judul` varchar(191) NOT NULL,
  `isi` text NOT NULL,
  `lampiran` varchar(191) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_alat_ukur`
--

CREATE TABLE `data_alat_ukur` (
  `id_data_alat` bigint(20) UNSIGNED NOT NULL,
  `id_uttp` bigint(20) UNSIGNED NOT NULL,
  `tanggal_exp` date NOT NULL,
  `notifikasi_terkirim` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_ikm`
--

CREATE TABLE `data_ikm` (
  `id_ikm` bigint(20) UNSIGNED NOT NULL,
  `nama_ikm` varchar(191) NOT NULL,
  `luas` varchar(191) NOT NULL,
  `nama_pemilik` varchar(191) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `kecamatan` varchar(191) NOT NULL,
  `kelurahan` varchar(191) NOT NULL,
  `komoditi` varchar(191) NOT NULL,
  `jenis_industri` varchar(191) NOT NULL,
  `alamat` text NOT NULL,
  `nib` varchar(191) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `tenaga_kerja` int(11) NOT NULL,
  `level` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `disdag`
--

CREATE TABLE `disdag` (
  `id_disdag` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(191) NOT NULL,
  `nip` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `telp` varchar(191) DEFAULT NULL,
  `role` enum('master_admin','admin_perdagangan','admin_industri','admin_metrologi','kabid_perdagangan','kabid_industri','kabid_metrologi','kepala_dinas') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `disdag`
--

INSERT INTO `disdag` (`id_disdag`, `password`, `nip`, `email`, `telp`, `role`, `created_at`, `updated_at`) VALUES
(1, '$2y$12$/lWOW.YPtOHrvEB6xKZUcuc5dLTXYbPYKEttngdFXkfE6WH.doZbu', '196501011990031001', 'master_admin@disdag.local', '08123456789', 'master_admin', '2025-06-09 12:25:12', '2025-06-09 12:25:12'),
(2, '$2y$12$AIkF3j9fg/9gnqqQC4m6muK5miZZvuy8y58uayb4sOCCvjP5EaSUu', '197201021993041002', 'admin_perdagangan@disdag.local', '08123456789', 'admin_perdagangan', '2025-06-09 12:25:13', '2025-06-09 12:25:13'),
(3, '$2y$12$R4sM1mqNOk8t5acV6dwlwe9bqwTrw5VUkOO43M.Fmfre/3rkdBe0K', '197305031994051003', 'admin_industri@disdag.local', '08123456789', 'admin_industri', '2025-06-09 12:25:13', '2025-06-09 12:25:13'),
(4, '$2y$12$Ss1Y5K4FJP3NHZ0TVXX17uNLbuRRHNOc99HKl/X0ihuSOdarbV0ra', '197406041995061004', 'admin_metrologi@disdag.local', '08123456789', 'admin_metrologi', '2025-06-09 12:25:14', '2025-06-09 12:25:14'),
(5, '$2y$12$.pqMsDhbrCVOYeFlyNyKB.k.gwdsPCw85tiozOikV0FSYpoNZDrTW', '197507051996071005', 'kabid_perdagangan@disdag.local', '08123456789', 'kabid_perdagangan', '2025-06-09 12:25:15', '2025-06-09 12:25:15'),
(6, '$2y$12$lbUiSbgCWP8JLDlyLwCW7eE/t32WrQjCowpOQO4kgl9xexaeQ9oSa', '197608061997081006', 'kabid_industri@disdag.local', '08123456789', 'kabid_industri', '2025-06-09 12:25:15', '2025-06-09 12:25:15'),
(7, '$2y$12$XWWGwVZy3kplmSdpi36.ROXSQ.4bsxGJ9wuLRXm5PDrzWECU80Mqi', '197709071998091007', 'kabid_metrologi@disdag.local', '08123456789', 'kabid_metrologi', '2025-06-09 12:25:16', '2025-06-09 12:25:16'),
(8, '$2y$12$ac9tl3h9PQ6ouh9Bgu.j2ucbGDgg79oIaPvqMz1CVeGr97241mxZG', '197810081999101008', 'kepala_dinas@disdag.local', '08123456789', 'kepala_dinas', '2025-06-09 12:25:17', '2025-06-09 12:25:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `distributor`
--

CREATE TABLE `distributor` (
  `id_distributor` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nib` varchar(191) NOT NULL,
  `status` enum('menunggu','ditolak','diterima') NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `document_user`
--

CREATE TABLE `document_user` (
  `id_document` bigint(20) UNSIGNED NOT NULL,
  `id_permohonan` char(36) NOT NULL,
  `npwp` varchar(191) DEFAULT NULL,
  `akta_perusahaan` varchar(191) DEFAULT NULL,
  `foto_ktp` varchar(191) DEFAULT NULL,
  `foto_usaha` varchar(191) DEFAULT NULL,
  `dokument_nib` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `faq`
--

CREATE TABLE `faq` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pertanyaan` varchar(191) NOT NULL,
  `jawaban` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `form_permohonan`
--

CREATE TABLE `form_permohonan` (
  `id_permohonan` char(36) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `kecamatan` varchar(191) NOT NULL,
  `kelurahan` varchar(191) NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `jenis_surat` varchar(191) NOT NULL,
  `titik_koordinat` varchar(191) NOT NULL,
  `file_surat` varchar(191) DEFAULT NULL,
  `file_balasan` varchar(191) DEFAULT NULL,
  `status` enum('menunggu','ditolak','diterima','disimpan') NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `forum_diskusi`
--

CREATE TABLE `forum_diskusi` (
  `id_pengaduan` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `id_disdag` bigint(20) UNSIGNED DEFAULT NULL,
  `chat` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `index_harga`
--

CREATE TABLE `index_harga` (
  `id_index` bigint(20) UNSIGNED NOT NULL,
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `id_index_kategori` bigint(20) UNSIGNED NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `tanggal` date NOT NULL,
  `lokasi` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `index_harga`
--

INSERT INTO `index_harga` (`id_index`, `id_barang`, `id_index_kategori`, `harga`, `tanggal`, `lokasi`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 16000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:02', '2025-06-09 12:26:02'),
(2, 2, 1, 13100.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:02', '2025-06-09 12:26:02'),
(3, 3, 1, 13000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:02', '2025-06-09 12:26:02'),
(4, 4, 1, 12000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:02', '2025-06-09 12:26:02'),
(5, 5, 1, 0.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(6, 6, 11, 18000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(7, 7, 12, 17550.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(8, 8, 12, 17000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(9, 9, 12, 20000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(10, 10, 12, 15500.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(11, 11, 13, 10500.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(12, 12, 3, 31400.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(13, 13, 3, 50000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(14, 14, 6, 130000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(15, 15, 6, 130000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(16, 16, 6, 130000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(17, 17, 6, 130000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(18, 18, 6, 130000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(19, 19, 6, 100000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(20, 20, 6, 0.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(21, 21, 5, 29400.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(22, 22, 5, 50000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(23, 23, 14, 42200.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(24, 24, 14, 43800.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:03', '2025-06-09 12:26:03'),
(25, 25, 14, 12500.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:04', '2025-06-09 12:26:04'),
(26, 26, 8, 10000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:04', '2025-06-09 12:26:04'),
(27, 27, 9, 15000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:04', '2025-06-09 12:26:04'),
(28, 28, 4, 38300.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:04', '2025-06-09 12:26:04'),
(29, 29, 4, 45000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:04', '2025-06-09 12:26:04'),
(30, 30, 4, 36700.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:04', '2025-06-09 12:26:04'),
(31, 31, 7, 35000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:04', '2025-06-09 12:26:04'),
(32, 32, 7, 30000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:04', '2025-06-09 12:26:04'),
(33, 33, 7, 95000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:04', '2025-06-09 12:26:04'),
(34, 34, 7, 0.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:04', '2025-06-09 12:26:04'),
(35, 35, 7, 28300.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:04', '2025-06-09 12:26:04'),
(36, 36, 7, 30000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:04', '2025-06-09 12:26:04'),
(37, 37, 15, 0.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:04', '2025-06-09 12:26:04'),
(38, 38, 15, 10000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:04', '2025-06-09 12:26:04'),
(39, 39, 16, 0.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:04', '2025-06-09 12:26:04'),
(40, 40, 16, 13000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:04', '2025-06-09 12:26:04'),
(41, 41, 17, 3000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:04', '2025-06-09 12:26:04'),
(42, 42, 2, 40000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:04', '2025-06-09 12:26:04'),
(43, 43, 2, 37700.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(44, 44, 2, 73300.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(45, 45, 2, 0.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(46, 46, 18, 30000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(47, 47, 18, 20000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(48, 48, 19, 10000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(49, 49, 20, 5000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(50, 50, 21, 2250.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(51, 51, 21, 2300.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(52, 52, 21, 0.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(53, 53, 21, 0.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(54, 54, 21, 1700.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(55, 55, 22, 18500.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(56, 56, 23, 65000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(57, 57, 23, 60000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(58, 58, 24, 35000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(59, 59, 24, 50000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(60, 60, 24, 77000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(61, 61, 24, 105000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:05', '2025-06-09 12:26:05'),
(62, 62, 25, 0.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(63, 63, 26, 65000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(64, 64, 27, 0.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(65, 65, 27, 0.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(66, 66, 28, 20000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(67, 67, 28, 20000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(68, 68, 28, 18000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(69, 69, 28, 18000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(70, 70, 28, 18000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(71, 71, 29, 0.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(72, 72, 29, 0.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(73, 73, 29, 0.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(74, 74, 30, 50000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(75, 75, 31, 10000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(76, 76, 31, 15000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(77, 77, 32, 10000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(78, 78, 10, 14000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(79, 79, 22, 25000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(80, 80, 33, 10000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:06', '2025-06-09 12:26:06'),
(81, 81, 34, 15000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:07', '2025-06-09 12:26:07'),
(82, 82, 35, 10000.00, '2025-06-09', 'Pasar Sumpang', '2025-06-09 12:26:07', '2025-06-09 12:26:07'),
(83, 1, 1, 16000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:07', '2025-06-09 12:26:07'),
(84, 2, 1, 13100.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:07', '2025-06-09 12:26:07'),
(85, 3, 1, 13000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:07', '2025-06-09 12:26:07'),
(86, 4, 1, 12000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:07', '2025-06-09 12:26:07'),
(87, 5, 1, 0.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:07', '2025-06-09 12:26:07'),
(88, 6, 11, 18000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:07', '2025-06-09 12:26:07'),
(89, 7, 12, 17550.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:07', '2025-06-09 12:26:07'),
(90, 8, 12, 17000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:07', '2025-06-09 12:26:07'),
(91, 9, 12, 20000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:07', '2025-06-09 12:26:07'),
(92, 10, 12, 15500.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:07', '2025-06-09 12:26:07'),
(93, 11, 13, 10500.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:07', '2025-06-09 12:26:07'),
(94, 12, 3, 31400.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:07', '2025-06-09 12:26:07'),
(95, 13, 3, 50000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:07', '2025-06-09 12:26:07'),
(96, 14, 6, 130000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:07', '2025-06-09 12:26:07'),
(97, 15, 6, 130000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:07', '2025-06-09 12:26:07'),
(98, 16, 6, 130000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:07', '2025-06-09 12:26:07'),
(99, 17, 6, 130000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:08', '2025-06-09 12:26:08'),
(100, 18, 6, 130000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(101, 19, 6, 100000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(102, 20, 6, 0.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(103, 21, 5, 29400.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(104, 22, 5, 50000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(105, 23, 14, 42200.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(106, 24, 14, 43800.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(107, 25, 14, 12500.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(108, 26, 8, 10000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(109, 27, 9, 15000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(110, 28, 4, 38300.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(111, 29, 4, 45000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(112, 30, 4, 36700.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(113, 31, 7, 35000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(114, 32, 7, 30000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(115, 33, 7, 95000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(116, 34, 7, 0.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(117, 35, 7, 28300.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(118, 36, 7, 30000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(119, 37, 15, 0.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(120, 38, 15, 10000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:09', '2025-06-09 12:26:09'),
(121, 39, 16, 0.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:10', '2025-06-09 12:26:10'),
(122, 40, 16, 13000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:10', '2025-06-09 12:26:10'),
(123, 41, 17, 3000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:10', '2025-06-09 12:26:10'),
(124, 42, 2, 40000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:10', '2025-06-09 12:26:10'),
(125, 43, 2, 37700.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:10', '2025-06-09 12:26:10'),
(126, 44, 2, 73300.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:10', '2025-06-09 12:26:10'),
(127, 45, 2, 0.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:10', '2025-06-09 12:26:10'),
(128, 46, 18, 30000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:10', '2025-06-09 12:26:10'),
(129, 47, 18, 20000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:10', '2025-06-09 12:26:10'),
(130, 48, 19, 10000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:10', '2025-06-09 12:26:10'),
(131, 49, 20, 5000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:10', '2025-06-09 12:26:10'),
(132, 50, 21, 2250.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:10', '2025-06-09 12:26:10'),
(133, 51, 21, 2300.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:10', '2025-06-09 12:26:10'),
(134, 52, 21, 0.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:10', '2025-06-09 12:26:10'),
(135, 53, 21, 0.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:10', '2025-06-09 12:26:10'),
(136, 54, 21, 1700.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:10', '2025-06-09 12:26:10'),
(137, 55, 22, 18500.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:10', '2025-06-09 12:26:10'),
(138, 56, 23, 65000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:10', '2025-06-09 12:26:10'),
(139, 57, 23, 60000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(140, 58, 24, 35000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(141, 59, 24, 50000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(142, 60, 24, 77000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(143, 61, 24, 105000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(144, 62, 25, 0.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(145, 63, 26, 65000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(146, 64, 27, 0.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(147, 65, 27, 0.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(148, 66, 28, 20000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(149, 67, 28, 20000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(150, 68, 28, 18000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(151, 69, 28, 18000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(152, 70, 28, 18000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(153, 71, 29, 0.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(154, 72, 29, 0.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(155, 73, 29, 0.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(156, 74, 30, 50000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(157, 75, 31, 10000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(158, 76, 31, 15000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(159, 77, 32, 10000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:11', '2025-06-09 12:26:11'),
(160, 78, 10, 14000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:12', '2025-06-09 12:26:12'),
(161, 79, 22, 25000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:12', '2025-06-09 12:26:12'),
(162, 80, 33, 10000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:12', '2025-06-09 12:26:12'),
(163, 81, 34, 15000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:12', '2025-06-09 12:26:12'),
(164, 82, 35, 10000.00, '2025-06-09', 'Pasar Lakessi', '2025-06-09 12:26:12', '2025-06-09 12:26:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `index_kategori`
--

CREATE TABLE `index_kategori` (
  `id_index_kategori` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `index_kategori`
--

INSERT INTO `index_kategori` (`id_index_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Beras', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(2, 'Cabe', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(3, 'Ayam', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(4, 'Bawang', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(5, 'Telur', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(6, 'Daging', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(7, 'Ikan', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(8, 'Tahu', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(9, 'Tempe', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(10, 'Tomat', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(11, 'Gula', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(12, 'Minyak Goreng', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(13, 'Tepung', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(14, 'Susu', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(15, 'Garam', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(16, 'Kedelai', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(17, 'Mie Instan', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(18, 'Kacang', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(19, 'Ubi Ketela', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(20, 'Jagung Pipilan', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(21, 'Pupuk Bersubsidi', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(22, 'LPG Bersubsidi', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(23, 'Semen', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(24, 'Besi Beton', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(25, 'Baja Ringan', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(26, 'Triplek', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(27, 'Kayu', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(28, 'Paku', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(29, 'Benih', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(30, 'Udang Basah', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(31, 'Buah-buahan', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(32, 'Sayuran', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(33, 'Kentang', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(34, 'Kangkung', '2025-06-09 12:25:43', '2025-06-09 12:25:43'),
(35, 'Kacang Panjang', '2025-06-09 12:25:43', '2025-06-09 12:25:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` bigint(20) UNSIGNED NOT NULL,
  `id_ikm` bigint(20) UNSIGNED NOT NULL,
  `tenaga_kerja_tetap` int(11) NOT NULL,
  `tenaga_kerja_tidak_tetap` int(11) NOT NULL,
  `tenaga_kerja_laki_laki` int(11) NOT NULL,
  `tenaga_kerja_perempuan` int(11) NOT NULL,
  `sd` int(11) NOT NULL,
  `smp` int(11) NOT NULL,
  `sma_smk` int(11) NOT NULL,
  `d1_d3` int(11) NOT NULL,
  `s1_d4` int(11) NOT NULL,
  `s2` int(11) NOT NULL,
  `s3` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_barang_pelaporan`
--

CREATE TABLE `kategori_barang_pelaporan` (
  `id_kategori_barang_pelaporan` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `listrik`
--

CREATE TABLE `listrik` (
  `id_listrik` bigint(20) UNSIGNED NOT NULL,
  `id_ikm` bigint(20) UNSIGNED NOT NULL,
  `sumber` varchar(191) NOT NULL,
  `banyaknya` double NOT NULL DEFAULT 0,
  `nilai` bigint(20) NOT NULL DEFAULT 0,
  `peruntukkan` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mesin_produksi`
--

CREATE TABLE `mesin_produksi` (
  `id_mesin` bigint(20) UNSIGNED NOT NULL,
  `id_ikm` bigint(20) UNSIGNED NOT NULL,
  `jenis_mesin` varchar(191) NOT NULL,
  `nama_mesin` varchar(191) NOT NULL,
  `merk_type` varchar(191) NOT NULL,
  `teknologi` varchar(191) NOT NULL,
  `negara_pembuat` varchar(191) NOT NULL,
  `tahun_perolehan` int(11) NOT NULL,
  `tahun_pembuatan` int(11) NOT NULL,
  `jumlah_unit` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_26_164150_create_disdag_table', 1),
(5, '2025_04_26_164536_create_berita_table', 1),
(6, '2025_04_27_154301_create_user_table', 1),
(7, '2025_04_28_120000_create_uttp_table', 1),
(8, '2025_04_28_121746_create_data_alat_ukur_table', 1),
(9, '2025_05_01_125413_create_distributor_table', 1),
(10, '2025_05_01_132307_create_kategori_barang_pelaporan_table', 1),
(11, '2025_05_01_132610_create_barang_pelaporan_table', 1),
(12, '2025_05_01_133122_create_rencana_kebutuhan_distributor_table', 1),
(13, '2025_05_01_133603_create_toko_table', 1),
(14, '2025_05_01_134203_create_stok_opname_table', 1),
(15, '2025_05_04_150736_create_index_kategori_table', 1),
(16, '2025_05_05_144358_create_barang_table', 1),
(17, '2025_05_05_151323_create_index_harga_table', 1),
(18, '2025_05_07_132826_create_form_permohonan_table', 1),
(19, '2025_05_07_134534_create_document_user_table', 1),
(20, '2025_05_08_234441_surat_metrologi', 1),
(21, '2025_05_12_214739_create_forum_diskusi_table', 1),
(22, '2025_05_16_224304_surat_balasan_metrologi', 1),
(23, '2025_05_18_160950_create_data_ikm_table', 1),
(24, '2025_05_18_161024_create_persentase_pemilik_table', 1),
(25, '2025_05_18_161125_create_karyawan_table', 1),
(26, '2025_05_18_161524_create_pemakaian_bahan_table', 1),
(27, '2025_05_18_161753_create_penggunaan_air_table', 1),
(28, '2025_05_18_162001_create_pengeluaran_table', 1),
(29, '2025_05_18_164222_create_penggunaan_bahan_bakar_table', 1),
(30, '2025_05_18_165530_create_listrik_table', 1),
(31, '2025_05_18_165840_create_mesin_produksi_table', 1),
(32, '2025_05_18_170434_create_produksi_table', 1),
(33, '2025_05_18_170651_create_persediaan_table', 1),
(34, '2025_05_18_170753_create_pendapatan_table', 1),
(35, '2025_05_18_170918_create_modal_table', 1),
(36, '2025_05_18_171042_create_bentuk_pengelolaan_limbah_table', 1),
(37, '2025_05_20_123024_create_sertifikasi_halal_table', 1),
(38, '2025_05_26_194815_create_faq_table', 1),
(39, '2025_05_28_062844_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `modal`
--

CREATE TABLE `modal` (
  `id_modal` bigint(20) UNSIGNED NOT NULL,
  `id_ikm` bigint(20) UNSIGNED NOT NULL,
  `jenis_barang` varchar(191) NOT NULL,
  `pembelian_penambahan_perbaikan` bigint(20) NOT NULL DEFAULT 0,
  `pengurangan_barang_modal` bigint(20) NOT NULL DEFAULT 0,
  `penyusutan_barang` bigint(20) NOT NULL DEFAULT 0,
  `nilai_taksiran` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemakaian_bahan`
--

CREATE TABLE `pemakaian_bahan` (
  `id_pemakaian_bahan` bigint(20) UNSIGNED NOT NULL,
  `id_ikm` bigint(20) UNSIGNED NOT NULL,
  `nama_bahan` varchar(191) NOT NULL,
  `jenis_bahan` varchar(191) NOT NULL,
  `spesifikasi` varchar(191) NOT NULL,
  `kode_hs` varchar(191) NOT NULL,
  `satuan_standar` varchar(191) NOT NULL,
  `jumlah_dalam_negeri` int(11) NOT NULL,
  `nilai_dalam_negeri` bigint(20) NOT NULL,
  `jumlah_impor` int(11) NOT NULL,
  `nilai_impor` bigint(20) NOT NULL,
  `negara_asal_impor` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendapatan`
--

CREATE TABLE `pendapatan` (
  `id_pendapatan` bigint(20) UNSIGNED NOT NULL,
  `id_ikm` bigint(20) UNSIGNED NOT NULL,
  `nilai` bigint(20) NOT NULL DEFAULT 0,
  `sumber` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` bigint(20) UNSIGNED NOT NULL,
  `id_ikm` bigint(20) UNSIGNED NOT NULL,
  `upah_gaji` bigint(20) NOT NULL DEFAULT 0,
  `pengeluaran_industri_distribusi` bigint(20) NOT NULL DEFAULT 0,
  `pengeluaran_rnd` bigint(20) NOT NULL DEFAULT 0,
  `pengeluaran_tanah` bigint(20) NOT NULL DEFAULT 0,
  `pengeluaran_gedung` bigint(20) NOT NULL DEFAULT 0,
  `pengeluaran_mesin` bigint(20) NOT NULL DEFAULT 0,
  `lainnya` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaan_air`
--

CREATE TABLE `penggunaan_air` (
  `id_air` bigint(20) UNSIGNED NOT NULL,
  `id_ikm` bigint(20) UNSIGNED NOT NULL,
  `sumber_air` varchar(191) NOT NULL,
  `banyaknya_penggunaan_m3` double NOT NULL DEFAULT 0,
  `biaya` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaan_bahan_bakar`
--

CREATE TABLE `penggunaan_bahan_bakar` (
  `id_bahan_bakar` bigint(20) UNSIGNED NOT NULL,
  `id_ikm` bigint(20) UNSIGNED NOT NULL,
  `jenis_bahan_bakar` varchar(191) NOT NULL,
  `satuan_standar` varchar(191) NOT NULL,
  `banyaknya_proses_produksi` double NOT NULL DEFAULT 0,
  `nilai_proses_produksi` bigint(20) NOT NULL DEFAULT 0,
  `banyaknya_pembangkit_tenaga_listrik` double NOT NULL DEFAULT 0,
  `nilai_pembangkit_tenaga_listrik` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `persediaan`
--

CREATE TABLE `persediaan` (
  `id_persediaan` bigint(20) UNSIGNED NOT NULL,
  `id_ikm` bigint(20) UNSIGNED NOT NULL,
  `jenis_persediaan` varchar(191) NOT NULL,
  `awal` bigint(20) NOT NULL DEFAULT 0,
  `akhir` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `persentase_pemilik`
--

CREATE TABLE `persentase_pemilik` (
  `id_persentase` bigint(20) UNSIGNED NOT NULL,
  `id_ikm` bigint(20) UNSIGNED NOT NULL,
  `pemerintah_pusat` decimal(5,2) NOT NULL,
  `pemerintah_daerah` decimal(5,2) NOT NULL,
  `swasta_nasional` decimal(5,2) NOT NULL,
  `asing` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produksi`
--

CREATE TABLE `produksi` (
  `id_produksi` bigint(20) UNSIGNED NOT NULL,
  `id_ikm` bigint(20) UNSIGNED NOT NULL,
  `jenis_produksi` varchar(191) NOT NULL,
  `kbli` varchar(191) NOT NULL,
  `kode_hs` varchar(191) NOT NULL,
  `spesifikasi` varchar(191) NOT NULL,
  `banyaknya` int(11) NOT NULL DEFAULT 0,
  `nilai` bigint(20) NOT NULL DEFAULT 0,
  `satuan` varchar(191) NOT NULL,
  `presentase_produk_ekspor` double NOT NULL DEFAULT 0,
  `negara_tujuan_ekspor` varchar(191) DEFAULT NULL,
  `kapasitas_terpasang_per_tahun` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rencana_kebutuhan_distributor`
--

CREATE TABLE `rencana_kebutuhan_distributor` (
  `id_rancangan` bigint(20) UNSIGNED NOT NULL,
  `id_barang_pelaporan` bigint(20) UNSIGNED DEFAULT NULL,
  `tahun` year(4) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sertifikasi_halal`
--

CREATE TABLE `sertifikasi_halal` (
  `id_halal` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `id_ikm` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_usaha` varchar(191) NOT NULL,
  `alamat` text NOT NULL,
  `no_sertifikasi_halal` varchar(191) NOT NULL,
  `tanggal_sah` date NOT NULL,
  `tanggal_exp` date NOT NULL,
  `sertifikat` varchar(191) DEFAULT NULL,
  `status` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_opname`
--

CREATE TABLE `stok_opname` (
  `id_stok_opname` bigint(20) UNSIGNED NOT NULL,
  `id_distributor` bigint(20) UNSIGNED NOT NULL,
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `stok_awal` int(11) NOT NULL,
  `penyaluran` int(11) NOT NULL,
  `stok_akhir` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_barang` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluar_metrologi`
--

CREATE TABLE `surat_keluar_metrologi` (
  `id_surat_balasan` varchar(191) NOT NULL,
  `id_surat` varchar(191) NOT NULL,
  `tanggal` varchar(191) NOT NULL,
  `path_dokumen` varchar(191) DEFAULT NULL,
  `isi_surat` text DEFAULT NULL,
  `status_surat_keluar` enum('Menunggu','Disetujui','Ditolak','Draft') NOT NULL DEFAULT 'Menunggu',
  `status_kepalaBidang` enum('Menunggu','Disetujui','Ditolak','Draft') NOT NULL DEFAULT 'Menunggu',
  `status_kadis` enum('Menunggu','Disetujui','Ditolak') NOT NULL DEFAULT 'Menunggu',
  `keterangan_kadis` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_metrologi`
--

CREATE TABLE `surat_metrologi` (
  `id_surat` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `alamat_alat` varchar(191) DEFAULT NULL,
  `jenis_surat` enum('tera','tera_ulang') NOT NULL DEFAULT 'tera',
  `dokumen` varchar(191) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status_surat_masuk` enum('Menunggu','Disetujui','Ditolak') NOT NULL DEFAULT 'Menunggu',
  `status_admin` enum('Menunggu','Diproses','Ditolak','Menunggu Persetujuan','Diterima','Butuh Revisi','Selesai') NOT NULL DEFAULT 'Menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id_toko` bigint(20) UNSIGNED NOT NULL,
  `id_rancangan` bigint(20) UNSIGNED NOT NULL,
  `id_distributor` bigint(20) UNSIGNED NOT NULL,
  `nama_toko` varchar(191) NOT NULL,
  `no_register` varchar(191) NOT NULL,
  `kecamatan` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `kecamatan` varchar(191) NOT NULL,
  `kelurahan` varchar(191) NOT NULL,
  `kabupaten` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `nik` varchar(191) NOT NULL,
  `nib` varchar(191) DEFAULT NULL,
  `nama` varchar(191) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `telp` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `avatar` varchar(191) DEFAULT 'assets/img/profil.jpeg',
  `verifikasi_token` varchar(191) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `uttp`
--

CREATE TABLE `uttp` (
  `id_uttp` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_penginputan` date DEFAULT NULL,
  `no_registrasi` varchar(191) DEFAULT NULL,
  `nama_usaha` varchar(191) DEFAULT NULL,
  `jenis_alat` varchar(191) DEFAULT NULL,
  `nama_alat` varchar(191) DEFAULT NULL,
  `merk_type` varchar(191) DEFAULT NULL,
  `nomor_seri` varchar(191) DEFAULT NULL,
  `jumlah_alat` int(11) DEFAULT NULL,
  `alat_penguji` varchar(191) DEFAULT NULL,
  `ctt` varchar(191) DEFAULT NULL,
  `spt_keperluan` varchar(191) DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `terapan` varchar(191) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `sertifikat_path` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `barang_id_index_kategori_foreign` (`id_index_kategori`);

--
-- Indeks untuk tabel `barang_pelaporan`
--
ALTER TABLE `barang_pelaporan`
  ADD PRIMARY KEY (`id_barang_pelaporan`),
  ADD KEY `barang_pelaporan_id_kategori_barang_pelaporan_foreign` (`id_kategori_barang_pelaporan`);

--
-- Indeks untuk tabel `bentuk_pengelolaan_limbah`
--
ALTER TABLE `bentuk_pengelolaan_limbah`
  ADD PRIMARY KEY (`id_bentuk`),
  ADD KEY `bentuk_pengelolaan_limbah_id_ikm_foreign` (`id_ikm`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`),
  ADD KEY `berita_id_disdag_foreign` (`id_disdag`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `data_alat_ukur`
--
ALTER TABLE `data_alat_ukur`
  ADD PRIMARY KEY (`id_data_alat`),
  ADD KEY `data_alat_ukur_id_uttp_foreign` (`id_uttp`);

--
-- Indeks untuk tabel `data_ikm`
--
ALTER TABLE `data_ikm`
  ADD PRIMARY KEY (`id_ikm`);

--
-- Indeks untuk tabel `disdag`
--
ALTER TABLE `disdag`
  ADD PRIMARY KEY (`id_disdag`),
  ADD UNIQUE KEY `disdag_nip_unique` (`nip`),
  ADD UNIQUE KEY `disdag_email_unique` (`email`);

--
-- Indeks untuk tabel `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`id_distributor`),
  ADD KEY `distributor_id_user_foreign` (`id_user`);

--
-- Indeks untuk tabel `document_user`
--
ALTER TABLE `document_user`
  ADD PRIMARY KEY (`id_document`),
  ADD KEY `document_user_id_permohonan_foreign` (`id_permohonan`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `form_permohonan`
--
ALTER TABLE `form_permohonan`
  ADD PRIMARY KEY (`id_permohonan`),
  ADD KEY `form_permohonan_id_user_foreign` (`id_user`);

--
-- Indeks untuk tabel `forum_diskusi`
--
ALTER TABLE `forum_diskusi`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `forum_diskusi_id_user_foreign` (`id_user`),
  ADD KEY `forum_diskusi_id_disdag_foreign` (`id_disdag`);

--
-- Indeks untuk tabel `index_harga`
--
ALTER TABLE `index_harga`
  ADD PRIMARY KEY (`id_index`),
  ADD KEY `index_harga_id_barang_foreign` (`id_barang`),
  ADD KEY `index_harga_id_index_kategori_foreign` (`id_index_kategori`);

--
-- Indeks untuk tabel `index_kategori`
--
ALTER TABLE `index_kategori`
  ADD PRIMARY KEY (`id_index_kategori`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `karyawan_id_ikm_foreign` (`id_ikm`);

--
-- Indeks untuk tabel `kategori_barang_pelaporan`
--
ALTER TABLE `kategori_barang_pelaporan`
  ADD PRIMARY KEY (`id_kategori_barang_pelaporan`);

--
-- Indeks untuk tabel `listrik`
--
ALTER TABLE `listrik`
  ADD PRIMARY KEY (`id_listrik`),
  ADD KEY `listrik_id_ikm_foreign` (`id_ikm`);

--
-- Indeks untuk tabel `mesin_produksi`
--
ALTER TABLE `mesin_produksi`
  ADD PRIMARY KEY (`id_mesin`),
  ADD KEY `mesin_produksi_id_ikm_foreign` (`id_ikm`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `modal`
--
ALTER TABLE `modal`
  ADD PRIMARY KEY (`id_modal`),
  ADD KEY `modal_id_ikm_foreign` (`id_ikm`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pemakaian_bahan`
--
ALTER TABLE `pemakaian_bahan`
  ADD PRIMARY KEY (`id_pemakaian_bahan`),
  ADD KEY `pemakaian_bahan_id_ikm_foreign` (`id_ikm`);

--
-- Indeks untuk tabel `pendapatan`
--
ALTER TABLE `pendapatan`
  ADD PRIMARY KEY (`id_pendapatan`),
  ADD KEY `pendapatan_id_ikm_foreign` (`id_ikm`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `pengeluaran_id_ikm_foreign` (`id_ikm`);

--
-- Indeks untuk tabel `penggunaan_air`
--
ALTER TABLE `penggunaan_air`
  ADD PRIMARY KEY (`id_air`),
  ADD KEY `penggunaan_air_id_ikm_foreign` (`id_ikm`);

--
-- Indeks untuk tabel `penggunaan_bahan_bakar`
--
ALTER TABLE `penggunaan_bahan_bakar`
  ADD PRIMARY KEY (`id_bahan_bakar`),
  ADD KEY `penggunaan_bahan_bakar_id_ikm_foreign` (`id_ikm`);

--
-- Indeks untuk tabel `persediaan`
--
ALTER TABLE `persediaan`
  ADD PRIMARY KEY (`id_persediaan`),
  ADD KEY `persediaan_id_ikm_foreign` (`id_ikm`);

--
-- Indeks untuk tabel `persentase_pemilik`
--
ALTER TABLE `persentase_pemilik`
  ADD PRIMARY KEY (`id_persentase`),
  ADD KEY `persentase_pemilik_id_ikm_foreign` (`id_ikm`);

--
-- Indeks untuk tabel `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id_produksi`),
  ADD KEY `produksi_id_ikm_foreign` (`id_ikm`);

--
-- Indeks untuk tabel `rencana_kebutuhan_distributor`
--
ALTER TABLE `rencana_kebutuhan_distributor`
  ADD PRIMARY KEY (`id_rancangan`),
  ADD KEY `rencana_kebutuhan_distributor_id_barang_pelaporan_foreign` (`id_barang_pelaporan`);

--
-- Indeks untuk tabel `sertifikasi_halal`
--
ALTER TABLE `sertifikasi_halal`
  ADD PRIMARY KEY (`id_halal`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `stok_opname`
--
ALTER TABLE `stok_opname`
  ADD PRIMARY KEY (`id_stok_opname`),
  ADD KEY `stok_opname_id_distributor_foreign` (`id_distributor`),
  ADD KEY `stok_opname_id_toko_foreign` (`id_toko`);

--
-- Indeks untuk tabel `surat_keluar_metrologi`
--
ALTER TABLE `surat_keluar_metrologi`
  ADD PRIMARY KEY (`id_surat_balasan`),
  ADD KEY `surat_keluar_metrologi_id_surat_foreign` (`id_surat`);

--
-- Indeks untuk tabel `surat_metrologi`
--
ALTER TABLE `surat_metrologi`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `surat_metrologi_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`),
  ADD KEY `toko_id_rancangan_foreign` (`id_rancangan`),
  ADD KEY `toko_id_distributor_foreign` (`id_distributor`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_nik_unique` (`nik`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `uttp`
--
ALTER TABLE `uttp`
  ADD PRIMARY KEY (`id_uttp`),
  ADD KEY `uttp_id_user_foreign` (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT untuk tabel `barang_pelaporan`
--
ALTER TABLE `barang_pelaporan`
  MODIFY `id_barang_pelaporan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bentuk_pengelolaan_limbah`
--
ALTER TABLE `bentuk_pengelolaan_limbah`
  MODIFY `id_bentuk` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_alat_ukur`
--
ALTER TABLE `data_alat_ukur`
  MODIFY `id_data_alat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_ikm`
--
ALTER TABLE `data_ikm`
  MODIFY `id_ikm` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `disdag`
--
ALTER TABLE `disdag`
  MODIFY `id_disdag` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `distributor`
--
ALTER TABLE `distributor`
  MODIFY `id_distributor` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `document_user`
--
ALTER TABLE `document_user`
  MODIFY `id_document` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `faq`
--
ALTER TABLE `faq`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `forum_diskusi`
--
ALTER TABLE `forum_diskusi`
  MODIFY `id_pengaduan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `index_harga`
--
ALTER TABLE `index_harga`
  MODIFY `id_index` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT untuk tabel `index_kategori`
--
ALTER TABLE `index_kategori`
  MODIFY `id_index_kategori` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_barang_pelaporan`
--
ALTER TABLE `kategori_barang_pelaporan`
  MODIFY `id_kategori_barang_pelaporan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `listrik`
--
ALTER TABLE `listrik`
  MODIFY `id_listrik` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mesin_produksi`
--
ALTER TABLE `mesin_produksi`
  MODIFY `id_mesin` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `modal`
--
ALTER TABLE `modal`
  MODIFY `id_modal` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemakaian_bahan`
--
ALTER TABLE `pemakaian_bahan`
  MODIFY `id_pemakaian_bahan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pendapatan`
--
ALTER TABLE `pendapatan`
  MODIFY `id_pendapatan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penggunaan_air`
--
ALTER TABLE `penggunaan_air`
  MODIFY `id_air` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penggunaan_bahan_bakar`
--
ALTER TABLE `penggunaan_bahan_bakar`
  MODIFY `id_bahan_bakar` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `persediaan`
--
ALTER TABLE `persediaan`
  MODIFY `id_persediaan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `persentase_pemilik`
--
ALTER TABLE `persentase_pemilik`
  MODIFY `id_persentase` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id_produksi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rencana_kebutuhan_distributor`
--
ALTER TABLE `rencana_kebutuhan_distributor`
  MODIFY `id_rancangan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sertifikasi_halal`
--
ALTER TABLE `sertifikasi_halal`
  MODIFY `id_halal` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `stok_opname`
--
ALTER TABLE `stok_opname`
  MODIFY `id_stok_opname` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `uttp`
--
ALTER TABLE `uttp`
  MODIFY `id_uttp` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_id_index_kategori_foreign` FOREIGN KEY (`id_index_kategori`) REFERENCES `index_kategori` (`id_index_kategori`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_pelaporan`
--
ALTER TABLE `barang_pelaporan`
  ADD CONSTRAINT `barang_pelaporan_id_kategori_barang_pelaporan_foreign` FOREIGN KEY (`id_kategori_barang_pelaporan`) REFERENCES `kategori_barang_pelaporan` (`id_kategori_barang_pelaporan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bentuk_pengelolaan_limbah`
--
ALTER TABLE `bentuk_pengelolaan_limbah`
  ADD CONSTRAINT `bentuk_pengelolaan_limbah_id_ikm_foreign` FOREIGN KEY (`id_ikm`) REFERENCES `data_ikm` (`id_ikm`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_id_disdag_foreign` FOREIGN KEY (`id_disdag`) REFERENCES `disdag` (`id_disdag`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_alat_ukur`
--
ALTER TABLE `data_alat_ukur`
  ADD CONSTRAINT `data_alat_ukur_id_uttp_foreign` FOREIGN KEY (`id_uttp`) REFERENCES `uttp` (`id_uttp`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `distributor`
--
ALTER TABLE `distributor`
  ADD CONSTRAINT `distributor_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `document_user`
--
ALTER TABLE `document_user`
  ADD CONSTRAINT `document_user_id_permohonan_foreign` FOREIGN KEY (`id_permohonan`) REFERENCES `form_permohonan` (`id_permohonan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `form_permohonan`
--
ALTER TABLE `form_permohonan`
  ADD CONSTRAINT `form_permohonan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `forum_diskusi`
--
ALTER TABLE `forum_diskusi`
  ADD CONSTRAINT `forum_diskusi_id_disdag_foreign` FOREIGN KEY (`id_disdag`) REFERENCES `disdag` (`id_disdag`) ON DELETE CASCADE,
  ADD CONSTRAINT `forum_diskusi_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `index_harga`
--
ALTER TABLE `index_harga`
  ADD CONSTRAINT `index_harga_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `index_harga_id_index_kategori_foreign` FOREIGN KEY (`id_index_kategori`) REFERENCES `index_kategori` (`id_index_kategori`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_id_ikm_foreign` FOREIGN KEY (`id_ikm`) REFERENCES `data_ikm` (`id_ikm`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `listrik`
--
ALTER TABLE `listrik`
  ADD CONSTRAINT `listrik_id_ikm_foreign` FOREIGN KEY (`id_ikm`) REFERENCES `data_ikm` (`id_ikm`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mesin_produksi`
--
ALTER TABLE `mesin_produksi`
  ADD CONSTRAINT `mesin_produksi_id_ikm_foreign` FOREIGN KEY (`id_ikm`) REFERENCES `data_ikm` (`id_ikm`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `modal`
--
ALTER TABLE `modal`
  ADD CONSTRAINT `modal_id_ikm_foreign` FOREIGN KEY (`id_ikm`) REFERENCES `data_ikm` (`id_ikm`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemakaian_bahan`
--
ALTER TABLE `pemakaian_bahan`
  ADD CONSTRAINT `pemakaian_bahan_id_ikm_foreign` FOREIGN KEY (`id_ikm`) REFERENCES `data_ikm` (`id_ikm`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pendapatan`
--
ALTER TABLE `pendapatan`
  ADD CONSTRAINT `pendapatan_id_ikm_foreign` FOREIGN KEY (`id_ikm`) REFERENCES `data_ikm` (`id_ikm`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_id_ikm_foreign` FOREIGN KEY (`id_ikm`) REFERENCES `data_ikm` (`id_ikm`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penggunaan_air`
--
ALTER TABLE `penggunaan_air`
  ADD CONSTRAINT `penggunaan_air_id_ikm_foreign` FOREIGN KEY (`id_ikm`) REFERENCES `data_ikm` (`id_ikm`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penggunaan_bahan_bakar`
--
ALTER TABLE `penggunaan_bahan_bakar`
  ADD CONSTRAINT `penggunaan_bahan_bakar_id_ikm_foreign` FOREIGN KEY (`id_ikm`) REFERENCES `data_ikm` (`id_ikm`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `persediaan`
--
ALTER TABLE `persediaan`
  ADD CONSTRAINT `persediaan_id_ikm_foreign` FOREIGN KEY (`id_ikm`) REFERENCES `data_ikm` (`id_ikm`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `persentase_pemilik`
--
ALTER TABLE `persentase_pemilik`
  ADD CONSTRAINT `persentase_pemilik_id_ikm_foreign` FOREIGN KEY (`id_ikm`) REFERENCES `data_ikm` (`id_ikm`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produksi`
--
ALTER TABLE `produksi`
  ADD CONSTRAINT `produksi_id_ikm_foreign` FOREIGN KEY (`id_ikm`) REFERENCES `data_ikm` (`id_ikm`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rencana_kebutuhan_distributor`
--
ALTER TABLE `rencana_kebutuhan_distributor`
  ADD CONSTRAINT `rencana_kebutuhan_distributor_id_barang_pelaporan_foreign` FOREIGN KEY (`id_barang_pelaporan`) REFERENCES `barang_pelaporan` (`id_barang_pelaporan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stok_opname`
--
ALTER TABLE `stok_opname`
  ADD CONSTRAINT `stok_opname_id_distributor_foreign` FOREIGN KEY (`id_distributor`) REFERENCES `distributor` (`id_distributor`) ON DELETE CASCADE,
  ADD CONSTRAINT `stok_opname_id_toko_foreign` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `surat_keluar_metrologi`
--
ALTER TABLE `surat_keluar_metrologi`
  ADD CONSTRAINT `surat_keluar_metrologi_id_surat_foreign` FOREIGN KEY (`id_surat`) REFERENCES `surat_metrologi` (`id_surat`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `surat_metrologi`
--
ALTER TABLE `surat_metrologi`
  ADD CONSTRAINT `surat_metrologi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD CONSTRAINT `toko_id_distributor_foreign` FOREIGN KEY (`id_distributor`) REFERENCES `distributor` (`id_distributor`) ON DELETE CASCADE,
  ADD CONSTRAINT `toko_id_rancangan_foreign` FOREIGN KEY (`id_rancangan`) REFERENCES `rencana_kebutuhan_distributor` (`id_rancangan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `uttp`
--
ALTER TABLE `uttp`
  ADD CONSTRAINT `uttp_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;