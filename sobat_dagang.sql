-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Bulan Mei 2025 pada 15.43
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
-- Database: `sobat-dagang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alat_tera`
--

CREATE TABLE `alat_tera` (
  `id_alat_tera` bigint(20) UNSIGNED NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `nama_alat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `id_index_kategori` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `id_index_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Beras Premium', 1, NULL, NULL),
(2, 'Beras Medium', 1, NULL, NULL),
(3, 'Beras Merah', 1, NULL, NULL),
(4, 'Cabe Merah Keriting', 2, NULL, NULL),
(5, 'Cabe Rawit Merah', 2, NULL, NULL),
(6, 'Cabe Hijau', 2, NULL, NULL),
(7, 'Ayam Broiler', 3, NULL, NULL),
(8, 'Ayam Kampung', 3, NULL, NULL),
(9, 'Daging Ayam Fillet', 3, NULL, NULL),
(10, 'Bawang Merah', 4, NULL, NULL),
(11, 'Bawang Putih', 4, NULL, NULL),
(12, 'Bawang Bombay', 4, NULL, NULL),
(13, 'Telur Ayam Ras', 5, NULL, NULL),
(14, 'Telur Bebek', 5, NULL, NULL),
(15, 'Telur Omega 3', 5, NULL, NULL),
(16, 'Daging Sapi Has Dalam', 6, NULL, NULL),
(17, 'Daging Giling', 6, NULL, NULL),
(18, 'Daging Kambing', 6, NULL, NULL),
(19, 'Ikan Bandeng', 7, NULL, NULL),
(20, 'Ikan Tuna', 7, NULL, NULL),
(21, 'Ikan Lele', 7, NULL, NULL),
(22, 'Tahu Putih', 8, NULL, NULL),
(23, 'Tahu Kuning', 8, NULL, NULL),
(24, 'Tahu Pong', 8, NULL, NULL),
(25, 'Tempe Bungkus Daun', 9, NULL, NULL),
(26, 'Tempe Plastik', 9, NULL, NULL),
(27, 'Tempe Goreng Matang', 9, NULL, NULL),
(28, 'Tomat Merah', 10, NULL, NULL),
(29, 'Tomat Hijau', 10, NULL, NULL),
(30, 'Tomat Cherry', 10, NULL, NULL),
(31, 'kotak', 12, '2025-05-13 06:08:23', '2025-05-13 06:08:23'),
(32, 'bulat', 12, '2025-05-13 06:08:34', '2025-05-13 06:08:34'),
(33, 'laptop', 23, '2025-05-19 00:22:55', '2025-05-19 00:22:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_pelaporan`
--

CREATE TABLE `barang_pelaporan` (
  `id_barang_pelaporan` bigint(20) UNSIGNED NOT NULL,
  `id_kategori_barang_pelaporan` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
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
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id_berita`, `id_disdag`, `judul`, `isi`, `lampiran`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Peningkatan Kualitas Pelayanan di Dinas Perdagangan Parepare melalui Program Pelatihan untuk Pedagang', '<p data-start=\"171\" data-end=\"585\" class=\"\">PAREPARE – Dalam rangka meningkatkan kualitas pelayanan dan memperkuat ekonomi lokal, Dinas Perdagangan Kota Parepare menggelar program pelatihan bagi para pedagang di pasar tradisional. Pelatihan yang berlangsung selama tiga hari ini bertujuan untuk meningkatkan keterampilan para pedagang dalam hal manajemen usaha, pemasaran produk, dan penerapan standar kebersihan serta keamanan produk yang dijual.</p><p data-start=\"587\" data-end=\"1107\" class=\"\">Program yang dihadiri oleh lebih dari 100 pedagang ini diharapkan dapat memberikan dampak positif terhadap daya saing produk lokal, serta memfasilitasi pedagang dalam menghadapi persaingan pasar yang semakin ketat. Kepala Dinas Perdagangan Parepare, Dr. H. Muhammad Syarif, dalam sambutannya menyatakan, \"Kami ingin menciptakan lingkungan perdagangan yang lebih profesional dan berkelanjutan, agar pedagang di Parepare tidak hanya bersaing di pasar lokal, tetapi juga dapat memperluas jangkauan pasarnya ke daerah lain.\"</p><p data-start=\"1109\" data-end=\"1525\" class=\"\">Pelatihan ini juga melibatkan sejumlah narasumber ahli di bidang perdagangan dan pemasaran digital yang memberikan wawasan penting tentang bagaimana memanfaatkan teknologi untuk memperluas pasar. Salah satu peserta pelatihan, Fatmawati, yang telah berjualan selama 10 tahun di Pasar Lakessi, mengungkapkan bahwa pelatihan ini sangat bermanfaat untuk meningkatkan pengetahuannya dalam memasarkan produk secara online.</p><p data-start=\"1527\" data-end=\"1693\" class=\"\">\"Dengan adanya pelatihan ini, saya merasa lebih siap menghadapi tantangan dalam berjualan, terutama dalam hal pemasaran yang lebih efektif di dunia digital,\" ujarnya.</p><p>\r\n\r\n\r\n\r\n</p><p data-start=\"1695\" data-end=\"1915\" class=\"\">Program ini rencananya akan dilanjutkan dengan pelatihan serupa di beberapa pasar lainnya di Kota Parepare, untuk memastikan bahwa semua pedagang mendapatkan kesempatan yang sama dalam meningkatkan kualitas usaha mereka.</p>', 'lampiran/ayog33FjCNSPYwlu1ZIvdAqwa9U2JfFyw3ONWepr.jpg', '2025-05-04', '2025-05-08 00:16:05', '2025-05-08 00:16:05'),
(2, NULL, 'Dinas Perdagangan Luncurkan Program Pasar Murah Jelang Hari Raya', '<p>oii</p>', 'lampiran/m6QJx6O60ztPHF62bzMffp2iF43dvvZTBeYN978i.png', '2025-05-07', '2025-05-17 04:28:32', '2025-05-17 04:28:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cap_tanda_tera`
--

CREATE TABLE `cap_tanda_tera` (
  `id_cap` bigint(20) UNSIGNED NOT NULL,
  `ctt` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_alat_ukur`
--

CREATE TABLE `data_alat_ukur` (
  `id_data_alat` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_uttp` bigint(20) UNSIGNED NOT NULL,
  `tanggal_valid` date NOT NULL,
  `tanggal_exp` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `sertifikat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `disdag`
--

CREATE TABLE `disdag` (
  `id_disdag` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `role` enum('master_admin','admin_perdagangan','admin_industri','admin_metrologi','kabid_perdagangan','kabid_industri','kabid_metrologi','kepala_dinas') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `disdag`
--

INSERT INTO `disdag` (`id_disdag`, `password`, `nip`, `email`, `telp`, `role`, `created_at`, `updated_at`) VALUES
(1, '$2y$12$0lGqkZMLkRn10gIE34Opu.PgiWQrkZNMmzafzGuIm8Y02vZ3AA9za', '196501011990031001', 'master_admin@disdag.local', '08123456789', 'master_admin', '2025-05-12 10:04:49', '2025-05-12 10:04:49'),
(2, '$2y$12$wHR4840w8075I1/3eBrkQexYhC6fMZo9/HFeIBqH77PK0eqDSs.vG', '197201021993041002', 'admin_perdagangan@disdag.local', '08123456789', 'admin_perdagangan', '2025-05-12 10:04:50', '2025-05-12 10:04:50'),
(3, '$2y$12$gFxwbL7Q7zW4tbGI1q3bKuoSF8lYs.KxUAXVac7QwBaxtx2iMjCDy', '197305031994051003', 'admin_industri@disdag.local', '08123456789', 'admin_industri', '2025-05-12 10:04:50', '2025-05-12 10:04:50'),
(4, '$2y$12$6aPtDvjqq141QHqbi/ILaeCZ8omSusuoFraZXXhoP4df0dp94VyjS', '197406041995061004', 'admin_metrologi@disdag.local', '08123456789', 'admin_metrologi', '2025-05-12 10:04:51', '2025-05-12 10:04:51'),
(5, '$2y$12$2DnNGaWlO1QFSp51xmBHneIX8KIwjyrysnIkiSkAatyrkxD.9/69.', '197507051996071005', 'kabid_perdagangan@disdag.local', '08123456789', 'kabid_perdagangan', '2025-05-12 10:04:51', '2025-05-12 10:04:51'),
(6, '$2y$12$3dZfPYju2Gu7xPmj/GFbPuevUUWk2Yjgd4Z07txBZmleUb167fyIm', '197608061997081006', 'kabid_industri@disdag.local', '08123456789', 'kabid_industri', '2025-05-12 10:04:51', '2025-05-12 10:04:51'),
(7, '$2y$12$L03d18XFijoASw1N6Q21G.erBouWlxo/Al68Xy/W5AHllPzT0IiHO', '197709071998091007', 'kabid_metrologi@disdag.local', '08123456789', 'kabid_metrologi', '2025-05-12 10:04:52', '2025-05-12 10:04:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `distribusi_pupuk`
--

CREATE TABLE `distribusi_pupuk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_usaha` varchar(255) NOT NULL,
  `no_register` varchar(255) NOT NULL,
  `urea` int(11) NOT NULL,
  `npk` int(11) NOT NULL,
  `npk_fk` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `distribusi_pupuk`
--

INSERT INTO `distribusi_pupuk` (`id`, `nama_usaha`, `no_register`, `urea`, `npk`, `npk_fk`, `created_at`, `updated_at`) VALUES
(1, 'CV Tani Jaya', 'REG-001', 1200, 800, 500, '2025-05-17 14:36:15', '2025-05-17 14:36:15'),
(2, 'PT Pupuk Makmur', 'REG-002', 2000, 1800, 700, '2025-05-17 14:36:15', '2025-05-17 14:36:15'),
(3, 'Koperasi Subur', 'REG-003', 1500, 1000, 300, '2025-05-17 14:36:15', '2025-05-17 14:36:15'),
(4, 'UD Agro Sukses', 'REG-004', 900, 600, 400, '2025-05-17 14:36:15', '2025-05-17 14:36:15'),
(5, 'CV Pangan Lestari', 'REG-005', 1300, 1100, 600, '2025-05-17 14:36:15', '2025-05-17 14:36:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `distributor`
--

CREATE TABLE `distributor` (
  `id_distributor` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nib` varchar(255) NOT NULL,
  `status` enum('Menunggu','Ditolak','Disetujui') NOT NULL DEFAULT 'Menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `distributor`
--

INSERT INTO `distributor` (`id_distributor`, `id_user`, `nib`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'nib_dokumen/1747506970_TOR HMIC.pdf', 'Disetujui', '2025-05-17 10:36:10', '2025-05-17 10:36:10'),
(2, 2, 'nib_dokumen/1747642184_Doc - 18-04-25 - 23.07.pdf', 'Menunggu', '2025-05-19 00:09:44', '2025-05-19 00:09:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `document_user`
--

CREATE TABLE `document_user` (
  `id_document` bigint(20) UNSIGNED NOT NULL,
  `id_permohonan` char(36) NOT NULL,
  `npwp` varchar(255) DEFAULT NULL,
  `akta_perusahaan` varchar(255) DEFAULT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL,
  `foto_usaha` varchar(255) DEFAULT NULL,
  `dokument_nib` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `document_user`
--

INSERT INTO `document_user` (`id_document`, `id_permohonan`, `npwp`, `akta_perusahaan`, `foto_ktp`, `foto_usaha`, `dokument_nib`, `created_at`, `updated_at`) VALUES
(2, '275bd182-d7c7-4521-932d-debe39fad3d0', 'uploads/fnAAT0TbBscMIhNIuO4CrZ592UFQx8BXmM4mFw1a.jpg', 'uploads/mAZKG4FKcDppwMARaMPI2pfNmMPlywAuCq3QjNqU.pdf', 'uploads/lTwskfKJoGLwOXTTuVY0PqBSsKObaDtbC6kPeHnh.jpg', 'uploads/pD5EjBrKF9U1UaRYfTh6cPU4IDuXZikNkBwV7td8.jpg', 'uploads/mqhButFXMt3AFsAsnL5WRcIeesKw0jfuv2MQLLy4.pdf', '2025-05-08 00:27:03', '2025-05-08 00:27:03'),
(3, '05cd2dbe-ce93-4dd9-be1f-6aa10348b569', 'uploads/FFV1a4yd80GCRTJuNahZuKWJJY2Xf1vNhw3MitT2.pdf', 'uploads/c5hAmQmGPDSqSrI06FxUf1Ws7PNHrQtJS5kCO5Ok.pdf', 'uploads/ZoM3NaUd2oZJwcy7P8LaBZm11k1E7tZo7mzhhuXP.png', 'uploads/88IwM6P5RrvdGEICnbcBNYhHZSabRHPdPRTAIAws.jpg', 'uploads/zatimVNYSmtOKumTUw1GgyeypkHHKqnkrJxrY6L1.pdf', '2025-05-08 07:40:44', '2025-05-08 07:40:44'),
(5, '9452e958-7b4a-4544-b2cc-1cfed5e8a071', 'DokumentUser/0ZQPTqLOUhxYGVrSsYMpm3YRJ9fNlIoFmCgXndmM.png', 'DokumentUser/B0AHRPRPai19a354HkjnLIF4AliDwmHhhkFA9tvN.pdf', 'DokumentUser/oLfL8hT2YbEzVXTMmDNINV84BaTQYlhdrmLwSUYF.png', 'DokumentUser/zAlYQURJBcJ016mGEVDOWR94jHIDGkos3EgWGJyl.png', 'DokumentUser/FaEd0B3gY91zNH8Wh3YKzQrmnLlwXAAbLqgHKkLd.pdf', '2025-05-13 05:03:21', '2025-05-13 05:03:21'),
(6, 'aa9a7bf5-15e0-4a11-9261-5b3c31294123', 'DokumentUser/dWaDnCOxPE47wB67LqyuTKeRJiH9X2CUWO5X097C.pdf', 'DokumentUser/dwnfcEfvAScemlL3LDEKoSGZWj60N9KLSRp1uLhL.pdf', 'DokumentUser/5twQEtQhuVp2B4f1xMS9boWJ6Qht0PW4KDxMWUae.png', 'DokumentUser/lhfszt5xlh6NouJ6rbUKrR8MRdoVQUpPNwkyn7lZ.png', 'DokumentUser/30XG6uc3Dmw0MIHz2zajBX2etue6Y1VVocDFMc2i.pdf', '2025-05-14 09:02:01', '2025-05-14 09:02:01'),
(7, '374c1a3a-017a-4fee-8123-0a4286a73076', 'DokumentUser/WnBzrY4zu59KNm3rLfgoi2D52OdG8uZLQW9zlwFY.pdf', 'DokumentUser/YBbSqyoXg7h3jBNXHcL7MZgjF45mjwwnNQm48Pz0.pdf', 'DokumentUser/Jx7WPvWeneDTBDNfWmKu0OJLS8XKkh5MFQdrgaFE.png', 'DokumentUser/xVp5nTxWHQ0nCQbX8y37jWY0SphxlRrusIeQk5Zo.png', 'DokumentUser/AT44rWDr0sEEBeqPCTsddIulcPLn8DrV0cLfBfFR.pdf', '2025-05-14 09:44:03', '2025-05-14 09:44:03'),
(8, 'c75a9ba0-0e7f-4185-8a56-1b869137fba0', 'DokumentUser/5HVcxg39pBgAX9hPXuBXaVcKUxsLIspmMq5OLV6Z.pdf', 'DokumentUser/ofPPhih6JovpJilmiPHk5gyw3NXKA894Df84QUiY.pdf', 'DokumentUser/nPpfIo1C1SuKuugcHxAYxI9gSo53li8tGnF0GZGp.png', 'DokumentUser/qnb1N651p7Q0L9A2HSXJAhDLl1OTkBYwUmg4vvp0.png', 'DokumentUser/oR3VRqLVH1OYXe6fQOFR5D1ixWfKalNx2H0zlWCj.pdf', '2025-05-14 09:49:55', '2025-05-14 09:49:55'),
(9, '9e59caf2-e8dd-4dba-9332-2a584449924d', 'DokumentUser/G7wDqqiRjFFbfTpNqYNXIXGqvqyOyh7HR0WEbv1x.png', 'DokumentUser/JAPWlzgTn1dgUoFsCPZoMFSGCFguXeaR46bIJNOY.pdf', 'DokumentUser/reBA9SYNoO4c8C7fQcuQRhBSGUNdBIdjEMxBmMMW.png', 'DokumentUser/i1w2014NWfYdpMU1lSB1n64TkOceuEk0dOI0wSEc.png', 'DokumentUser/muj70nehAbstW1ne58T7OyAAww1lxBYizrgplKz1.pdf', '2025-05-15 01:41:44', '2025-05-15 01:41:44'),
(10, '38ffea1a-4074-4e32-bff8-afcd4559566c', 'DokumentUser/wOMIrxtvMMvgsURF5S7I0EyMaDxCGewbzEoHQfjE.png', 'DokumentUser/BZRLRegly6VsOe13NDuprcI79AH1rGyYMsS8dsuE.pdf', 'DokumentUser/2CoYqVZWpiY1uxaaflIlEDxcDu7CBjdX7rLE4GHv.png', 'DokumentUser/26ce2NF2QNK4BZTFSYx1wqHgDgvfTMh8puDDlfmp.png', 'DokumentUser/K6XvRcoXEEXgaFc69GP4A5XQoSrVFVc16VbBc5Mb.pdf', '2025-05-15 01:46:47', '2025-05-15 01:46:47'),
(11, '27b3b01f-8294-4b23-944c-5e622b9ec036', 'DokumentUser/DERQ24RyMxsUPTnFmg319qYOqffAaTsCag5ShOIq.png', 'DokumentUser/FOtrYHm4lFWjox2m6uuALsh5wR0mBDhWDGiJi4JQ.pdf', 'DokumentUser/Rj7N6XwpMbWa4bPtqjM9UuHsXPvhR4NF0itW3RXO.png', 'DokumentUser/hsBdLuY0poJMh95qf2DWcPFJXY2S9Ay0R52hI5nP.png', 'DokumentUser/0vLhnrKGl0rrlsV3JvmGXLrZiVe6L0Q0JobeUmOo.pdf', '2025-05-15 04:09:58', '2025-05-15 04:09:58'),
(12, '908b2a05-0c33-4493-a06d-f39cb119f627', 'DokumentUser/8FODP2gMssWaab67hs3maf11myYRghCiRluH0Lts.pdf', 'DokumentUser/EOUDKvLu7FuomOOwrxqkrGIUmGCsa4xLhUaaFerS.pdf', 'DokumentUser/Y4e4FS2MkJeQi5KJk9BCoUDAEPYiofdeo79dCcTF.png', 'DokumentUser/gAZRJhkIzGekaeG249AWDT2oR46maF8Fbl9BOX2D.png', 'DokumentUser/LVxInRJF5UDwRFAQdUI8MjoTnJ2lFEUpJs3BbcPi.pdf', '2025-05-15 04:59:28', '2025-05-15 04:59:28'),
(13, '07f8f4ef-c7a2-4a73-bbbe-12f62b9be76e', 'DokumentUser/TupUZd5OTtqpvPvHrhShS7lsRwf1AwxG1IlxwTIX.png', 'DokumentUser/3rfrUvfx0z03a4c1ghaVhpzcLAGEkdBmIuMXbqxY.pdf', 'DokumentUser/i6aVnWHPFrRd4cfJItuwFMEimQzbQYEloDYQ87IK.png', 'DokumentUser/JiFUYaIr7CfzZjppH8gO665sgOxpWq4CLgCV3I5Q.png', 'DokumentUser/iK4KLkFRnuc4Er5lc6xxdkAjkj7jpKpMYRh85E3z.pdf', '2025-05-15 05:00:30', '2025-05-15 05:00:30'),
(14, 'd14b0c24-c083-42a7-a7b3-473e763baf8c', 'DokumentUser/2jCQ4v3Wl1Wi2GYRL6eaQIISU47dvCypShHtSlvS.png', 'DokumentUser/3oBDjhAGudF8aWAOlrlpD7lFjWlkpfUhOWXDM8lJ.pdf', 'DokumentUser/WHWAB3hkyTafJHbqRLkYymt6k1f4s4dyRkIFPE8O.png', 'DokumentUser/0oTzbVxck9DeaxvDKdreBgbDnr13WVWhQA6gI4as.png', 'DokumentUser/5FWHZRogPZIDlTDQMPMwluCpr4hxuk65BtB9bcSN.pdf', '2025-05-15 08:31:59', '2025-05-15 08:31:59'),
(15, '4776f91a-1f96-43a4-9d25-6b8f9c6b34d2', 'DokumentUser/xvKXuB2Wc6X9WHXER0n5FWG7q1YNZpkKjzf7u1Q3.jpg', 'DokumentUser/OTMy45cvq2dojc7v6IY8fN95LEnZHdjQ5Tkd9YqE.pdf', 'DokumentUser/J8DOPIVJxsMzESlE7I8rUw2UyVssfe2WPniW8Ez4.jpg', 'DokumentUser/K6aAkUFWuGv887OctEUXkObHfHg27kzOlR8zbbey.jpg', 'DokumentUser/ZNYMm2IOYHcMqahvJwt4O7qdyr8Shs4gUM8gpaNE.pdf', '2025-05-17 05:28:27', '2025-05-17 05:28:27'),
(16, '78260771-02e9-47ba-af8f-ac59ff9b688b', 'DokumentUser/VQICii90y3uJu0uF3GttaQ0I0G1mnTlxRLiXwPkq.jpg', 'DokumentUser/FSCcEcuUlPzagGtHk9QxFBBV0PkLdJXQyMDAlirr.pdf', 'DokumentUser/nLyHuuNhVWRtRnrtIfQdYc8OP067B6n2zeyXqAFY.jpg', 'DokumentUser/2dEJDk6XVSCBmzTyXqXbggr0tBDtcbxmrofQ9qhS.jpg', 'DokumentUser/mXRwRP5NxZnDZU0mUHJO3T8HShem8e2WhWMP00Qt.pdf', '2025-05-17 05:49:19', '2025-05-17 05:49:19'),
(17, '853efa20-fa8d-45ef-b4d9-30bff9ae65e5', 'DokumentUser/zMJbDhpBZyc4ObCrfJjX4Hlv5Fd1srHzYiuiQvRV.png', 'DokumentUser/ZfC7efFC8qsyh6Adb76kLncyOM48ReL7utj7MbSc.pdf', 'DokumentUser/1JjfMJcr6UicaMVK7b6s1Z9NWSChB91JI8eMm1sL.png', 'DokumentUser/1jiA0qnm0fftLHJ9WA5uGFU6hdMo1dQ9qilCB4yU.png', 'DokumentUser/KvpsN6KVhWALDreadMYJEzlwfAu23sF9T1zuoo2p.pdf', '2025-05-18 23:15:04', '2025-05-18 23:15:04'),
(18, '175731cb-a083-4267-8221-0249cca31085', 'DokumentUser/2nbs5BCcYDySTEmSpFXVgpkmL71805ilE0APoquO.pdf', 'DokumentUser/ZhgAiCG5z9bOFkUpTfLngWmU7E9xmbD6vHSWAYkX.pdf', 'DokumentUser/ymxeQAsFVawCaz1cRmYxSvzHFalsSCgHjGM4ekkX.jpg', 'DokumentUser/5WnfX5iyCAUOYP9c22Bo1BsGYcQIonBra5xGhjb2.jpg', 'DokumentUser/38BUzgkMdPnmckC1L8vJn2b9iFwP7lbmgkHWPeSj.pdf', '2025-05-18 23:54:31', '2025-05-18 23:54:31'),
(19, 'a4a14d84-dc1b-4956-827d-016f254ae557', 'DokumentUser/Iuz2OXSX8tsarjqVHCdAgy92MgZTfwgmWOUEklsu.jpg', 'DokumentUser/cHmxfRk1KfiHJktGXjIvlmgPs3Po0ocr9HiPfFsi.pdf', 'DokumentUser/QpR1wsmaP2nkwlbZlii1jLjcRkzEqsnRaS1y8bkW.png', 'DokumentUser/sYSHgbc2phSNFibWwDgSwJnLLdPxg2905aRut1Ag.jpg', 'DokumentUser/HgsxodBXLnRJsiRiKXJz5bKKn4dihFMsW1EIRBL0.pdf', '2025-05-19 00:05:07', '2025-05-19 00:05:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `form_permohonan`
--

CREATE TABLE `form_permohonan` (
  `id_permohonan` char(36) NOT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `jenis_surat` varchar(255) NOT NULL,
  `titik_koordinat` varchar(255) NOT NULL,
  `file_surat` varchar(255) DEFAULT NULL,
  `file_balasan` varchar(255) DEFAULT NULL,
  `status` enum('menunggu','ditolak','diterima') NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `form_permohonan`
--

INSERT INTO `form_permohonan` (`id_permohonan`, `id_user`, `kecamatan`, `kelurahan`, `tgl_pengajuan`, `jenis_surat`, `titik_koordinat`, `file_surat`, `file_balasan`, `status`, `created_at`, `updated_at`) VALUES
('05cd2dbe-ce93-4dd9-be1f-6aa10348b569', 1, 'bacukiki_barat', 'kampung_baru', '2025-05-08', 'surat_keterangan_perdagangan', '-4.028889, 119.633521', 'uploads/4Qqjs1Q2VVHtAYBwbjqfD1XwfsjcjnFS9W52cLcb.pdf', NULL, 'menunggu', '2025-05-08 07:40:43', '2025-05-08 07:40:43'),
('07f8f4ef-c7a2-4a73-bbbe-12f62b9be76e', 2, 'ujung', 'ujung_bulu', '2025-05-15', 'surat_keterangan_perdagangan', '7654321', 'DokumentUser/PNJUHDbTm1mvB19eoEF4F5B34KGWNIhYuHDjTsfp.docx', NULL, 'menunggu', '2025-05-15 05:00:30', '2025-05-15 05:00:30'),
('175731cb-a083-4267-8221-0249cca31085', 2, 'bacukiki', 'galung_maloang', '2025-05-19', 'surat_rekomendasi_perdagangan', '-4.028889, 119.633521', 'DokumentUser/JLFkwoefajD3fQHY9BST5BOFBtwUgkhtRzkQ00ki.docx', 'surat/rekomendasi-741cac18-7b42-444c-8ea2-fa6a751b48a9.pdf', 'diterima', '2025-05-18 23:54:31', '2025-05-19 00:03:45'),
('275bd182-d7c7-4521-932d-debe39fad3d0', 1, 'bacukiki_barat', 'bumi_harapan', '2025-05-08', 'surat_rekomendasi', '12345678', 'uploads/cpDxtiZfPKqM4VB8ASHpcHaTtOLibLL3kgcYWLhi.pdf', NULL, 'menunggu', '2025-05-08 00:27:03', '2025-05-08 00:27:03'),
('27b3b01f-8294-4b23-944c-5e622b9ec036', 2, 'soreang', 'watang_soreang', '2025-05-15', 'surat_rekomendasi_perdagangan', '123456', 'DokumentUser/hunhBIELBYv9B0H9SB8WI1oTkeyQlfEz2t8XmdMl.pdf', 'surat/rekomendasi-ca8ce979-dcb9-461c-b499-ef8f6704b993.pdf', 'diterima', '2025-05-15 04:09:58', '2025-05-15 04:14:00'),
('374c1a3a-017a-4fee-8123-0a4286a73076', 2, 'bacukiki_barat', 'kampung_baru', '2025-05-14', 'surat_rekomendasi_perdagangan', '134567', 'DokumentUser/Xq88s3Gu6MvlcDvOr09nk0DKLEzoUQOB6FQKfRGI.pdf', 'surat/penolakan-e50af0a0-7b3c-452a-8a35-05ecb796a2a1.pdf', 'ditolak', '2025-05-14 09:44:02', '2025-05-14 09:48:00'),
('38ffea1a-4074-4e32-bff8-afcd4559566c', 2, 'bacukiki_barat', 'sumpang_minangae', '2025-05-15', 'surat_rekomendasi_perdagangan', '-4.028889, 119.633521', 'DokumentUser/vSs80s3wWEQFAbuHPkIqMCCuOcAnlCxnOofBMUn4.pdf', 'surat/penolakan-65f92fe7-dde0-4b28-8a60-b850f7168ea7.pdf', 'ditolak', '2025-05-15 01:46:47', '2025-05-15 01:55:15'),
('4776f91a-1f96-43a4-9d25-6b8f9c6b34d2', 2, 'bacukiki', 'galung_maloang', '2025-05-17', 'surat_keterangan_perdagangan', '-4.028889, 119.633521', 'DokumentUser/V1J0Qw1A8PIeMdowTqAlEpRoTTPA1TkGVyebjsn9.docx', NULL, 'menunggu', '2025-05-17 05:28:26', '2025-05-17 05:28:26'),
('78260771-02e9-47ba-af8f-ac59ff9b688b', 3, 'bacukiki', 'watang_bacukiki', '2025-05-17', 'surat_rekomendasi_perdagangan', '-4.028889, 119.633521', 'DokumentUser/PQw0TNYT2x9VZJIbsAkVpIRRBTXL2oINKdGCv757.pdf', 'surat/penolakan-618f4c39-3bb0-4a3f-98ce-ba57ce4683ac.pdf', 'ditolak', '2025-05-17 05:49:19', '2025-05-18 08:28:14'),
('853efa20-fa8d-45ef-b4d9-30bff9ae65e5', 3, 'bacukiki_barat', 'bumi_harapan', '2025-05-19', 'surat_rekomendasi_perdagangan', '123456789098765', 'DokumentUser/7bjGOuZuAYDAiGzcJ7WroZRBnoE0acMO0Hh3g1pr.docx', 'surat/penolakan-bd346b0a-64d3-4d66-a32a-5843fbd4e8f4.pdf', 'ditolak', '2025-05-18 23:15:03', '2025-05-18 23:16:18'),
('908b2a05-0c33-4493-a06d-f39cb119f627', 2, 'bacukiki_barat', 'tiro_sompe', '2025-05-15', 'surat_rekomendasi_perdagangan', '12345678', 'DokumentUser/t5rbO63EBV2MBcxT96GGQnycdB9jjB8mt22reIFB.docx', NULL, 'menunggu', '2025-05-15 04:59:27', '2025-05-15 04:59:27'),
('9452e958-7b4a-4544-b2cc-1cfed5e8a071', 2, 'bacukiki_barat', 'kampung_baru', '2025-05-13', 'surat_keterangan_perdagangan', '-4.028889, 119.633521', 'DokumentUser/2WoTchaIVquUJddTCfaMiFPTaE7CwsmqnVNq8Q2l.pdf', 'surat/penolakan-1339120c-cd7e-4fe5-b4d9-30a1bce1652e.pdf', 'ditolak', '2025-05-13 05:03:21', '2025-05-13 09:45:53'),
('9e59caf2-e8dd-4dba-9332-2a584449924d', 2, 'bacukiki', 'galung_maloang', '2025-05-15', 'surat_keterangan_perdagangan', '134567', 'DokumentUser/NHx9xoRGDkEtnQbltO7fdhNLJHSrsLayA2bD24SH.pdf', 'surat/penolakan-bcd6d4bb-f2be-438d-8487-bfdec8b588e5.pdf', 'ditolak', '2025-05-15 01:41:44', '2025-05-15 02:03:20'),
('a4a14d84-dc1b-4956-827d-016f254ae557', 2, 'soreang', 'bukit_indah', '2025-05-19', 'surat_keterangan_perdagangan', '123456', 'DokumentUser/RyQfSfiNyGBoxEe7dau1les3GtpXVlvQZWjzlLTx.pdf', 'surat/penolakan-04fb7ed5-c342-4a03-9030-12345e2fca6e.pdf', 'ditolak', '2025-05-19 00:05:07', '2025-05-19 00:05:55'),
('aa9a7bf5-15e0-4a11-9261-5b3c31294123', 2, 'soreang', 'lakessi', '2025-05-14', 'surat_rekomendasi_perdagangan', '-4.028889, 119.633521', 'DokumentUser/3Ij0rGNmTrR1ap7i8gsgqNmTegKM0rfHN5ZSqMJ5.docx', 'surat/rekomendasi-dad1bfd6-c68a-45e2-9d72-4b2c1688a37c.pdf', 'diterima', '2025-05-14 09:02:00', '2025-05-14 09:12:35'),
('c75a9ba0-0e7f-4185-8a56-1b869137fba0', 2, 'bacukiki', 'lemoe', '2025-05-14', 'surat_rekomendasi_perdagangan', '12345678', 'DokumentUser/4ZS3bwFtrW8pHqJozdwD3nKxmbhznYJj5wFFCPLW.pdf', 'surat/penolakan-6fa4b0f3-e42e-4d32-8643-623b8e93e3ee.pdf', 'ditolak', '2025-05-14 09:49:55', '2025-05-15 02:13:34'),
('d14b0c24-c083-42a7-a7b3-473e763baf8c', 2, 'bacukiki_barat', 'kampung_baru', '2025-05-15', 'surat_rekomendasi_perdagangan', '12345678', 'DokumentUser/JEv8AZJnFLIq4AWG0PwOKFzuf9W6u2a8xuAVbVLs.docx', 'surat/rekomendasi-07cac028-e285-4e35-bc7d-ac8288753e84.pdf', 'diterima', '2025-05-15 08:31:58', '2025-05-15 08:35:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `forum_diskusi`
--

CREATE TABLE `forum_diskusi` (
  `id_pengaduan` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_disdag` bigint(20) UNSIGNED DEFAULT NULL,
  `chat` text DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `forum_diskusi`
--

INSERT INTO `forum_diskusi` (`id_pengaduan`, `id_user`, `id_disdag`, `chat`, `waktu`, `status`, `created_at`, `updated_at`) VALUES
(6, 2, NULL, 'cfvgbhnjmk', '2025-05-16 11:42:54', 'terkirim', NULL, NULL),
(7, 2, NULL, 'ssssss', '2025-05-16 11:46:36', 'terkirim', NULL, NULL),
(8, 2, NULL, 'ree', '2025-05-16 11:47:40', 'terkirim', NULL, NULL),
(9, 2, NULL, 'ssssss', '2025-05-16 11:49:32', 'terkirim', NULL, NULL),
(10, 2, NULL, 'apakah', '2025-05-16 11:53:02', 'terkirim', NULL, NULL),
(11, 2, NULL, 'haaaa', '2025-05-16 11:53:10', 'terkirim', NULL, NULL),
(12, 2, NULL, 'ass', '2025-05-16 11:53:40', 'terkirim', NULL, NULL),
(13, 2, NULL, 'sssss', '2025-05-16 11:54:31', 'terkirim', NULL, NULL),
(14, 2, NULL, 'gggg', '2025-05-16 11:54:36', 'terkirim', NULL, NULL),
(15, 2, NULL, 'aaa', '2025-05-16 11:55:01', 'terkirim', NULL, NULL),
(16, 2, NULL, 'tes', '2025-05-16 11:55:26', 'terkirim', NULL, NULL),
(17, 2, NULL, 'i', '2025-05-16 12:00:49', 'terkirim', NULL, NULL),
(18, 2, NULL, 'gggg', '2025-05-16 12:01:46', 'terkirim', NULL, NULL),
(19, 2, NULL, 'aa', '2025-05-16 12:03:22', 'terkirim', NULL, NULL),
(20, 2, NULL, 'sss', '2025-05-16 12:07:51', 'terkirim', NULL, NULL),
(21, 2, NULL, 'sssssss', '2025-05-16 12:07:56', 'terkirim', NULL, NULL),
(22, 2, NULL, 'apakahh', '2025-05-16 12:08:02', 'terkirim', NULL, NULL),
(23, 2, NULL, 'ff', '2025-05-16 12:13:56', 'terkirim', NULL, NULL),
(24, 2, NULL, 'ssss', '2025-05-16 12:16:03', 'terkirim', NULL, NULL),
(25, 2, NULL, 'ssss', '2025-05-16 12:16:41', 'terkirim', NULL, NULL),
(26, 2, NULL, 'eeeeeeeeeee', '2025-05-16 12:17:17', 'terkirim', NULL, NULL),
(27, 2, NULL, 'dddddd', '2025-05-16 12:20:00', 'terkirim', NULL, NULL),
(28, 2, NULL, 'w', '2025-05-16 12:23:25', 'terkirim', NULL, NULL),
(29, 2, NULL, 'oke', '2025-05-16 12:24:07', 'terkirim', NULL, NULL),
(30, 2, NULL, 'lkk', '2025-05-16 12:29:27', 'terkirim', NULL, NULL),
(31, 2, NULL, 'oke', '2025-05-16 12:38:00', 'terkirim', NULL, NULL),
(32, 2, NULL, 'oke', '2025-05-16 12:38:08', 'terkirim', NULL, NULL),
(33, 2, NULL, 'hm', '2025-05-16 12:38:44', 'terkirim', NULL, NULL),
(34, 2, NULL, 'dddddd', '2025-05-16 12:39:48', 'terkirim', NULL, NULL),
(35, 2, NULL, 'o', '2025-05-16 13:08:36', 'terkirim', NULL, NULL),
(36, 2, NULL, 'okee', '2025-05-16 13:09:00', 'terkirim', NULL, NULL),
(37, 2, NULL, 'oke', '2025-05-16 13:12:16', 'terkirim', NULL, NULL),
(38, 2, NULL, 'nice', '2025-05-16 13:12:22', 'terkirim', NULL, NULL),
(39, 2, NULL, 'oke', '2025-05-16 13:16:41', 'terkirim', NULL, NULL),
(40, 2, NULL, 'oke', '2025-05-16 13:17:58', 'terkirim', NULL, NULL),
(41, 2, NULL, 'nice', '2025-05-16 13:18:02', 'terkirim', NULL, NULL),
(42, 2, NULL, 'oke', '2025-05-16 13:24:33', 'terkirim', NULL, NULL),
(43, 2, NULL, 's', '2025-05-16 13:28:30', 'terkirim', NULL, NULL),
(44, 2, NULL, 'oke', '2025-05-16 13:28:37', 'terkirim', NULL, NULL),
(45, 2, NULL, 'oke', '2025-05-16 13:29:55', 'terkirim', NULL, NULL),
(46, 2, NULL, 'oke', '2025-05-16 13:29:59', 'terkirim', NULL, NULL),
(47, 2, NULL, 'h', '2025-05-16 13:32:45', 'terkirim', NULL, NULL),
(48, 2, NULL, 'oii', '2025-05-16 13:35:12', 'terkirim', NULL, NULL),
(49, 2, NULL, 'gmn', '2025-05-16 13:35:17', 'terkirim', NULL, NULL),
(50, 2, NULL, 's', '2025-05-16 13:35:51', 'terkirim', NULL, NULL),
(51, 2, NULL, 'oke', '2025-05-16 13:37:42', 'terkirim', NULL, NULL),
(52, 2, NULL, 'h', '2025-05-16 13:38:51', 'terkirim', NULL, NULL),
(53, 2, NULL, 's', '2025-05-16 13:40:33', 'terkirim', NULL, NULL),
(54, 2, NULL, 's', '2025-05-16 13:40:36', 'terkirim', NULL, NULL),
(55, 2, NULL, 'ok', '2025-05-16 13:45:23', 'terkirim', NULL, NULL),
(56, 2, NULL, 'ok', '2025-05-16 13:45:24', 'terkirim', NULL, NULL),
(57, 2, NULL, 'o', '2025-05-16 13:45:44', 'terkirim', NULL, NULL),
(58, 2, NULL, 'o', '2025-05-16 13:45:45', 'terkirim', NULL, NULL),
(59, 2, NULL, 'j', '2025-05-16 13:46:43', 'terkirim', NULL, NULL),
(60, 2, NULL, 'k', '2025-05-16 13:49:42', 'terkirim', NULL, NULL),
(61, 2, NULL, 'k', '2025-05-16 13:49:42', 'terkirim', NULL, NULL),
(62, 2, NULL, 'k', '2025-05-16 13:49:49', 'terkirim', NULL, NULL),
(63, 2, NULL, 'k', '2025-05-16 13:49:49', 'terkirim', NULL, NULL),
(64, 2, NULL, 'k', '2025-05-16 13:50:51', 'terkirim', NULL, NULL),
(65, 2, NULL, 'ok', '2025-05-16 13:50:57', 'terkirim', NULL, NULL),
(66, 2, NULL, 'lohh', '2025-05-16 13:51:01', 'terkirim', NULL, NULL),
(67, 2, NULL, 'oke', '2025-05-16 13:54:59', 'terkirim', NULL, NULL),
(68, 2, NULL, 'l', '2025-05-16 13:55:55', 'terkirim', NULL, NULL),
(69, 2, NULL, 'h', '2025-05-16 13:58:47', 'terkirim', NULL, NULL),
(70, 3, NULL, 'oii', '2025-05-17 10:54:35', 'terkirim', NULL, NULL),
(71, 3, NULL, 'oii', '2025-05-18 05:21:43', 'terkirim', NULL, NULL),
(72, 2, NULL, 'ftghjkl', '2025-05-19 07:40:08', 'terkirim', NULL, NULL),
(73, 2, NULL, 'ftghjkl', '2025-05-19 07:40:10', 'terkirim', NULL, NULL),
(74, 2, NULL, 'ftghjkl', '2025-05-19 07:40:11', 'terkirim', NULL, NULL),
(75, 3, NULL, 'okijuhgt', '2025-05-20 05:33:41', NULL, '2025-05-20 05:33:41', '2025-05-20 05:33:41'),
(76, 3, NULL, 'okijuhgt', '2025-05-20 05:33:42', NULL, '2025-05-20 05:33:42', '2025-05-20 05:33:42'),
(77, 3, NULL, 'oke', '2025-05-20 05:33:56', NULL, '2025-05-20 05:33:56', '2025-05-20 05:33:56'),
(78, 3, NULL, 'fghjk,', '2025-05-20 05:45:43', NULL, '2025-05-20 05:45:43', '2025-05-20 05:45:43'),
(79, 3, NULL, 'ok', '2025-05-20 05:48:41', NULL, '2025-05-20 05:48:41', '2025-05-20 05:48:41'),
(80, 3, NULL, 'bnm', '2025-05-20 05:52:28', NULL, '2025-05-20 05:52:28', '2025-05-20 05:52:28'),
(81, 3, NULL, 'oke nice info', '2025-05-20 06:01:42', NULL, '2025-05-20 06:01:42', '2025-05-20 06:01:42'),
(82, 2, NULL, 'haiii', '2025-05-20 06:02:35', NULL, '2025-05-20 06:02:35', '2025-05-20 06:02:35'),
(83, 3, NULL, 'oiii', '2025-05-20 06:03:04', NULL, '2025-05-20 06:03:04', '2025-05-20 06:03:04'),
(84, 2, NULL, 'oii', '2025-05-20 06:08:12', NULL, '2025-05-20 06:08:12', '2025-05-20 06:08:12'),
(85, 3, NULL, 'eeeeeeeeeee', '2025-05-20 06:16:15', NULL, '2025-05-20 06:16:15', '2025-05-20 06:16:15'),
(86, 3, NULL, 'fghjk', '2025-05-20 06:27:10', NULL, '2025-05-20 06:27:10', '2025-05-20 06:27:10'),
(87, 3, NULL, 'pppp', '2025-05-20 09:10:40', NULL, '2025-05-20 09:10:40', '2025-05-20 09:10:40'),
(88, 3, NULL, 'pppp', '2025-05-20 09:10:41', NULL, '2025-05-20 09:10:41', '2025-05-20 09:10:41'),
(89, 3, NULL, 'eeeeeeeeeee', '2025-05-20 09:30:13', NULL, '2025-05-20 09:30:13', '2025-05-20 09:30:13'),
(90, 3, NULL, 'ssss', '2025-05-20 10:02:10', NULL, '2025-05-20 10:02:10', '2025-05-20 10:02:10'),
(91, 3, NULL, 'aneh', '2025-05-20 12:02:03', NULL, '2025-05-20 12:02:03', '2025-05-20 12:02:03'),
(92, 3, NULL, 'oiii', '2025-05-20 13:13:06', NULL, '2025-05-20 13:13:06', '2025-05-20 13:13:06'),
(93, 3, NULL, 'okee', '2025-05-20 13:17:09', NULL, '2025-05-20 13:17:09', '2025-05-20 13:17:09'),
(94, 3, NULL, 'oke', '2025-05-20 13:21:58', NULL, '2025-05-20 13:21:58', '2025-05-20 13:21:58'),
(95, 3, NULL, 'oke nice info', '2025-05-20 13:23:09', NULL, '2025-05-20 13:23:09', '2025-05-20 13:23:09'),
(96, 3, NULL, 'okemii', '2025-05-21 00:54:44', NULL, '2025-05-21 00:54:44', '2025-05-21 00:54:44'),
(97, 2, NULL, 'oww gitu', '2025-05-21 05:11:14', NULL, '2025-05-21 05:11:14', '2025-05-21 05:11:14'),
(98, 2, NULL, 'info', '2025-05-21 05:11:36', NULL, '2025-05-21 05:11:36', '2025-05-21 05:11:36');

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
  `lokasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `index_harga`
--

INSERT INTO `index_harga` (`id_index`, `id_barang`, `id_index_kategori`, `harga`, `tanggal`, `lokasi`, `created_at`, `updated_at`) VALUES
(330, 7, 3, 122222.00, '2025-05-11', 'Pasar Sumpang', '2025-05-11 11:20:00', '2025-05-11 11:20:00'),
(331, 16, 6, 15000.00, '2025-05-12', 'Pasar Lakessi', '2025-05-11 11:24:06', '2025-05-11 11:24:06'),
(332, 16, 6, 14389.00, '2025-05-11', 'Pasar Lakessi', '2025-05-11 11:24:54', '2025-05-11 11:24:54'),
(333, 1, 1, 13302.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(334, 1, 1, 13347.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(335, 1, 1, 13370.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(336, 1, 1, 13393.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(337, 1, 1, 10494.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(338, 1, 1, 10519.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(339, 1, 1, 10548.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(340, 1, 1, 10569.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(341, 1, 1, 10574.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(342, 2, 2, 10908.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(343, 2, 2, 10937.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(344, 2, 2, 10928.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(345, 2, 2, 10995.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(346, 2, 2, 10976.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(347, 2, 2, 10145.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(348, 2, 2, 10157.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(349, 2, 2, 10169.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(350, 2, 2, 10178.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(351, 2, 2, 10221.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(352, 3, 3, 13592.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(353, 3, 3, 13615.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(354, 3, 3, 13638.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(355, 3, 3, 13646.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(356, 3, 3, 13636.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(357, 3, 3, 12456.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(358, 3, 3, 12472.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(359, 3, 3, 12502.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(360, 3, 3, 12495.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(361, 3, 3, 12568.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(362, 4, 4, 10305.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(363, 4, 4, 10322.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(364, 4, 4, 10325.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(365, 4, 4, 10344.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(366, 4, 4, 10401.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(367, 4, 4, 13580.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(368, 4, 4, 13593.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(369, 4, 4, 13604.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(370, 4, 4, 13610.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(371, 4, 4, 13700.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(372, 5, 5, 10382.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(373, 5, 5, 10405.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(374, 5, 5, 10402.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(375, 5, 5, 10433.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(376, 5, 5, 10434.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(377, 5, 5, 10610.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(378, 5, 5, 10625.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(379, 5, 5, 10670.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(380, 5, 5, 10667.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(381, 5, 5, 10730.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(382, 6, 6, 10079.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(383, 6, 6, 10094.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(384, 6, 6, 10125.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(385, 6, 6, 10145.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(386, 6, 6, 10171.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(387, 6, 6, 10841.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(388, 6, 6, 10870.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(389, 6, 6, 10861.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(390, 6, 6, 10880.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(391, 6, 6, 10961.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(392, 7, 7, 11276.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(393, 7, 7, 11298.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(394, 7, 7, 11332.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(395, 7, 7, 11315.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(396, 7, 7, 11388.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(397, 7, 7, 13838.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(398, 7, 7, 13866.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(399, 7, 7, 13878.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(400, 7, 7, 13913.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(401, 7, 7, 13926.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(402, 8, 8, 14292.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(403, 8, 8, 14310.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(404, 8, 8, 14316.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(405, 8, 8, 14382.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(406, 8, 8, 14396.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(407, 8, 8, 12698.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(408, 8, 8, 12723.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(409, 8, 8, 12742.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(410, 8, 8, 12779.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(411, 8, 8, 12774.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(412, 9, 9, 11604.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(413, 9, 9, 11631.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(414, 9, 9, 11644.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(415, 9, 9, 11661.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(416, 9, 9, 11704.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(417, 9, 9, 13751.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(418, 9, 9, 13767.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(419, 9, 9, 13811.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(420, 9, 9, 13841.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(421, 9, 9, 13795.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(422, 10, 10, 13962.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(423, 10, 10, 13973.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(424, 10, 10, 13990.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(425, 10, 10, 14001.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(426, 10, 10, 14018.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(427, 10, 10, 14892.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(428, 10, 10, 14916.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(429, 10, 10, 14922.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(430, 10, 10, 14982.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(431, 10, 10, 14968.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(432, 11, 1, 12560.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(433, 11, 1, 12570.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(434, 11, 1, 12598.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(435, 11, 1, 12629.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(436, 11, 1, 12664.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(437, 11, 1, 12676.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(438, 11, 1, 12705.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(439, 11, 1, 12708.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(440, 11, 1, 12739.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(441, 11, 1, 12772.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(442, 12, 2, 12167.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(443, 12, 2, 12191.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(444, 12, 2, 12193.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(445, 12, 2, 12197.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(446, 12, 2, 12247.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(447, 12, 2, 14876.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(448, 12, 2, 14899.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(449, 12, 2, 14910.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(450, 12, 2, 14963.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(451, 12, 2, 14920.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(452, 13, 3, 14992.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(453, 13, 3, 15005.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(454, 13, 3, 15020.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(455, 13, 3, 15055.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(456, 13, 3, 15096.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(457, 13, 3, 10389.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(458, 13, 3, 10403.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(459, 13, 3, 10429.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(460, 13, 3, 10422.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(461, 13, 3, 10493.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(462, 14, 4, 11801.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(463, 14, 4, 11824.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(464, 14, 4, 11839.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(465, 14, 4, 11882.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(466, 14, 4, 11853.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(467, 14, 4, 14531.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(468, 14, 4, 14557.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(469, 14, 4, 14575.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(470, 14, 4, 14564.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(471, 14, 4, 14599.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(472, 15, 5, 12184.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(473, 15, 5, 12207.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(474, 15, 5, 12212.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(475, 15, 5, 12250.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(476, 15, 5, 12284.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(477, 15, 5, 12994.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(478, 15, 5, 13016.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(479, 15, 5, 13046.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(480, 15, 5, 13036.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(481, 15, 5, 13070.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(482, 16, 6, 12398.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(483, 16, 6, 12417.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(484, 16, 6, 12426.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(485, 16, 6, 12467.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(486, 16, 6, 12454.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(487, 16, 6, 11214.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(488, 16, 6, 11227.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(489, 16, 6, 11252.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(490, 16, 6, 11247.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(491, 16, 6, 11258.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(492, 17, 7, 13116.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(493, 17, 7, 13127.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(494, 17, 7, 13176.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(495, 17, 7, 13161.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(496, 17, 7, 13168.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(497, 17, 7, 10532.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(498, 17, 7, 10550.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(499, 17, 7, 10586.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(500, 17, 7, 10568.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(501, 17, 7, 10636.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(502, 18, 8, 12914.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(503, 18, 8, 12924.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(504, 18, 8, 12954.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(505, 18, 8, 12971.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(506, 18, 8, 12978.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(507, 18, 8, 12308.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(508, 18, 8, 12327.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(509, 18, 8, 12358.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(510, 18, 8, 12338.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(511, 18, 8, 12384.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(512, 19, 9, 11302.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(513, 19, 9, 11320.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(514, 19, 9, 11338.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(515, 19, 9, 11341.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(516, 19, 9, 11362.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(517, 19, 9, 10849.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(518, 19, 9, 10868.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(519, 19, 9, 10885.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(520, 19, 9, 10882.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(521, 19, 9, 10945.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(522, 20, 10, 12212.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(523, 20, 10, 12231.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(524, 20, 10, 12260.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(525, 20, 10, 12281.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(526, 20, 10, 12312.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(527, 20, 10, 14238.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(528, 20, 10, 14261.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(529, 20, 10, 14298.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(530, 20, 10, 14328.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(531, 20, 10, 14338.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(532, 21, 1, 10094.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(533, 21, 1, 10107.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(534, 21, 1, 10140.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(535, 21, 1, 10127.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(536, 21, 1, 10178.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(537, 21, 1, 11839.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(538, 21, 1, 11851.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(539, 21, 1, 11895.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(540, 21, 1, 11929.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(541, 21, 1, 11935.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(542, 22, 2, 14092.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(543, 22, 2, 14111.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(544, 22, 2, 14152.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(545, 22, 2, 14170.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(546, 22, 2, 14152.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(547, 22, 2, 11731.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(548, 22, 2, 11760.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(549, 22, 2, 11769.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(550, 22, 2, 11779.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(551, 22, 2, 11827.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(552, 23, 3, 13134.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(553, 23, 3, 13157.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(554, 23, 3, 13164.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(555, 23, 3, 13191.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(556, 23, 3, 13226.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(557, 23, 3, 12288.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(558, 23, 3, 12317.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(559, 23, 3, 12336.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(560, 23, 3, 12318.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(561, 23, 3, 12372.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(562, 24, 4, 14275.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(563, 24, 4, 14299.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(564, 24, 4, 14321.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(565, 24, 4, 14320.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(566, 24, 4, 14379.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(567, 24, 4, 11575.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(568, 24, 4, 11590.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(569, 24, 4, 11617.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(570, 24, 4, 11647.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(571, 24, 4, 11659.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(572, 25, 5, 13641.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(573, 25, 5, 13652.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(574, 25, 5, 13669.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(575, 25, 5, 13716.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(576, 25, 5, 13729.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(577, 25, 5, 12689.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(578, 25, 5, 12701.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(579, 25, 5, 12713.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(580, 25, 5, 12776.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(581, 25, 5, 12765.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(582, 26, 6, 13041.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(583, 26, 6, 13062.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(584, 26, 6, 13089.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(585, 26, 6, 13101.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(586, 26, 6, 13081.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(587, 26, 6, 13594.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(588, 26, 6, 13622.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(589, 26, 6, 13626.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(590, 26, 6, 13624.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(591, 26, 6, 13710.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(592, 27, 7, 13023.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(593, 27, 7, 13034.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(594, 27, 7, 13055.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(595, 27, 7, 13068.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(596, 27, 7, 13111.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(597, 27, 7, 12710.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(598, 27, 7, 12730.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(599, 27, 7, 12734.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(600, 27, 7, 12770.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(601, 27, 7, 12806.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(602, 28, 8, 11003.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(603, 28, 8, 11014.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(604, 28, 8, 11033.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(605, 28, 8, 11057.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(606, 28, 8, 11111.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(607, 28, 8, 11298.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(608, 28, 8, 11320.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(609, 28, 8, 11356.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(610, 28, 8, 11355.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(611, 28, 8, 11394.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(612, 29, 9, 12074.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(613, 29, 9, 12101.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(614, 29, 9, 12118.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(615, 29, 9, 12155.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(616, 29, 9, 12150.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(617, 29, 9, 14064.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(618, 29, 9, 14094.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(619, 29, 9, 14120.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(620, 29, 9, 14124.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(621, 29, 9, 14164.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(622, 30, 10, 11685.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(623, 30, 10, 11714.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(624, 30, 10, 11735.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(625, 30, 10, 11760.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(626, 30, 10, 11785.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(627, 30, 10, 14476.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(628, 30, 10, 14501.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(629, 30, 10, 14504.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(630, 30, 10, 14551.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(631, 30, 10, 14548.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(632, 32, 12, 12222.00, '2025-05-01', 'Pasar Sumpang', '2025-05-13 06:09:02', '2025-05-13 06:09:02'),
(633, 32, 12, 12345.00, '2025-05-01', 'Pasar Lakessi', '2025-05-13 06:09:18', '2025-05-13 06:09:18'),
(634, 32, 12, 13456.00, '2025-05-03', 'Pasar Lakessi', '2025-05-13 06:10:13', '2025-05-13 06:10:13'),
(635, 31, 12, 10111.00, '2025-05-02', 'Pasar Lakessi', '2025-05-13 06:10:36', '2025-05-13 06:10:36'),
(636, 1, 1, 13400.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:35', '2025-05-18 09:32:35'),
(637, 1, 1, 13100.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:36', '2025-05-18 09:32:36'),
(638, 2, 1, 11600.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:36', '2025-05-18 09:32:36'),
(639, 2, 1, 11500.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:36', '2025-05-18 09:32:36'),
(640, 3, 1, 14412.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:36', '2025-05-18 09:32:36'),
(641, 3, 1, 13951.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:36', '2025-05-18 09:32:36'),
(642, 4, 2, 14952.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:36', '2025-05-18 09:32:36'),
(643, 4, 2, 10518.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:36', '2025-05-18 09:32:36'),
(644, 5, 2, 12173.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:36', '2025-05-18 09:32:36'),
(645, 5, 2, 10086.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:36', '2025-05-18 09:32:36'),
(646, 6, 2, 10598.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:36', '2025-05-18 09:32:36'),
(647, 6, 2, 11254.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:36', '2025-05-18 09:32:36'),
(648, 7, 3, 122222.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:36', '2025-05-18 09:32:36'),
(649, 7, 3, 14090.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:36', '2025-05-18 09:32:36'),
(650, 8, 3, 10153.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(651, 8, 3, 11151.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(652, 9, 3, 12638.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(653, 9, 3, 11022.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(654, 10, 4, 14629.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(655, 10, 4, 12692.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(656, 11, 4, 12670.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(657, 11, 4, 10406.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(658, 12, 4, 14401.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(659, 12, 4, 12994.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(660, 13, 5, 11529.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(661, 13, 5, 11410.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(662, 14, 5, 14898.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(663, 14, 5, 12908.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(664, 15, 5, 11979.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(665, 15, 5, 10732.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(666, 16, 6, 15000.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(667, 16, 6, 13283.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(668, 17, 6, 13922.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(669, 17, 6, 14173.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:37', '2025-05-18 09:32:37'),
(670, 18, 6, 14707.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:38', '2025-05-18 09:32:38'),
(671, 18, 6, 14258.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:38', '2025-05-18 09:32:38'),
(672, 19, 7, 11362.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:38', '2025-05-18 09:32:38'),
(673, 19, 7, 10945.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:38', '2025-05-18 09:32:38'),
(674, 20, 7, 10800.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:38', '2025-05-18 09:32:38'),
(675, 20, 7, 12312.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:38', '2025-05-18 09:32:38'),
(676, 21, 7, 12506.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:38', '2025-05-18 09:32:38'),
(677, 21, 7, 10178.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:39', '2025-05-18 09:32:39'),
(678, 22, 8, 11049.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:39', '2025-05-18 09:32:39'),
(679, 22, 8, 10595.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:39', '2025-05-18 09:32:39'),
(680, 23, 8, 14898.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:39', '2025-05-18 09:32:39'),
(681, 23, 8, 13350.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:39', '2025-05-18 09:32:39'),
(682, 24, 8, 13723.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:39', '2025-05-18 09:32:39'),
(683, 24, 8, 11744.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:39', '2025-05-18 09:32:39'),
(684, 25, 9, 10495.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:39', '2025-05-18 09:32:39'),
(685, 25, 9, 13464.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:39', '2025-05-18 09:32:39'),
(686, 26, 9, 11301.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:39', '2025-05-18 09:32:39'),
(687, 26, 9, 12331.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:39', '2025-05-18 09:32:39'),
(688, 27, 9, 12285.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:39', '2025-05-18 09:32:39'),
(689, 27, 9, 10089.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:39', '2025-05-18 09:32:39'),
(690, 28, 10, 11720.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:39', '2025-05-18 09:32:39'),
(691, 28, 10, 11028.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:39', '2025-05-18 09:32:39'),
(692, 29, 10, 10640.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:39', '2025-05-18 09:32:39'),
(693, 29, 10, 13461.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:39', '2025-05-18 09:32:39'),
(694, 30, 10, 14009.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:39', '2025-05-18 09:32:39'),
(695, 30, 10, 15058.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:40', '2025-05-18 09:32:40'),
(696, 31, 12, 10111.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:40', '2025-05-18 09:32:40'),
(697, 32, 12, 13456.00, '2025-05-18', 'Pasar Lakessi', '2025-05-18 09:32:40', '2025-05-18 09:32:40'),
(698, 32, 12, 12222.00, '2025-05-18', 'Pasar Sumpang', '2025-05-18 09:32:40', '2025-05-18 09:32:40'),
(699, 1, 1, 12000.00, '2025-05-18', 'Pasar Lakessi', '2025-05-19 00:20:37', '2025-05-19 00:20:37'),
(700, 1, 1, 13000.00, '2025-05-19', 'Pasar Lakessi', '2025-05-19 00:20:51', '2025-05-19 00:20:51'),
(701, 33, 23, 10000.00, '2025-05-18', 'Pasar Lakessi', '2025-05-19 00:23:14', '2025-05-19 00:23:14'),
(702, 33, 23, 20000.00, '2025-05-19', 'Pasar Lakessi', '2025-05-19 00:23:34', '2025-05-19 00:23:34'),
(703, 33, 23, 5321.00, '2025-05-17', 'Pasar Lakessi', '2025-05-19 00:24:31', '2025-05-19 00:24:31'),
(704, 7, 3, 12345.00, '2025-05-19', 'Pasar Lakessi', '2025-05-19 12:18:36', '2025-05-19 12:18:36'),
(705, 7, 3, 23456.00, '2025-05-20', 'Pasar Lakessi', '2025-05-19 12:18:52', '2025-05-19 12:18:52'),
(706, 1, 1, 11985.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(707, 1, 1, 12003.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(708, 1, 1, 12021.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(709, 1, 1, 12018.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(710, 1, 1, 12085.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(711, 1, 1, 14150.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(712, 1, 1, 14167.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(713, 1, 1, 14172.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(714, 1, 1, 14237.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(715, 1, 1, 14238.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(716, 2, 2, 12903.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(717, 2, 2, 12925.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(718, 2, 2, 12939.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(719, 2, 2, 12945.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(720, 2, 2, 12955.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(721, 2, 2, 13943.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(722, 2, 2, 13972.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(723, 2, 2, 13999.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(724, 2, 2, 13994.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(725, 2, 2, 14047.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(726, 3, 3, 10566.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(727, 3, 3, 10576.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(728, 3, 3, 10612.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(729, 3, 3, 10623.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(730, 3, 3, 10638.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(731, 3, 3, 10625.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(732, 3, 3, 10649.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(733, 3, 3, 10683.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(734, 3, 3, 10670.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(735, 3, 3, 10709.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(736, 4, 4, 12901.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(737, 4, 4, 12922.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(738, 4, 4, 12951.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(739, 4, 4, 12970.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(740, 4, 4, 13009.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(741, 4, 4, 13286.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(742, 4, 4, 13312.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(743, 4, 4, 13340.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(744, 4, 4, 13367.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(745, 4, 4, 13406.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(746, 5, 5, 13304.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(747, 5, 5, 13334.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(748, 5, 5, 13332.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(749, 5, 5, 13382.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(750, 5, 5, 13368.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(751, 5, 5, 13395.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(752, 5, 5, 13411.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(753, 5, 5, 13415.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(754, 5, 5, 13455.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(755, 5, 5, 13479.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(756, 6, 6, 10980.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(757, 6, 6, 10992.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(758, 6, 6, 11014.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(759, 6, 6, 11046.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(760, 6, 6, 11080.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(761, 6, 6, 12629.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(762, 6, 6, 12648.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(763, 6, 6, 12671.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(764, 6, 6, 12713.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(765, 6, 6, 12689.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(766, 7, 7, 12005.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(767, 7, 7, 12027.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(768, 7, 7, 12031.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(769, 7, 7, 12044.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(770, 7, 7, 12061.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(771, 7, 7, 10809.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(772, 7, 7, 10822.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(773, 7, 7, 10843.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(774, 7, 7, 10893.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(775, 7, 7, 10889.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(776, 8, 8, 13465.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(777, 8, 8, 13482.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(778, 8, 8, 13491.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(779, 8, 8, 13531.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(780, 8, 8, 13561.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(781, 8, 8, 11398.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(782, 8, 8, 11408.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(783, 8, 8, 11452.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(784, 8, 8, 11488.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(785, 8, 8, 11490.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(786, 9, 9, 12187.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(787, 9, 9, 12201.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(788, 9, 9, 12231.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(789, 9, 9, 12259.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(790, 9, 9, 12227.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(791, 9, 9, 14151.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(792, 9, 9, 14171.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(793, 9, 9, 14173.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(794, 9, 9, 14223.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(795, 9, 9, 14239.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(796, 10, 10, 13603.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(797, 10, 10, 13613.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(798, 10, 10, 13633.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(799, 10, 10, 13678.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(800, 10, 10, 13643.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(801, 10, 10, 12363.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(802, 10, 10, 12380.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(803, 10, 10, 12387.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(804, 10, 10, 12396.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(805, 10, 10, 12475.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(806, 11, 1, 13961.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(807, 11, 1, 13980.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(808, 11, 1, 13997.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(809, 11, 1, 14042.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(810, 11, 1, 14073.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(811, 11, 1, 14793.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(812, 11, 1, 14812.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(813, 11, 1, 14815.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(814, 11, 1, 14841.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(815, 11, 1, 14889.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(816, 12, 2, 13107.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(817, 12, 2, 13131.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(818, 12, 2, 13147.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(819, 12, 2, 13164.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(820, 12, 2, 13147.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(821, 12, 2, 14189.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(822, 12, 2, 14206.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(823, 12, 2, 14247.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(824, 12, 2, 14222.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(825, 12, 2, 14233.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(826, 13, 3, 10676.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(827, 13, 3, 10695.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(828, 13, 3, 10730.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(829, 13, 3, 10715.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(830, 13, 3, 10736.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(831, 13, 3, 10961.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(832, 13, 3, 10984.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(833, 13, 3, 10997.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(834, 13, 3, 11006.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(835, 13, 3, 11045.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(836, 14, 4, 10594.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(837, 14, 4, 10605.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(838, 14, 4, 10654.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(839, 14, 4, 10639.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(840, 14, 4, 10638.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(841, 14, 4, 13759.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(842, 14, 4, 13774.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(843, 14, 4, 13817.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(844, 14, 4, 13816.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(845, 14, 4, 13851.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(846, 15, 5, 13935.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(847, 15, 5, 13958.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(848, 15, 5, 13959.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(849, 15, 5, 13974.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(850, 15, 5, 13991.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(851, 15, 5, 12342.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(852, 15, 5, 12366.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(853, 15, 5, 12396.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(854, 15, 5, 12417.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(855, 15, 5, 12454.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(856, 16, 6, 14692.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(857, 16, 6, 14720.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(858, 16, 6, 14724.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(859, 16, 6, 14743.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(860, 16, 6, 14768.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(861, 16, 6, 11041.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(862, 16, 6, 11068.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(863, 16, 6, 11071.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(864, 16, 6, 11116.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(865, 16, 6, 11125.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(866, 17, 7, 11365.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(867, 17, 7, 11384.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(868, 17, 7, 11395.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(869, 17, 7, 11410.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(870, 17, 7, 11405.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(871, 17, 7, 13690.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(872, 17, 7, 13710.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(873, 17, 7, 13750.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(874, 17, 7, 13750.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(875, 17, 7, 13738.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(876, 18, 8, 11730.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(877, 18, 8, 11755.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(878, 18, 8, 11782.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(879, 18, 8, 11766.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(880, 18, 8, 11814.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(881, 18, 8, 12169.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(882, 18, 8, 12195.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(883, 18, 8, 12223.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(884, 18, 8, 12241.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(885, 18, 8, 12229.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(886, 19, 9, 11330.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(887, 19, 9, 11358.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(888, 19, 9, 11368.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(889, 19, 9, 11420.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(890, 19, 9, 11434.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(891, 19, 9, 14862.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(892, 19, 9, 14890.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(893, 19, 9, 14916.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(894, 19, 9, 14946.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(895, 19, 9, 14978.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(896, 20, 10, 14897.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(897, 20, 10, 14912.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(898, 20, 10, 14941.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(899, 20, 10, 14966.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(900, 20, 10, 15009.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(901, 20, 10, 13741.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(902, 20, 10, 13771.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(903, 20, 10, 13783.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(904, 20, 10, 13783.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(905, 20, 10, 13793.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(906, 21, 1, 12097.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(907, 21, 1, 12109.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(908, 21, 1, 12137.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(909, 21, 1, 12133.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(910, 21, 1, 12217.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(911, 21, 1, 14594.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(912, 21, 1, 14623.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(913, 21, 1, 14644.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(914, 21, 1, 14639.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(915, 21, 1, 14678.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(916, 22, 2, 14378.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(917, 22, 2, 14388.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(918, 22, 2, 14430.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(919, 22, 2, 14408.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(920, 22, 2, 14494.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(921, 22, 2, 10124.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(922, 22, 2, 10147.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(923, 22, 2, 10146.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(924, 22, 2, 10175.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(925, 22, 2, 10232.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(926, 23, 3, 11363.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(927, 23, 3, 11393.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(928, 23, 3, 11421.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(929, 23, 3, 11432.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(930, 23, 3, 11451.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(931, 23, 3, 12343.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(932, 23, 3, 12353.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(933, 23, 3, 12363.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(934, 23, 3, 12415.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(935, 23, 3, 12439.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(936, 24, 4, 14480.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(937, 24, 4, 14502.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(938, 24, 4, 14516.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(939, 24, 4, 14570.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(940, 24, 4, 14556.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(941, 24, 4, 10795.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(942, 24, 4, 10819.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(943, 24, 4, 10851.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(944, 24, 4, 10837.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(945, 24, 4, 10899.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(946, 25, 5, 13948.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(947, 25, 5, 13963.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(948, 25, 5, 14004.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(949, 25, 5, 13978.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(950, 25, 5, 14004.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(951, 25, 5, 10784.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(952, 25, 5, 10799.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(953, 25, 5, 10812.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(954, 25, 5, 10868.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(955, 25, 5, 10876.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(956, 26, 6, 11666.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(957, 26, 6, 11677.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(958, 26, 6, 11722.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(959, 26, 6, 11744.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(960, 26, 6, 11782.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(961, 26, 6, 11180.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(962, 26, 6, 11193.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(963, 26, 6, 11210.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(964, 26, 6, 11261.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(965, 26, 6, 11264.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(966, 27, 7, 14633.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(967, 27, 7, 14663.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(968, 27, 7, 14687.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(969, 27, 7, 14678.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(970, 27, 7, 14685.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(971, 27, 7, 13429.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(972, 27, 7, 13448.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(973, 27, 7, 13477.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(974, 27, 7, 13480.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(975, 27, 7, 13521.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(976, 28, 8, 11324.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(977, 28, 8, 11345.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(978, 28, 8, 11356.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(979, 28, 8, 11381.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(980, 28, 8, 11404.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(981, 28, 8, 13260.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(982, 28, 8, 13279.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(983, 28, 8, 13302.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(984, 28, 8, 13299.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(985, 28, 8, 13372.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(986, 29, 9, 11865.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(987, 29, 9, 11876.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(988, 29, 9, 11901.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(989, 29, 9, 11934.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(990, 29, 9, 11949.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(991, 29, 9, 12430.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(992, 29, 9, 12444.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(993, 29, 9, 12466.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(994, 29, 9, 12505.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(995, 29, 9, 12478.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(996, 30, 10, 13330.00, '2025-05-06', 'Pasar Sumpang', NULL, NULL),
(997, 30, 10, 13359.00, '2025-05-07', 'Pasar Sumpang', NULL, NULL),
(998, 30, 10, 13390.00, '2025-05-08', 'Pasar Sumpang', NULL, NULL),
(999, 30, 10, 13417.00, '2025-05-09', 'Pasar Sumpang', NULL, NULL),
(1000, 30, 10, 13426.00, '2025-05-10', 'Pasar Sumpang', NULL, NULL),
(1001, 30, 10, 10948.00, '2025-05-06', 'Pasar Lakessi', NULL, NULL),
(1002, 30, 10, 10964.00, '2025-05-07', 'Pasar Lakessi', NULL, NULL),
(1003, 30, 10, 10976.00, '2025-05-08', 'Pasar Lakessi', NULL, NULL),
(1004, 30, 10, 11014.00, '2025-05-09', 'Pasar Lakessi', NULL, NULL),
(1005, 30, 10, 11060.00, '2025-05-10', 'Pasar Lakessi', NULL, NULL),
(1006, 1, 1, 12232.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1007, 1, 1, 12258.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1008, 1, 1, 12276.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1009, 1, 1, 12280.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1010, 1, 1, 12348.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1011, 1, 1, 10347.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1012, 1, 1, 10358.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1013, 1, 1, 10369.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1014, 1, 1, 10377.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1015, 1, 1, 10391.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1016, 2, 2, 10291.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1017, 2, 2, 10309.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1018, 2, 2, 10325.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1019, 2, 2, 10348.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1020, 2, 2, 10383.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1021, 2, 2, 13361.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1022, 2, 2, 13381.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1023, 2, 2, 13381.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1024, 2, 2, 13406.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1025, 2, 2, 13417.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1026, 3, 3, 13714.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1027, 3, 3, 13734.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1028, 3, 3, 13750.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1029, 3, 3, 13756.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1030, 3, 3, 13810.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1031, 3, 3, 11965.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1032, 3, 3, 11989.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1033, 3, 3, 12009.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1034, 3, 3, 12013.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1035, 3, 3, 12033.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1036, 4, 4, 14186.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1037, 4, 4, 14214.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1038, 4, 4, 14216.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1039, 4, 4, 14228.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1040, 4, 4, 14266.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1041, 4, 4, 14217.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1042, 4, 4, 14245.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1043, 4, 4, 14241.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1044, 4, 4, 14277.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1045, 4, 4, 14293.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1046, 5, 5, 14839.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1047, 5, 5, 14867.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1048, 5, 5, 14865.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1049, 5, 5, 14914.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1050, 5, 5, 14895.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1051, 5, 5, 14905.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1052, 5, 5, 14919.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1053, 5, 5, 14927.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1054, 5, 5, 14980.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1055, 5, 5, 15013.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1056, 6, 6, 14007.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1057, 6, 6, 14033.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL);
INSERT INTO `index_harga` (`id_index`, `id_barang`, `id_index_kategori`, `harga`, `tanggal`, `lokasi`, `created_at`, `updated_at`) VALUES
(1058, 6, 6, 14055.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1059, 6, 6, 14082.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1060, 6, 6, 14087.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1061, 6, 6, 11878.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1062, 6, 6, 11892.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1063, 6, 6, 11926.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1064, 6, 6, 11944.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1065, 6, 6, 11962.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1066, 7, 7, 12768.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1067, 7, 7, 12792.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1068, 7, 7, 12788.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1069, 7, 7, 12801.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1070, 7, 7, 12824.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1071, 7, 7, 13679.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1072, 7, 7, 13707.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1073, 7, 7, 13709.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1074, 7, 7, 13715.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1075, 7, 7, 13759.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1076, 8, 8, 14029.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1077, 8, 8, 14057.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1078, 8, 8, 14073.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1079, 8, 8, 14107.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1080, 8, 8, 14097.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1081, 8, 8, 11967.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1082, 8, 8, 11995.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1083, 8, 8, 11987.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1084, 8, 8, 12018.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1085, 8, 8, 12059.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1086, 9, 9, 12235.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1087, 9, 9, 12259.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1088, 9, 9, 12291.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1089, 9, 9, 12304.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1090, 9, 9, 12287.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1091, 9, 9, 14792.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1092, 9, 9, 14822.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1093, 9, 9, 14838.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1094, 9, 9, 14822.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1095, 9, 9, 14844.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1096, 10, 10, 12704.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1097, 10, 10, 12721.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1098, 10, 10, 12734.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1099, 10, 10, 12776.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1100, 10, 10, 12820.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1101, 10, 10, 13694.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1102, 10, 10, 13720.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1103, 10, 10, 13748.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1104, 10, 10, 13763.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1105, 10, 10, 13774.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1106, 11, 1, 10257.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1107, 11, 1, 10271.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1108, 11, 1, 10283.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1109, 11, 1, 10338.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1110, 11, 1, 10337.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1111, 11, 1, 12510.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1112, 11, 1, 12536.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1113, 11, 1, 12548.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1114, 11, 1, 12576.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1115, 11, 1, 12574.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1116, 12, 2, 11921.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1117, 12, 2, 11934.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1118, 12, 2, 11981.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1119, 12, 2, 11954.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1120, 12, 2, 11969.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1121, 12, 2, 13790.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1122, 12, 2, 13817.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1123, 12, 2, 13842.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1124, 12, 2, 13820.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1125, 12, 2, 13842.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1126, 13, 3, 11981.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1127, 13, 3, 12004.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1128, 13, 3, 12011.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1129, 13, 3, 12038.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1130, 13, 3, 12029.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1131, 13, 3, 13526.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1132, 13, 3, 13540.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1133, 13, 3, 13564.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1134, 13, 3, 13577.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1135, 13, 3, 13590.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1136, 14, 4, 11504.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1137, 14, 4, 11531.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1138, 14, 4, 11536.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1139, 14, 4, 11582.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1140, 14, 4, 11612.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1141, 14, 4, 10842.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1142, 14, 4, 10865.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1143, 14, 4, 10868.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1144, 14, 4, 10893.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1145, 14, 4, 10934.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1146, 15, 5, 11598.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1147, 15, 5, 11623.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1148, 15, 5, 11636.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1149, 15, 5, 11664.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1150, 15, 5, 11694.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1151, 15, 5, 14158.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1152, 15, 5, 14188.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1153, 15, 5, 14212.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1154, 15, 5, 14206.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1155, 15, 5, 14226.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1156, 16, 6, 12376.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1157, 16, 6, 12397.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1158, 16, 6, 12418.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1159, 16, 6, 12421.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1160, 16, 6, 12428.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1161, 16, 6, 14855.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1162, 16, 6, 14877.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1163, 16, 6, 14913.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1164, 16, 6, 14936.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1165, 16, 6, 14935.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1166, 17, 7, 13889.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1167, 17, 7, 13902.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1168, 17, 7, 13941.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1169, 17, 7, 13928.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1170, 17, 7, 13957.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1171, 17, 7, 11763.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1172, 17, 7, 11781.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1173, 17, 7, 11821.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1174, 17, 7, 11838.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1175, 17, 7, 11803.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1176, 18, 8, 10765.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1177, 18, 8, 10795.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1178, 18, 8, 10801.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1179, 18, 8, 10852.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1180, 18, 8, 10829.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1181, 18, 8, 10392.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1182, 18, 8, 10415.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1183, 18, 8, 10440.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1184, 18, 8, 10470.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1185, 18, 8, 10444.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1186, 19, 9, 11003.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1187, 19, 9, 11025.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1188, 19, 9, 11035.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1189, 19, 9, 11045.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1190, 19, 9, 11079.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1191, 19, 9, 10716.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1192, 19, 9, 10743.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1193, 19, 9, 10764.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1194, 19, 9, 10761.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1195, 19, 9, 10756.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1196, 20, 10, 10175.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1197, 20, 10, 10198.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1198, 20, 10, 10235.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1199, 20, 10, 10247.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1200, 20, 10, 10259.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1201, 20, 10, 14271.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1202, 20, 10, 14292.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1203, 20, 10, 14293.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1204, 20, 10, 14313.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1205, 20, 10, 14375.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1206, 21, 1, 14939.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1207, 21, 1, 14953.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1208, 21, 1, 14999.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1209, 21, 1, 14996.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1210, 21, 1, 14991.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1211, 21, 1, 13186.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1212, 21, 1, 13196.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1213, 21, 1, 13222.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1214, 21, 1, 13216.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1215, 21, 1, 13246.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1216, 22, 2, 14843.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1217, 22, 2, 14863.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1218, 22, 2, 14867.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1219, 22, 2, 14894.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1220, 22, 2, 14943.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1221, 22, 2, 10579.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1222, 22, 2, 10594.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1223, 22, 2, 10631.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1224, 22, 2, 10609.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1225, 22, 2, 10691.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1226, 23, 3, 13869.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1227, 23, 3, 13880.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1228, 23, 3, 13909.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1229, 23, 3, 13920.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1230, 23, 3, 13945.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1231, 23, 3, 11366.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1232, 23, 3, 11382.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1233, 23, 3, 11400.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1234, 23, 3, 11408.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1235, 23, 3, 11478.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1236, 24, 4, 10402.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1237, 24, 4, 10424.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1238, 24, 4, 10434.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1239, 24, 4, 10480.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1240, 24, 4, 10514.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1241, 24, 4, 11130.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1242, 24, 4, 11153.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1243, 24, 4, 11186.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1244, 24, 4, 11220.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1245, 24, 4, 11210.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1246, 25, 5, 12179.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1247, 25, 5, 12199.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1248, 25, 5, 12235.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1249, 25, 5, 12248.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1250, 25, 5, 12227.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1251, 25, 5, 14748.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1252, 25, 5, 14762.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1253, 25, 5, 14770.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1254, 25, 5, 14808.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1255, 25, 5, 14864.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1256, 26, 6, 10907.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1257, 26, 6, 10922.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1258, 26, 6, 10965.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1259, 26, 6, 10994.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1260, 26, 6, 10975.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1261, 26, 6, 12546.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1262, 26, 6, 12572.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1263, 26, 6, 12568.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1264, 26, 6, 12582.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1265, 26, 6, 12594.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1266, 27, 7, 14748.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1267, 27, 7, 14770.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1268, 27, 7, 14794.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1269, 27, 7, 14832.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1270, 27, 7, 14848.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1271, 27, 7, 12802.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1272, 27, 7, 12820.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1273, 27, 7, 12852.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1274, 27, 7, 12850.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1275, 27, 7, 12914.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1276, 28, 8, 13238.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1277, 28, 8, 13257.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1278, 28, 8, 13272.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1279, 28, 8, 13325.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1280, 28, 8, 13282.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1281, 28, 8, 12579.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1282, 28, 8, 12593.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1283, 28, 8, 12639.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1284, 28, 8, 12618.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1285, 28, 8, 12663.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1286, 29, 9, 14408.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1287, 29, 9, 14430.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1288, 29, 9, 14430.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1289, 29, 9, 14495.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1290, 29, 9, 14516.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1291, 29, 9, 11665.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1292, 29, 9, 11688.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1293, 29, 9, 11707.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1294, 29, 9, 11725.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1295, 29, 9, 11725.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1296, 30, 10, 10727.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1297, 30, 10, 10746.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1298, 30, 10, 10763.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1299, 30, 10, 10811.00, '2025-05-21', 'Pasar Sumpang', NULL, NULL),
(1300, 30, 10, 10767.00, '2025-05-22', 'Pasar Sumpang', NULL, NULL),
(1301, 30, 10, 12398.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1302, 30, 10, 12426.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1303, 30, 10, 12432.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1304, 30, 10, 12446.00, '2025-05-21', 'Pasar Lakessi', NULL, NULL),
(1305, 30, 10, 12450.00, '2025-05-22', 'Pasar Lakessi', NULL, NULL),
(1306, 1, 1, 12885.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1307, 1, 1, 12900.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1308, 1, 1, 12909.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1309, 1, 1, 12936.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1310, 1, 1, 12941.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1311, 1, 1, 19400.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1312, 1, 1, 19428.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1313, 1, 1, 19452.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1314, 1, 1, 19457.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1315, 1, 1, 19456.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1316, 2, 2, 20431.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1317, 2, 2, 20442.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1318, 2, 2, 20453.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1319, 2, 2, 20509.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1320, 2, 2, 20499.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1321, 2, 2, 11489.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1322, 2, 2, 11503.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1323, 2, 2, 11527.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1324, 2, 2, 11549.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1325, 2, 2, 11609.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1326, 3, 3, 19872.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1327, 3, 3, 19902.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1328, 3, 3, 19920.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1329, 3, 3, 19926.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1330, 3, 3, 19960.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1331, 3, 3, 19583.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1332, 3, 3, 19603.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1333, 3, 3, 19633.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1334, 3, 3, 19652.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1335, 3, 3, 19635.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1336, 4, 4, 14271.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1337, 4, 4, 14298.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1338, 4, 4, 14321.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1339, 4, 4, 14331.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1340, 4, 4, 14379.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1341, 4, 4, 12141.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1342, 4, 4, 12151.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1343, 4, 4, 12169.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1344, 4, 4, 12204.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1345, 4, 4, 12233.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1346, 5, 5, 19609.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1347, 5, 5, 19622.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1348, 5, 5, 19641.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1349, 5, 5, 19684.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1350, 5, 5, 19729.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1351, 5, 5, 12281.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1352, 5, 5, 12299.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1353, 5, 5, 12327.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1354, 5, 5, 12317.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1355, 5, 5, 12365.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1356, 6, 6, 17236.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1357, 6, 6, 17247.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1358, 6, 6, 17266.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1359, 6, 6, 17326.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1360, 6, 6, 17332.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1361, 6, 6, 12618.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1362, 6, 6, 12642.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1363, 6, 6, 12674.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1364, 6, 6, 12708.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1365, 6, 6, 12670.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1366, 7, 7, 21649.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1367, 7, 7, 21662.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1368, 7, 7, 21695.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1369, 7, 7, 21706.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1370, 7, 7, 21729.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1371, 7, 7, 14158.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1372, 7, 7, 14172.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1373, 7, 7, 14196.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1374, 7, 7, 14194.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1375, 7, 7, 14262.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1376, 8, 8, 11885.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1377, 8, 8, 11901.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1378, 8, 8, 11923.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1379, 8, 8, 11936.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1380, 8, 8, 11949.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1381, 8, 8, 18154.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1382, 8, 8, 18169.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1383, 8, 8, 18182.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1384, 8, 8, 18202.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1385, 8, 8, 18202.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1386, 9, 9, 20546.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1387, 9, 9, 20571.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1388, 9, 9, 20578.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1389, 9, 9, 20609.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1390, 9, 9, 20610.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1391, 9, 9, 14368.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1392, 9, 9, 14396.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1393, 9, 9, 14392.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1394, 9, 9, 14425.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1395, 9, 9, 14488.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1396, 10, 10, 21510.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1397, 10, 10, 21522.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1398, 10, 10, 21548.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1399, 10, 10, 21561.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1400, 10, 10, 21626.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1401, 10, 10, 24057.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1402, 10, 10, 24070.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1403, 10, 10, 24103.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1404, 10, 10, 24144.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1405, 10, 10, 24177.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1406, 11, 1, 19930.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1407, 11, 1, 19951.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1408, 11, 1, 19988.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1409, 11, 1, 19960.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1410, 11, 1, 19986.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1411, 11, 1, 10198.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1412, 11, 1, 10223.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1413, 11, 1, 10258.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1414, 11, 1, 10237.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1415, 11, 1, 10246.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1416, 12, 2, 16578.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1417, 12, 2, 16593.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1418, 12, 2, 16632.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1419, 12, 2, 16644.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1420, 12, 2, 16626.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1421, 12, 2, 24662.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1422, 12, 2, 24688.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1423, 12, 2, 24704.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1424, 12, 2, 24752.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1425, 12, 2, 24774.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1426, 13, 3, 24051.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1427, 13, 3, 24061.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1428, 13, 3, 24085.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1429, 13, 3, 24114.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1430, 13, 3, 24131.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1431, 13, 3, 20550.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1432, 13, 3, 20580.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1433, 13, 3, 20592.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1434, 13, 3, 20598.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1435, 13, 3, 20646.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1436, 14, 4, 15166.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1437, 14, 4, 15177.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1438, 14, 4, 15200.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1439, 14, 4, 15244.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1440, 14, 4, 15246.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1441, 14, 4, 11727.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1442, 14, 4, 11743.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1443, 14, 4, 11757.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1444, 14, 4, 11778.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1445, 14, 4, 11803.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1446, 15, 5, 19838.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1447, 15, 5, 19850.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1448, 15, 5, 19872.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1449, 15, 5, 19892.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1450, 15, 5, 19938.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1451, 15, 5, 18820.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1452, 15, 5, 18844.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1453, 15, 5, 18840.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1454, 15, 5, 18874.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1455, 15, 5, 18924.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1456, 16, 6, 12637.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1457, 16, 6, 12665.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1458, 16, 6, 12679.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1459, 16, 6, 12706.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1460, 16, 6, 12717.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1461, 16, 6, 13733.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1462, 16, 6, 13756.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1463, 16, 6, 13785.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1464, 16, 6, 13802.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1465, 16, 6, 13841.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1466, 17, 7, 13992.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1467, 17, 7, 14017.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1468, 17, 7, 14042.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1469, 17, 7, 14043.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1470, 17, 7, 14032.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1471, 17, 7, 18606.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1472, 17, 7, 18622.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1473, 17, 7, 18628.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1474, 17, 7, 18651.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1475, 17, 7, 18694.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1476, 18, 8, 19237.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1477, 18, 8, 19247.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1478, 18, 8, 19271.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1479, 18, 8, 19273.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1480, 18, 8, 19329.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1481, 18, 8, 10115.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1482, 18, 8, 10135.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1483, 18, 8, 10143.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1484, 18, 8, 10151.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1485, 18, 8, 10175.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1486, 19, 9, 16066.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1487, 19, 9, 16086.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1488, 19, 9, 16102.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1489, 19, 9, 16120.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1490, 19, 9, 16174.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1491, 19, 9, 17264.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1492, 19, 9, 17282.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1493, 19, 9, 17298.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1494, 19, 9, 17348.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1495, 19, 9, 17316.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1496, 20, 10, 14370.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1497, 20, 10, 14400.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1498, 20, 10, 14426.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1499, 20, 10, 14430.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1500, 20, 10, 14478.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1501, 20, 10, 12729.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1502, 20, 10, 12744.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1503, 20, 10, 12785.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1504, 20, 10, 12810.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1505, 20, 10, 12777.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1506, 21, 1, 15281.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1507, 21, 1, 15294.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1508, 21, 1, 15313.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1509, 21, 1, 15347.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1510, 21, 1, 15381.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1511, 21, 1, 18116.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1512, 21, 1, 18139.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1513, 21, 1, 18162.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1514, 21, 1, 18197.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1515, 21, 1, 18204.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1516, 22, 2, 14979.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1517, 22, 2, 15006.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1518, 22, 2, 15029.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1519, 22, 2, 15063.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1520, 22, 2, 15047.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1521, 22, 2, 17839.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1522, 22, 2, 17862.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1523, 22, 2, 17875.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1524, 22, 2, 17893.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1525, 22, 2, 17911.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1526, 23, 3, 15944.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1527, 23, 3, 15957.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1528, 23, 3, 15980.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1529, 23, 3, 15989.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1530, 23, 3, 15988.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1531, 23, 3, 11924.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1532, 23, 3, 11952.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1533, 23, 3, 11976.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1534, 23, 3, 12014.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1535, 23, 3, 11984.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1536, 24, 4, 11979.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1537, 24, 4, 11996.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1538, 24, 4, 12029.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1539, 24, 4, 12015.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1540, 24, 4, 12079.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1541, 24, 4, 19187.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1542, 24, 4, 19211.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1543, 24, 4, 19217.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1544, 24, 4, 19235.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1545, 24, 4, 19263.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1546, 25, 5, 24031.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1547, 25, 5, 24052.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1548, 25, 5, 24091.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1549, 25, 5, 24082.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1550, 25, 5, 24091.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1551, 25, 5, 18941.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1552, 25, 5, 18968.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1553, 25, 5, 18995.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1554, 25, 5, 19019.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1555, 25, 5, 19037.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1556, 26, 6, 20271.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1557, 26, 6, 20290.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1558, 26, 6, 20309.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1559, 26, 6, 20319.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1560, 26, 6, 20355.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1561, 26, 6, 15131.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1562, 26, 6, 15147.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1563, 26, 6, 15185.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1564, 26, 6, 15164.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1565, 26, 6, 15223.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1566, 27, 7, 17564.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1567, 27, 7, 17594.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1568, 27, 7, 17622.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1569, 27, 7, 17636.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1570, 27, 7, 17628.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1571, 27, 7, 23155.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1572, 27, 7, 23182.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1573, 27, 7, 23189.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1574, 27, 7, 23242.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1575, 27, 7, 23275.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1576, 28, 8, 19631.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1577, 28, 8, 19644.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1578, 28, 8, 19651.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1579, 28, 8, 19664.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1580, 28, 8, 19711.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1581, 28, 8, 15525.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1582, 28, 8, 15555.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1583, 28, 8, 15585.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1584, 28, 8, 15570.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1585, 28, 8, 15613.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1586, 29, 9, 22288.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1587, 29, 9, 22314.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1588, 29, 9, 22340.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1589, 29, 9, 22351.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1590, 29, 9, 22356.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1591, 29, 9, 18394.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1592, 29, 9, 18416.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1593, 29, 9, 18418.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1594, 29, 9, 18439.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1595, 29, 9, 18466.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL),
(1596, 30, 10, 21880.00, '2025-05-16', 'Pasar Sumpang', NULL, NULL),
(1597, 30, 10, 21890.00, '2025-05-17', 'Pasar Sumpang', NULL, NULL),
(1598, 30, 10, 21902.00, '2025-05-18', 'Pasar Sumpang', NULL, NULL),
(1599, 30, 10, 21925.00, '2025-05-19', 'Pasar Sumpang', NULL, NULL),
(1600, 30, 10, 21924.00, '2025-05-20', 'Pasar Sumpang', NULL, NULL),
(1601, 30, 10, 19396.00, '2025-05-16', 'Pasar Lakessi', NULL, NULL),
(1602, 30, 10, 19410.00, '2025-05-17', 'Pasar Lakessi', NULL, NULL),
(1603, 30, 10, 19434.00, '2025-05-18', 'Pasar Lakessi', NULL, NULL),
(1604, 30, 10, 19486.00, '2025-05-19', 'Pasar Lakessi', NULL, NULL),
(1605, 30, 10, 19456.00, '2025-05-20', 'Pasar Lakessi', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `index_kategori`
--

CREATE TABLE `index_kategori` (
  `id_index_kategori` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `index_kategori`
--

INSERT INTO `index_kategori` (`id_index_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'beras', NULL, NULL),
(2, 'cabe', NULL, NULL),
(3, 'ayam', NULL, NULL),
(4, 'bawang', NULL, NULL),
(5, 'telur', NULL, NULL),
(6, 'daging', NULL, NULL),
(7, 'ikan', NULL, NULL),
(8, 'tahu', NULL, NULL),
(9, 'tempe', NULL, NULL),
(10, 'tomat', NULL, NULL),
(11, 'Susu', NULL, NULL),
(12, 'Keju', NULL, NULL),
(13, 'Madu', NULL, NULL),
(14, 'Minyak Goreng', NULL, NULL),
(15, 'Gula', NULL, NULL),
(16, 'Kopi', NULL, NULL),
(17, 'Teh', NULL, NULL),
(18, 'Cokelat', NULL, NULL),
(19, 'Buah Apel', NULL, NULL),
(20, 'Buah Pisang', NULL, NULL),
(21, 'Sayur Bayam', NULL, NULL),
(22, 'Sayur Wortel', NULL, NULL),
(23, 'elektronik', '2025-05-19 00:22:55', '2025-05-19 00:22:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_alat`
--

CREATE TABLE `jenis_alat` (
  `id_jenis_alat` bigint(20) UNSIGNED NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `nama_alat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
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
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
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
-- Struktur dari tabel `kategori_barang_pelaporan`
--

CREATE TABLE `kategori_barang_pelaporan` (
  `id_kategori_barang_pelaporan` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
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
(7, '2025_04_28_110001_create_alat_tera_table', 1),
(8, '2025_04_28_110002_create_jenis_alat_table', 1),
(9, '2025_04_28_110003_create_cap_tanda_tera_table', 1),
(10, '2025_04_28_120000_create_uttp_table', 1),
(11, '2025_04_28_121746_create_data_alat_ukur_table', 1),
(12, '2025_05_01_125413_create_distributor_table', 1),
(13, '2025_05_01_132307_create_kategori_barang_pelaporan_table', 1),
(14, '2025_05_01_132610_create_barang_pelaporan_table', 1),
(15, '2025_05_01_133122_create_rencana_kebutuhan_distributor_table', 1),
(16, '2025_05_01_133603_create_toko_table', 1),
(17, '2025_05_01_134203_create_stok_opname_table', 1),
(18, '2025_05_07_132826_create_form_permohonan_table', 2),
(19, '2025_05_07_134534_create_document_user_table', 3),
(20, '2025_05_04_150736_create_index_kategori_table', 4),
(21, '2025_05_09_190002_create_distribusi_pupuk_table', 5),
(22, '2025_05_05_151323_create_index_harga_table', 6),
(23, '2025_05_12_214739_create_forum_diskusi_table', 7),
(25, '2025_05_20_105607_add_id_distributor_to_toko_table', 8),
(26, '2025_05_08_234441_surat_metrologi', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
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

--
-- Dumping data untuk tabel `rencana_kebutuhan_distributor`
--

INSERT INTO `rencana_kebutuhan_distributor` (`id_rancangan`, `id_barang_pelaporan`, `tahun`, `jumlah`, `created_at`, `updated_at`) VALUES
(4, NULL, '2025', 1000, '2025-05-21 00:19:54', '2025-05-21 00:19:54'),
(5, NULL, '2025', 1000, '2025-05-21 00:27:03', '2025-05-21 00:27:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3YTkbZlfKhsF9VLBqERYuRFkhO5o3cCQpgBARCOh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRkVpVzl3MTZhVkZ2Z0pyNm1xeFFpSDY1blNlS2NvYks4MjNCR0lpdiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYWJpZC1wZXJkYWdhbmdhbi9kaXN0cmlidXNpLXB1cHVrIjt9czo1MzoibG9naW5fZGlzZGFnXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjk6ImlkX2Rpc2RhZyI7aTo1O30=', 1747834166),
('6UZUR7cf4gD2aFBPcxHYDu8bMrR7Ta3cv5jPlNiR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQWlEUklsdjJYdFN0RVI0TFFyWUMzZVdOOVJxcUVnMEU0NDFwN2U5WCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NTM6ImxvZ2luX2Rpc2RhZ181OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7czo5OiJpZF9kaXNkYWciO2k6NTt9', 1747822984),
('bwOQnWUEuYHTWQj9Z0cihK3KWxLjl4STHroOxSIB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiZ3lOOXBRd0dmZ25SeW1hZGZvdU1aOEhRY2dCWDFnM2RvTTZKd1lTeSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NTM6ImxvZ2luX2Rpc2RhZ181OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czo5OiJpZF9kaXNkYWciO2k6MjtzOjUxOiJsb2dpbl91c2VyXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjc6ImlkX3VzZXIiO2k6Mzt9', 1747817938),
('CkvaCV6OQzRPLTkwcHzntMb1crCqqJFTyQ3ABKYX', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTW9Oa29HVmpISWc2WEo5MWVxeGR6UGRFbm1LVG9WdEszd1oySmVtRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1747818168),
('OxUZLQGIJDDKMrcT5faagefiRY5vbW0GLLJu7azo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOUQ1YXhmYUNCVnZQMFhScVRSTHpKVkVLeHlBZGVwNk1Xb3lSQnhQUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYWJpZC1wZXJkYWdhbmdhbi9kaXN0cmlidXNpLXB1cHVrIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747823154),
('qOVEoDaBbNo1k6K8r2p7suRU3FsZrm2kUaPiVf3Y', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiMWF0czlqa3UxVWRrQ05RRkRQZ0VZb0laRklTcmVsVlhxNzNlZWtjSSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747817965),
('RR7wnalMCoX6RX4mY4EtS1vUUuqc3dTABq3xoPl3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiN3FWaFhyVkc1NzF0S2h2a0RaTEQyYkpHcHMxSll0TjFFNmxpU2gxcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTE6ImxvZ2luX3VzZXJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO3M6NzoiaWRfdXNlciI7aTozO30=', 1747833936),
('Z54i7WA5MGVTO47vDmEsghBzCUyzSQZbl8UkhgDh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVkZkZVdoVkFZOU1yMTZyVXlCbmQyNW9OVkZKMmtaOGVHTG9BNUFFNiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTE6ImxvZ2luX3VzZXJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6NzoiaWRfdXNlciI7aToyO30=', 1747833239),
('ZfbU8TG6K8f3udhr0kx32hYbO19qrWrfubk56iyJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQlhVNE1zZVFjdE5QaTdVOFBVemNPRGl2YU5hM3ZGajR5YjdZOW85RiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1747820045);

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
  `nama_barang` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stok_opname`
--

INSERT INTO `stok_opname` (`id_stok_opname`, `id_distributor`, `id_toko`, `stok_awal`, `penyaluran`, `stok_akhir`, `tanggal`, `nama_barang`, `created_at`, `updated_at`) VALUES
(1, 2, 7, 200, 190, 10, '2025-05-01', 'UREA', '2025-05-21 00:21:51', '2025-05-21 00:21:51'),
(2, 2, 7, 120, 119, 1, '2025-05-01', 'NPK', '2025-05-21 00:25:57', '2025-05-21 00:25:57'),
(3, 2, 8, 200, 120, 80, '2025-05-01', 'NPK', '2025-05-21 00:28:37', '2025-05-21 00:28:37'),
(4, 2, 7, 120, 111, 9, '2025-05-09', 'NPK', '2025-05-21 00:29:57', '2025-05-21 00:29:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluar_metrologi`
--

CREATE TABLE `surat_keluar_metrologi` (
  `id_surat_balasan` bigint(20) UNSIGNED NOT NULL,
  `id_surat` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `isi_surat` text DEFAULT NULL,
  `path_dokumen` varchar(255) DEFAULT NULL,
  `status_surat_keluar` varchar(50) DEFAULT NULL,
  `status_kepalaBidang` varchar(50) DEFAULT NULL,
  `stasus_kadis` varchar(50) DEFAULT NULL,
  `keterangan_kadis` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_metrologi`
--

CREATE TABLE `surat_metrologi` (
  `id_surat` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `alamat_alat` varchar(255) DEFAULT NULL,
  `jenis_surat` enum('tera','tera_ulang') NOT NULL DEFAULT 'tera',
  `dokumen` varchar(255) DEFAULT NULL,
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
  `nama_toko` varchar(255) NOT NULL,
  `no_register` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id_toko`, `id_rancangan`, `id_distributor`, `nama_toko`, `no_register`, `kecamatan`, `created_at`, `updated_at`) VALUES
(7, 4, 2, 'Uceng Gacor', '1090239', 'Bacukiki Barat', '2025-05-21 00:19:56', '2025-05-21 00:19:56'),
(8, 5, 2, 'tio Gacor', '39293', 'Bacukiki Barat', '2025-05-21 00:27:03', '2025-05-21 00:27:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `kabupaten` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nib` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `telp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `kecamatan`, `kelurahan`, `kabupaten`, `password`, `nik`, `nib`, `nama`, `alamat_lengkap`, `jenis_kelamin`, `telp`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Watang Sawito', 'Maccoralaie', 'Kabupaten Pinrang', '$2y$12$3zMclYl1psRTB9/FymAz8uj8GwJRdkyHLR8tIYwE0JBiBFwAu0PeK', '7315045802050001', '1234567890', 'Andi Magfirah Maqbul', 'Jl. Balaikota No.1, Bumi Harapan, Kec. Bacukiki Bar., Kota Parepare, Sulawesi Selatan 91122', 'Perempuan', '085255196113', 'andifff12@gmail.com', '2025-05-08 00:32:07', '2025-05-08 00:32:07'),
(2, 'Watang Sawito', 'Maccoralaie', 'Kabupaten Pinrang', '$2y$12$ZFv2P8oCN/.IYBbms5o5lehv5NXySERVHi2CcBTW6Muqpv1addUYu', '7315045802050002', NULL, 'Andi Magfirah', 'Ulutedong', 'Perempuan', '085255196113', 'andimagfirahmaqbul12@gmail.com', '2025-05-12 11:58:46', '2025-05-12 11:58:46'),
(3, 'Lansirang', 'Waetuoe', 'Kabupaten Pinrang', '$2y$12$wP/xfaWoXCTJSTSjf.di7OE8nJvIE2LbyXjMDGSru8og8Sfwi157W', '7315045802050003', NULL, 'tes', 'Jl. Balaikota No.1, Bumi Harapan, Kec. Bacukiki Bar., Kota Parepare, Sulawesi Selatan 91122', 'Perempuan', '085255196113', 'app@gmail.com', '2025-05-17 05:39:42', '2025-05-17 05:39:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
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
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `tanggal_penginputan` date DEFAULT NULL,
  `no_registrasi` varchar(255) DEFAULT NULL,
  `nama_usaha` varchar(255) DEFAULT NULL,
  `jenis_alat` varchar(255) DEFAULT NULL,
  `nama_alat` varchar(255) DEFAULT NULL,
  `merk_type` varchar(255) DEFAULT NULL,
  `nomor_seri` varchar(255) DEFAULT NULL,
  `jumlah_alat` int(11) DEFAULT NULL,
  `alat_penguji` varchar(255) DEFAULT NULL,
  `ctt` varchar(255) DEFAULT NULL,
  `spt_keperluan` varchar(255) DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `terapan` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `uttp`
--

INSERT INTO `uttp` (`id_uttp`, `id_user`, `tanggal_penginputan`, `no_registrasi`, `nama_usaha`, `jenis_alat`, `nama_alat`, `merk_type`, `nomor_seri`, `jumlah_alat`, `alat_penguji`, `ctt`, `spt_keperluan`, `tanggal_selesai`, `terapan`, `keterangan`, `created_at`, `updated_at`) VALUES
(7, 1, '2025-05-17', 'REG-1678', 'test', 'UP-MK', 'sfdsdf', '873a', '32fwefefr2', 2, 'BUS', 'SL4', 'p', '2025-05-29', 'efghasdw', 'bkjjkjk', '2025-05-19 00:08:10', '2025-05-19 08:01:27'),
(8, 1, '2025-05-14', 'REG-23467567', 'test', 'VOL-TUM', 'tes', '123j', '32fwefefr2', 3, 'AT', 'D4', NULL, '2025-05-22', NULL, NULL, '2025-05-19 02:08:55', '2025-05-19 08:01:34'),
(9, 1, '2025-05-08', 'REG-167', 'Paaaaa', 'VOL-TUTSIT', '2000 liter', '123j', '32fwefefr2', 3, 'ATB', 'JP8', '192.140.434.4/70/disdag', '2025-05-29', NULL, NULL, '2025-05-19 08:46:46', '2025-05-19 08:47:21'),
(10, 1, '2025-05-20', 'REG-234', 'test', 'VOL-PUBBM', NULL, NULL, NULL, 2, 'BUS', 'SL6', NULL, '2025-05-22', NULL, 'BUS', '2025-05-19 08:51:15', '2025-05-19 08:51:15'),
(11, 1, '2025-05-22', 'REG-23432r3asd', 'test', 'VOL-TUM', NULL, NULL, NULL, 1, 'BUS', 'SL6', NULL, '2025-05-30', NULL, 'BUS', '2025-05-19 08:51:52', '2025-05-19 08:51:52'),
(12, 1, '2025-05-20', 'dawd2deq2', 'test', 'MAS-NE', '22 kg', '123j', '32fwefefr2', 2, 'BUS', 'SL6', NULL, '2025-05-23', NULL, 'AT', '2025-05-20 14:49:33', '2025-05-20 14:49:33'),
(13, 1, '2025-05-15', 'REG-234w2', 'test', 'UP-MK', '2000 liter', '123j', '32fwefefr2', 3, 'BUS', 'SL6', NULL, '2025-05-30', NULL, 'AT', '2025-05-20 14:50:08', '2025-05-20 14:50:08'),
(14, 1, '2025-05-15', 'REG-234awdw', 'test', 'UP-MK', '2 m', '123j', '32fwefefr2', 1, 'BUS', 'SL6', NULL, '2025-05-30', NULL, 'BUS', '2025-05-20 14:50:48', '2025-05-20 14:50:48'),
(15, 1, '2025-05-16', 'REG-167awd2', 'P', 'VOL-TUM', '2 liter', '123j', '32fwefefr2', 2, 'BUS', 'SL6', NULL, '2025-05-22', NULL, 'BUS', '2025-05-20 14:52:29', '2025-05-20 14:54:05'),
(16, 1, '2025-05-17', 'REG-234wd2daw', 'test', 'UP-MK', '2 m', '123j', '2813971289', 1, 'BUS', 'SL6', NULL, '2025-05-23', NULL, 'AT', '2025-05-20 14:53:28', '2025-05-20 14:53:53'),
(17, 1, '2025-05-22', 'REG-234wd2dawwad', 'test', 'UP-MK', '1m', '123j', '2813971289', 2, 'BUS', 'SL6', NULL, '2025-05-23', NULL, 'AT', '2025-05-20 14:55:18', '2025-05-20 14:55:18'),
(18, 2, '2025-05-10', 'REG-234wdwsdaw', 'usaha1', 'VOL-TUM', '2 liter', '123j', '2813971289', 2, 'BUS', 'SL6', NULL, '2025-05-22', NULL, 'BUS', '2025-05-20 14:56:53', '2025-05-20 14:56:53'),
(19, 1, '2025-05-17', 'REG-167asd2ds', 'test', 'VOL-PUBBM', '2 liter', '873a', '32fwefefr2', 2, 'BUS', 'SL6', NULL, '2025-05-22', NULL, 'BUS', '2025-05-20 14:57:31', '2025-05-20 14:57:31'),
(20, 2, '2025-05-20', 'REG-167adww', 'test', 'UP-MK', '2 m', '123j', '2813971289', 3, 'BUS', 'SL6', NULL, '2025-05-23', NULL, 'BUS', '2025-05-20 15:05:18', '2025-05-20 15:05:18');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alat_tera`
--
ALTER TABLE `alat_tera`
  ADD PRIMARY KEY (`id_alat_tera`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `barang_pelaporan`
--
ALTER TABLE `barang_pelaporan`
  ADD PRIMARY KEY (`id_barang_pelaporan`),
  ADD KEY `barang_pelaporan_id_kategori_barang_pelaporan_foreign` (`id_kategori_barang_pelaporan`);

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
-- Indeks untuk tabel `cap_tanda_tera`
--
ALTER TABLE `cap_tanda_tera`
  ADD PRIMARY KEY (`id_cap`);

--
-- Indeks untuk tabel `data_alat_ukur`
--
ALTER TABLE `data_alat_ukur`
  ADD PRIMARY KEY (`id_data_alat`),
  ADD KEY `data_alat_ukur_id_user_foreign` (`id_user`),
  ADD KEY `data_alat_ukur_id_uttp_foreign` (`id_uttp`);

--
-- Indeks untuk tabel `disdag`
--
ALTER TABLE `disdag`
  ADD PRIMARY KEY (`id_disdag`),
  ADD UNIQUE KEY `disdag_nip_unique` (`nip`),
  ADD UNIQUE KEY `disdag_email_unique` (`email`);

--
-- Indeks untuk tabel `distribusi_pupuk`
--
ALTER TABLE `distribusi_pupuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`id_distributor`),
  ADD UNIQUE KEY `distributor_nib_unique` (`nib`),
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
  ADD KEY `forum_diskusi_id_disdag_foreign` (`id_disdag`),
  ADD KEY `forum_diskusi_id_user_foreign` (`id_user`);

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
-- Indeks untuk tabel `jenis_alat`
--
ALTER TABLE `jenis_alat`
  ADD PRIMARY KEY (`id_jenis_alat`);

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
-- Indeks untuk tabel `kategori_barang_pelaporan`
--
ALTER TABLE `kategori_barang_pelaporan`
  ADD PRIMARY KEY (`id_kategori_barang_pelaporan`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `rencana_kebutuhan_distributor`
--
ALTER TABLE `rencana_kebutuhan_distributor`
  ADD PRIMARY KEY (`id_rancangan`),
  ADD KEY `rencana_kebutuhan_distributor_id_barang_pelaporan_foreign` (`id_barang_pelaporan`);

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
  ADD PRIMARY KEY (`id_surat_balasan`);

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
-- AUTO_INCREMENT untuk tabel `alat_tera`
--
ALTER TABLE `alat_tera`
  MODIFY `id_alat_tera` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `barang_pelaporan`
--
ALTER TABLE `barang_pelaporan`
  MODIFY `id_barang_pelaporan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `cap_tanda_tera`
--
ALTER TABLE `cap_tanda_tera`
  MODIFY `id_cap` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_alat_ukur`
--
ALTER TABLE `data_alat_ukur`
  MODIFY `id_data_alat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `disdag`
--
ALTER TABLE `disdag`
  MODIFY `id_disdag` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `distribusi_pupuk`
--
ALTER TABLE `distribusi_pupuk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `distributor`
--
ALTER TABLE `distributor`
  MODIFY `id_distributor` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `document_user`
--
ALTER TABLE `document_user`
  MODIFY `id_document` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `forum_diskusi`
--
ALTER TABLE `forum_diskusi`
  MODIFY `id_pengaduan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT untuk tabel `index_harga`
--
ALTER TABLE `index_harga`
  MODIFY `id_index` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1606;

--
-- AUTO_INCREMENT untuk tabel `index_kategori`
--
ALTER TABLE `index_kategori`
  MODIFY `id_index_kategori` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `jenis_alat`
--
ALTER TABLE `jenis_alat`
  MODIFY `id_jenis_alat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `kategori_barang_pelaporan`
--
ALTER TABLE `kategori_barang_pelaporan`
  MODIFY `id_kategori_barang_pelaporan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `rencana_kebutuhan_distributor`
--
ALTER TABLE `rencana_kebutuhan_distributor`
  MODIFY `id_rancangan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `stok_opname`
--
ALTER TABLE `stok_opname`
  MODIFY `id_stok_opname` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `surat_keluar_metrologi`
--
ALTER TABLE `surat_keluar_metrologi`
  MODIFY `id_surat_balasan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `uttp`
--
ALTER TABLE `uttp`
  MODIFY `id_uttp` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang_pelaporan`
--
ALTER TABLE `barang_pelaporan`
  ADD CONSTRAINT `barang_pelaporan_id_kategori_barang_pelaporan_foreign` FOREIGN KEY (`id_kategori_barang_pelaporan`) REFERENCES `kategori_barang_pelaporan` (`id_kategori_barang_pelaporan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_id_disdag_foreign` FOREIGN KEY (`id_disdag`) REFERENCES `disdag` (`id_disdag`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_alat_ukur`
--
ALTER TABLE `data_alat_ukur`
  ADD CONSTRAINT `data_alat_ukur_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
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
