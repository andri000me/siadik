-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Des 2019 pada 17.13
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sk_siadik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `deal`
--

CREATE TABLE `deal` (
  `kd_booking` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_properti` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_deal` date NOT NULL,
  `pembayaran_klien` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pembayaran_pemilik` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_komisi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_perjanjian` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_listing` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `deal`
--

INSERT INTO `deal` (`kd_booking`, `kd_properti`, `tgl_deal`, `pembayaran_klien`, `pembayaran_pemilik`, `form_komisi`, `form_perjanjian`, `form_listing`, `keterangan`, `created_at`, `updated_at`) VALUES
('BK-122019-001', 'PR-122019-001', '2019-12-25', 'BK-122019-001.pdf', 'BK-122019-001.pdf', 'BK-122019-001.pdf', 'BK-122019-001.pdf', 'BK-122019-001.pdf', NULL, '2019-12-24 17:00:00', '2019-12-24 17:00:00'),
('BK-122019-002', 'PR-122019-001', '2019-12-12', 'BK-122019-002.PNG', NULL, NULL, NULL, 'BK-122019-002.PNG', '', '2019-12-25 07:37:24', '2019-12-25 07:37:24'),
('BK-122019-003', 'PR-122019-001', '2019-12-20', 'BK-122019-003.jpg', NULL, NULL, NULL, NULL, '', '2019-12-25 07:39:35', '2019-12-25 07:39:35'),
('BK-122019-004', 'PR-122019-002', '2019-12-19', 'BK-122019-004.png', 'BK-122019-004.png', 'BK-122019-004.docx', 'BK-122019-004.docx', 'BK-122019-004.docx', '', '2019-12-25 10:04:33', '2019-12-25 10:04:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `iklan`
--

CREATE TABLE `iklan` (
  `kd_hos` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_properti` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advertising` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `iklan`
--

INSERT INTO `iklan` (`kd_hos`, `kd_properti`, `keterangan`, `advertising`, `created_at`, `updated_at`) VALUES
('HOS-122019-001', 'PR-122019-001', 'TEST ajaaaa', 11, '2019-12-25 03:28:04', '2019-12-25 03:28:20'),
('HOS-122019-002', 'PR-122019-002', 'fadfad\r\n\r\n', 11, '2019-12-25 09:13:44', '2019-12-25 09:19:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `properti`
--

CREATE TABLE `properti` (
  `kd_properti` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telemarketing` int(10) UNSIGNED NOT NULL,
  `kd_foto` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pemilik` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_pemilik` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic` enum('Pemilik','Kuasa Pemilik') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pemilik',
  `status` enum('Jual','Sewa','Jual & Sewa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Jual',
  `kondisi` enum('Baru','Second') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Baru',
  `jenis` enum('Tanah','Rumah','Ruko','Apartemen','Ruang Usaha','Lainnya') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Rumah',
  `alamat_properti` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luas_tanah` double(8,2) DEFAULT 0.00,
  `luas_bangunan` double(8,2) DEFAULT 0.00,
  `panjang` int(11) DEFAULT 0,
  `lebar` int(11) DEFAULT 0,
  `sertifikat` enum('hs','shm') COLLATE utf8mb4_unicode_ci DEFAULT 'hs',
  `imb` enum('Y','T') COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `orientasi` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kamar` int(11) DEFAULT 0,
  `listrik` int(11) DEFAULT 0,
  `lantai` int(11) DEFAULT 0,
  `kamar_mandi` int(11) DEFAULT 0,
  `air` enum('PAM','Sumur','Jetpum') COLLATE utf8mb4_unicode_ci DEFAULT 'PAM',
  `jenis_lantai` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `garasi` int(11) DEFAULT 0,
  `line_tlp` int(11) DEFAULT 0,
  `tahun` year(4) DEFAULT NULL,
  `fully_furnish` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semi_furnish` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_penawaran` bigint(20) NOT NULL,
  `komisi` float NOT NULL,
  `terjual` enum('Y','T') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'T',
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `properti`
--

INSERT INTO `properti` (`kd_properti`, `telemarketing`, `kd_foto`, `nama_pemilik`, `alamat_pemilik`, `telp`, `fax`, `email`, `pic`, `status`, `kondisi`, `jenis`, `alamat_properti`, `luas_tanah`, `luas_bangunan`, `panjang`, `lebar`, `sertifikat`, `imb`, `orientasi`, `kamar`, `listrik`, `lantai`, `kamar_mandi`, `air`, `jenis_lantai`, `garasi`, `line_tlp`, `tahun`, `fully_furnish`, `semi_furnish`, `harga_penawaran`, `komisi`, `terjual`, `keterangan`, `created_at`, `updated_at`) VALUES
('PR-122019-001', 10, 'FT-122019-006', 'Haviz Indra Maulana', 'Jakarta', '123123', '', 'viz.ndinq@gmail.com', 'Pemilik', 'Jual', 'Baru', 'Rumah', 'Jakarta', 10.00, 30.00, 5, 5, 'hs', 'Y', 'Utara', 2, 1400, 4, 2, 'PAM', 'Oke', 0, NULL, 2019, 'Y', 'Y', 1200000000, 10, 'Y', '', '2019-12-25 00:55:07', '2019-12-25 00:55:07'),
('PR-122019-002', 10, 'FT-122019-015', 'Lutfi', 'Jakarta', '123123', '', '', 'Pemilik', 'Jual', 'Baru', 'Rumah', 'Jl, Joglo', 0.00, 0.00, 0, 0, NULL, NULL, '', 0, 0, 0, 0, NULL, '', 0, NULL, 0000, NULL, NULL, 100000000, 10, 'Y', '', '2019-12-25 09:04:27', '2019-12-25 09:04:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `showing`
--

CREATE TABLE `showing` (
  `kd_showing` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_properti` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cs` int(10) UNSIGNED NOT NULL,
  `agen` int(10) UNSIGNED DEFAULT NULL,
  `nama_klien` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tlp_klien` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_showing` date NOT NULL,
  `jam_showing` time NOT NULL,
  `status` enum('Batal','Proses','Selesai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `showing`
--

INSERT INTO `showing` (`kd_showing`, `kd_properti`, `cs`, `agen`, `nama_klien`, `tlp_klien`, `tgl_showing`, `jam_showing`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
('SW-00000001', 'PR-122019-001', 12, 9, 'Wahyu Alfarisi', '123123', '2019-12-28', '11:00:00', 'Proses', NULL, '2019-12-24 17:00:00', '2019-12-24 17:00:00'),
('SW-00000002', 'PR-122019-001', 12, 13, 'TEST', '123123', '0000-00-00', '19:45:00', 'Proses', 'TEST', '2019-12-25 06:44:46', '2019-12-25 06:44:46'),
('SW-00000003', 'PR-122019-001', 12, 13, 'test', '123', '2019-12-12', '20:00:00', 'Proses', '', '2019-12-25 06:47:51', '2019-12-25 06:47:51'),
('SW-00000004', 'PR-122019-002', 12, 9, 'gugu', '123122', '2019-12-20', '23:00:00', 'Proses', '', '2019-12-25 09:56:17', '2019-12-25 09:56:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `survei_foto`
--

CREATE TABLE `survei_foto` (
  `kd_foto` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agen` int(10) UNSIGNED NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Proses','Konfirmasi','Tolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Proses',
  `foto_1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_3` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_4` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_5` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `survei_foto`
--

INSERT INTO `survei_foto` (`kd_foto`, `agen`, `alamat`, `status`, `foto_1`, `foto_2`, `foto_3`, `foto_4`, `foto_5`, `keterangan`, `created_at`, `updated_at`) VALUES
('FT-062019-001', 9, 'Jakarta', 'Tolak', 'foto_1_001.jpg', 'foto_2_001.jpg', 'foto_3_001.jpg', 'foto_4_001.jpg', 'foto_5_001.jpg', 'Test', '2019-10-30 17:00:00', '2019-10-30 17:00:00'),
('FT-122019-002', 9, 'Test ajaaaaaaa', 'Proses', 'FT-122019-002.PNG', 'FT-122019-002.jpg', 'FT-122019-002.jpg', 'FT-122019-002.jpg', 'FT-122019-002.jpg', '', '2019-12-19 08:47:23', '2019-12-20 00:02:43'),
('FT-122019-006', 13, 'Test ajaaaaaaa', 'Konfirmasi', 'FT-122019-006.PNG', 'FT-122019-006.PNG', 'FT-122019-006.PNG', 'FT-122019-006.PNG', 'FT-122019-006.PNG', '', '2019-12-19 10:17:23', '2019-12-19 10:17:23'),
('FT-122019-008', 13, 'Test ajaaaaaaa', 'Proses', 'FT-122019-008.PNG', 'FT-122019-008.PNG', 'FT-122019-008.PNG', 'FT-122019-008.PNG', 'FT-122019-008.PNG', '', '2019-12-19 10:32:02', '2019-12-19 10:32:02'),
('FT-122019-009', 13, 'Test ajaaaaaaa', 'Tolak', 'FT-122019-009.PNG', 'FT-122019-009.PNG', 'FT-122019-009.PNG', 'FT-122019-009.PNG', 'FT-122019-009.PNG', '', '2019-12-19 10:33:28', '2019-12-19 10:33:28'),
('FT-122019-010', 13, 'Test ajaaaaaaa', 'Tolak', 'FT-122019-010.PNG', 'FT-122019-010.PNG', 'FT-122019-010.PNG', 'FT-122019-010.PNG', 'FT-122019-010.PNG', '', '2019-12-19 10:34:28', '2019-12-19 10:34:28'),
('FT-122019-011', 13, 'Test ajaaaaaaa', 'Tolak', 'FT-122019-011.PNG', 'FT-122019-011.PNG', 'FT-122019-011.PNG', 'FT-122019-011.PNG', 'FT-122019-011.PNG', '', '2019-12-19 10:34:54', '2019-12-19 10:34:54'),
('FT-122019-012', 9, 'Jakarta Timur', 'Proses', 'FT-122019-012.png', 'FT-122019-012.jpg', 'FT-122019-012.jpg', 'FT-122019-012.jpg', 'FT-122019-012.jpg', 'Ini Keterangan', '2019-12-25 08:47:23', '2019-12-25 08:47:23'),
('FT-122019-013', 9, 'TEST', 'Proses', 'FT-122019-013.png', 'FT-122019-013.png', 'FT-122019-013.png', 'FT-122019-013.png', 'FT-122019-013.png', 'TEST', '2019-12-25 08:53:00', '2019-12-25 08:53:00'),
('FT-122019-014', 9, 'TEST', 'Tolak', 'FT-122019-014.png', 'FT-122019-014.png', 'FT-122019-014.jpg', 'FT-122019-014.PNG', 'FT-122019-014.jpg', '', '2019-12-25 08:53:19', '2019-12-25 08:53:19'),
('FT-122019-015', 9, 'TEST', 'Konfirmasi', 'FT-122019-015.png', 'FT-122019-015.PNG', 'FT-122019-015.jpg', 'FT-122019-015.png', 'FT-122019-015.jpg', '', '2019-12-25 08:53:43', '2019-12-25 08:53:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aktif` enum('Y','T') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'T',
  `level` enum('Agen','Telemarketing','Advertising','Cs','Manager') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Agen',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `username`, `password`, `telepon`, `aktif`, `level`, `created_at`, `updated_at`) VALUES
(9, 'Haviz Indra Maulana', 'havizIM', 'havizIM', '08987748441', 'Y', 'Agen', '2019-10-29 01:39:01', NULL),
(10, 'Dian Ratna Sari', 'dianrs', 'dianrs', '123123123', 'Y', 'Telemarketing', '2019-10-29 01:39:01', NULL),
(11, 'Devan Dirgantara Putra', 'devandp', 'devandp', '08987748441', 'Y', 'Advertising', '2019-10-29 01:39:01', NULL),
(12, 'Kalyssa Innara Putri', 'kalyssaip', 'kalyssaip', '08987748441', 'Y', 'Cs', '2019-10-29 01:39:01', NULL),
(13, 'Arthur Ramabani', 'arthur', 'arthur', '08987748441', 'Y', 'Manager', '2019-10-29 01:39:01', NULL),
(19, 'Test yaaa', 'test aja', 'test aja', '123', 'Y', 'Agen', NULL, NULL),
(20, 'Test', 'test', 'test', '123123', 'Y', 'Agen', '2019-12-19 10:36:54', '2019-12-19 10:36:54');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `deal`
--
ALTER TABLE `deal`
  ADD PRIMARY KEY (`kd_booking`),
  ADD KEY `deal_kd_properti_foreign` (`kd_properti`);

--
-- Indeks untuk tabel `iklan`
--
ALTER TABLE `iklan`
  ADD PRIMARY KEY (`kd_hos`),
  ADD KEY `iklan_kd_properti_foreign` (`kd_properti`),
  ADD KEY `iklan_advertising_foreign` (`advertising`);

--
-- Indeks untuk tabel `properti`
--
ALTER TABLE `properti`
  ADD PRIMARY KEY (`kd_properti`),
  ADD KEY `properti_telemarketing_foreign` (`telemarketing`),
  ADD KEY `properti_kd_foto_foreign` (`kd_foto`);

--
-- Indeks untuk tabel `showing`
--
ALTER TABLE `showing`
  ADD PRIMARY KEY (`kd_showing`),
  ADD KEY `showing_kd_properti_foreign` (`kd_properti`),
  ADD KEY `agen` (`agen`),
  ADD KEY `cs` (`cs`);

--
-- Indeks untuk tabel `survei_foto`
--
ALTER TABLE `survei_foto`
  ADD PRIMARY KEY (`kd_foto`),
  ADD KEY `survei_foto_agen_foreign` (`agen`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `deal`
--
ALTER TABLE `deal`
  ADD CONSTRAINT `deal_kd_properti_foreign` FOREIGN KEY (`kd_properti`) REFERENCES `properti` (`kd_properti`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `iklan`
--
ALTER TABLE `iklan`
  ADD CONSTRAINT `iklan_advertising_foreign` FOREIGN KEY (`advertising`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE,
  ADD CONSTRAINT `iklan_kd_properti_foreign` FOREIGN KEY (`kd_properti`) REFERENCES `properti` (`kd_properti`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `properti`
--
ALTER TABLE `properti`
  ADD CONSTRAINT `properti_kd_foto_foreign` FOREIGN KEY (`kd_foto`) REFERENCES `survei_foto` (`kd_foto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `properti_telemarketing_foreign` FOREIGN KEY (`telemarketing`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `showing`
--
ALTER TABLE `showing`
  ADD CONSTRAINT `showing_ibfk_1` FOREIGN KEY (`cs`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE,
  ADD CONSTRAINT `showing_ibfk_2` FOREIGN KEY (`agen`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE,
  ADD CONSTRAINT `showing_kd_properti_foreign` FOREIGN KEY (`kd_properti`) REFERENCES `properti` (`kd_properti`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `survei_foto`
--
ALTER TABLE `survei_foto`
  ADD CONSTRAINT `survei_foto_agen_foreign` FOREIGN KEY (`agen`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
