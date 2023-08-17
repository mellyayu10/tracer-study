-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Agu 2023 pada 05.29
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tracerstudy`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alumni`
--

CREATE TABLE `alumni` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `nim` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bulan_masuk` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `bulan_lulus` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota_kab` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `alumni`
--

INSERT INTO `alumni` (`id`, `user_id`, `nim`, `prodi_id`, `jenis_kelamin`, `bulan_masuk`, `tahun_masuk`, `bulan_lulus`, `tahun_lulus`, `foto`, `tanggal_lahir`, `alamat`, `provinsi`, `kota_kab`, `kecamatan`, `kelurahan`, `created_at`, `updated_at`) VALUES
(1, 2, '42319017', 1, 'P', '9', 2019, '8', 2023, 'alumni/u3jqjCFbnbJov0ZF7US6EUKeK1d8qTVYLJ9eck7q.jpg', '2000-08-10', 'jl. manggis', NULL, NULL, NULL, NULL, '2023-08-16 03:21:28', '2023-08-16 03:21:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_kategori_kuisioner`
--

CREATE TABLE `detail_kategori_kuisioner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_kuisioner_id` int(11) NOT NULL,
  `nama_soal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_soal` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_kuisioner` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_kategori_kuisioner`
--

INSERT INTO `detail_kategori_kuisioner` (`id`, `kategori_kuisioner_id`, `nama_soal`, `slug`, `tipe_soal`, `is_kuisioner`, `created_at`, `updated_at`) VALUES
(1, 7, 'Berapa banyak Perusahaan yang Mengundang Anda Untuk Wawancara ?', 'berapa-banyak-perusahaan-yang-mengundang-anda-untuk-wawancara', '3', '0', '2023-08-16 03:19:44', '2023-08-16 03:19:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi_login`
--

CREATE TABLE `informasi_login` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `informasi_login`
--

INSERT INTO `informasi_login` (`id`, `user_id`, `tanggal`) VALUES
(1, 1, '2023-08-16 10:18:47'),
(2, 2, '2023-08-16 10:22:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `instansi`
--

CREATE TABLE `instansi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_instansi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota_kab` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `instansi`
--

INSERT INTO `instansi` (`id`, `nama_instansi`, `provinsi`, `kota_kab`, `kecamatan`, `kelurahan`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'PT. Cyberblitz Nusantara', 'JAWA BARAT', 'KOTA BANDUNG', 'CIBIRU', 'CISURUPAN', 'jl. cisurupan', '2023-08-16 03:25:22', '2023-08-16 03:25:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Isian', '2023-08-16 03:18:13', '2023-08-16 03:18:13'),
(2, 'Pilihan Ganda', '2023-08-16 03:18:13', '2023-08-16 03:18:13'),
(3, 'Pilihan Tunggal', '2023-08-16 03:18:13', '2023-08-16 03:18:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_kuisioner`
--

CREATE TABLE `kategori_kuisioner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori_kuisioner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `tipe_kuisioner` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_kuisioner`
--

INSERT INTO `kategori_kuisioner` (`id`, `nama_kategori_kuisioner`, `slug`, `status`, `tipe_kuisioner`, `created_at`, `updated_at`) VALUES
(1, 'Data Pribadi', 'data-pribadi', '0', '1', '2023-08-16 03:18:13', '2023-08-16 03:18:13'),
(2, 'Data Akademik', 'data-akademik', '0', '1', '2023-08-16 03:18:13', '2023-08-16 03:18:13'),
(3, 'Data Pekerjaan', 'data-pekerjaan', '0', '1', '2023-08-16 03:18:13', '2023-08-16 03:18:13'),
(4, 'Data Bagi Alumni Yang Melanjutkan Studi Lanjut', 'data-bagi-alumni-yang-melanjutkan-studi-lanjut', '0', '1', '2023-08-16 03:18:13', '2023-08-16 03:18:13'),
(5, 'Data Alumni Yang Berwirausaha', 'data-alumni-yang-berwirausaha', '0', '1', '2023-08-16 03:18:13', '2023-08-16 03:18:13'),
(6, 'Kesan dan Saran', 'kesan-dan-saran', '0', '1', '2023-08-16 03:18:13', '2023-08-16 03:18:13'),
(7, 'IDENTITAS LEMBAGA ATAU PERUSAHAAN', 'identitas-lembaga-atau-perusahaan', '1', '2', '2023-08-16 03:18:13', '2023-08-16 03:19:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuis_mahasiswa`
--

CREATE TABLE `kuis_mahasiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alumni_id` int(11) NOT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_isi_kuis` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuis_pengguna_alumni`
--

CREATE TABLE `kuis_pengguna_alumni` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `riwayat_pekerjaan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_isi_kuis` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kuis_pengguna_alumni`
--

INSERT INTO `kuis_pengguna_alumni` (`id`, `riwayat_pekerjaan_id`, `text`, `tanggal_isi_kuis`) VALUES
(1, '71b96456e71e496e9d8c5a9dabe916b4', '{\"_token\":\"WgfWsEb7OsGIiB7hcCdhvsWpD9kiXlgaupP0yDQs\",\"berapa-banyak-perusahaan-yang-mengundang-anda-untuk-wawancara_1\":\"1\"}', '2023-08-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2023_05_29_172717_create_informasi_login_table', 1),
(4, '2023_06_01_012532_create_alumni_table', 1),
(5, '2023_06_01_025454_create_prodi_table', 1),
(6, '2023_06_04_172539_create_riwayat_pekerjaan_table', 1),
(7, '2023_06_22_190317_create_kategori_kuisioner_table', 1),
(8, '2023_06_22_230754_create_detail_kategori_kuisioner_table', 1),
(9, '2023_06_23_144514_create_point_pilihan_ganda_table', 1),
(10, '2023_06_23_150802_create_setting_kategori_kuisioner_table', 1),
(11, '2023_06_23_151521_create_kategori_table', 1),
(12, '2023_06_23_164935_create_point_pilihan_tunggal_table', 1),
(13, '2023_06_23_204358_create_kuis_mahasiswa_table', 1),
(14, '2023_06_25_024921_create_kuis_pengguna_alumni_table', 1),
(15, '2023_07_15_140617_create_rekomendasi_alumni_table', 1),
(16, '2023_07_24_002418_create_instansi_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `point_pilihan_ganda`
--

CREATE TABLE `point_pilihan_ganda` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detail_kategori_kuisioner_id` int(11) NOT NULL,
  `nama_point` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `point_pilihan_tunggal`
--

CREATE TABLE `point_pilihan_tunggal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detail_kategori_kuisioner_id` int(11) NOT NULL,
  `nama_point` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_child` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `point_pilihan_tunggal`
--

INSERT INTO `point_pilihan_tunggal` (`id`, `detail_kategori_kuisioner_id`, `nama_point`, `is_child`, `created_at`, `updated_at`) VALUES
(1, 1, 'etika', '1', '2023-08-16 03:20:04', '2023-08-16 03:20:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_prodi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id`, `nama_prodi`, `created_at`, `updated_at`) VALUES
(1, 'Sistem Informasi', '2023-08-16 03:19:12', '2023-08-16 03:19:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekomendasi_alumni`
--

CREATE TABLE `rekomendasi_alumni` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alumni_id` int(11) NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomer_hp` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_pekerjaan`
--

CREATE TABLE `riwayat_pekerjaan` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alumni_id` int(11) NOT NULL,
  `nama_instansi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_instansi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skala` enum('Nasional','Lokal','Internasional') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profesi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penghasilan_tiap_bulan` double DEFAULT NULL,
  `periode_bulan_mulai` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periode_kerja_mulai` year(4) DEFAULT NULL,
  `periode_bulan_akhir` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periode_kerja_akhir` year(4) DEFAULT NULL,
  `pengguna_alumni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `divisi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_hp` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota_kab` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_kuisioner` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `riwayat_pekerjaan`
--

INSERT INTO `riwayat_pekerjaan` (`id`, `alumni_id`, `nama_instansi`, `alamat_instansi`, `skala`, `profesi`, `penghasilan_tiap_bulan`, `periode_bulan_mulai`, `periode_kerja_mulai`, `periode_bulan_akhir`, `periode_kerja_akhir`, `pengguna_alumni`, `divisi`, `email`, `nomor_hp`, `provinsi`, `kota_kab`, `kecamatan`, `kelurahan`, `is_kuisioner`, `status`, `created_at`, `updated_at`) VALUES
('71b96456e71e496e9d8c5a9dabe916b4', 1, 'PT. Cyberblitz Nusantara', 'jl. cisurupan', 'Nasional', 'Manajer', 10000000, '9', 2023, NULL, NULL, 'Johan', 'TI', 'johan@gmail.com', '+6285649441676', 'JAWA BARAT', 'KOTA BANDUNG', 'CIBIRU', 'CISURUPAN', 1, 0, '2023-08-16 03:25:23', '2023-08-16 03:26:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting_kategori_kuisioner`
--

CREATE TABLE `setting_kategori_kuisioner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_kuisioner_id` int(11) NOT NULL,
  `setting` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `setting_kategori_kuisioner`
--

INSERT INTO `setting_kategori_kuisioner` (`id`, `kategori_kuisioner_id`, `setting`, `created_at`, `updated_at`) VALUES
(1, 7, 3, '2023-08-16 03:19:28', '2023-08-16 03:19:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_hp` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `akses` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `nomor_hp`, `created_by`, `akses`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator', 'admin@gmail.com', '$2y$10$IfLhtgRCitUEiOQoN6or0exFCmRqkNCeydfNSRXLL7numQhRp3E.e', '085324237299', NULL, 'admin', NULL, '2023-08-16 03:18:13', '2023-08-16 03:18:13'),
(2, 'Melly Ayu Fajrian', '42319017', 'mellyayufajryan@gmail.com', '$2y$10$A.dzlH2zYzim3a1bR19n.O.CX9zJCuiQtiU/ZLQgxWHyHOwSjZB3i', '085649441676', NULL, 'alumni', NULL, '2023-08-16 03:21:28', '2023-08-16 03:21:28');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_kategori_kuisioner`
--
ALTER TABLE `detail_kategori_kuisioner`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `informasi_login`
--
ALTER TABLE `informasi_login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_kuisioner`
--
ALTER TABLE `kategori_kuisioner`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kuis_mahasiswa`
--
ALTER TABLE `kuis_mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kuis_pengguna_alumni`
--
ALTER TABLE `kuis_pengguna_alumni`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `point_pilihan_ganda`
--
ALTER TABLE `point_pilihan_ganda`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `point_pilihan_tunggal`
--
ALTER TABLE `point_pilihan_tunggal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekomendasi_alumni`
--
ALTER TABLE `rekomendasi_alumni`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `riwayat_pekerjaan`
--
ALTER TABLE `riwayat_pekerjaan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `riwayat_pekerjaan_email_unique` (`email`);

--
-- Indeks untuk tabel `setting_kategori_kuisioner`
--
ALTER TABLE `setting_kategori_kuisioner`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_kategori_kuisioner`
--
ALTER TABLE `detail_kategori_kuisioner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `informasi_login`
--
ALTER TABLE `informasi_login`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `instansi`
--
ALTER TABLE `instansi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kategori_kuisioner`
--
ALTER TABLE `kategori_kuisioner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kuis_mahasiswa`
--
ALTER TABLE `kuis_mahasiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kuis_pengguna_alumni`
--
ALTER TABLE `kuis_pengguna_alumni`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `point_pilihan_ganda`
--
ALTER TABLE `point_pilihan_ganda`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `point_pilihan_tunggal`
--
ALTER TABLE `point_pilihan_tunggal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rekomendasi_alumni`
--
ALTER TABLE `rekomendasi_alumni`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `setting_kategori_kuisioner`
--
ALTER TABLE `setting_kategori_kuisioner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
