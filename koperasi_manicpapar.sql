-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Feb 2022 pada 17.55
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi_manicpapar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `angsuran`
--

CREATE TABLE `angsuran` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pinjam` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `periode_bayar` varchar(20) NOT NULL,
  `nominal` double NOT NULL,
  `keterangan` text DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `kode_hapus` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `angsuran`
--

INSERT INTO `angsuran` (`id`, `id_user`, `id_pinjam`, `tgl_bayar`, `periode_bayar`, `nominal`, `keterangan`, `bukti_bayar`, `kode_hapus`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2022-02-18', 'Bulanan', 50000, NULL, NULL, 0, '2022-02-17 20:42:03', '2022-02-17 20:42:03'),
(2, 2, 1, '2022-02-21', '2', 50000, NULL, '1645415354100.00b65ba9a16e3e43c3c06f303d53e121.jpg', 0, '2022-02-20 20:49:14', '2022-02-20 20:49:14'),
(3, 11, 3, '2021-06-09', '1', 500000, 'Tunai', NULL, 0, '2022-02-21 23:32:55', '2022-02-21 23:32:55'),
(4, 11, 3, '2021-07-20', '2', 500000, 'Tunai', NULL, 0, '2022-02-21 23:33:23', '2022-02-21 23:33:23'),
(5, 11, 3, '2022-02-15', '3', 500000, NULL, NULL, 0, '2022-02-22 01:31:20', '2022-02-22 01:31:20'),
(6, 12, 4, '2022-02-22', '1', 250000, NULL, NULL, 0, '2022-02-22 08:18:09', '2022-02-22 08:51:43'),
(7, 12, 4, '2022-02-22', '2', 3950000, NULL, NULL, 0, '2022-02-22 08:57:42', '2022-02-22 08:57:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `golongan`
--

CREATE TABLE `golongan` (
  `id` int(11) NOT NULL,
  `golongan` varchar(15) NOT NULL,
  `uang_makan` double NOT NULL,
  `kode_hapus` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `golongan`
--

INSERT INTO `golongan` (`id`, `golongan`, `uang_makan`, `kode_hapus`, `created_at`, `updated_at`) VALUES
(1, 'Satu / I', 1100000, 0, '2022-02-15 20:30:02', '2022-02-19 05:01:07'),
(2, 'Dua / II', 1200000, 0, '2022-02-15 20:30:55', '2022-02-19 05:01:16'),
(4, 'Tiga / III', 1300000, 0, '2022-02-19 05:01:35', '2022-02-19 05:01:35'),
(5, 'Gratis', 0, 0, '2022-02-19 05:02:42', '2022-02-19 05:02:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id` int(11) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `kode_hapus` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id`, `jenis`, `keterangan`, `kode_hapus`, `created_at`, `updated_at`) VALUES
(1, 'Simpanan Pokok', 'Rp. 500.000 Sekali Bayar Di awal', 0, '2022-02-15 20:16:12', '2022-02-18 23:07:13'),
(4, 'Simpanan Wajib', 'Rp. 50.000/bulan', 0, '2022-02-16 04:38:36', '2022-02-18 23:07:53'),
(5, 'Simpanan Sukarela', 'Sesuai keinginan anggota', 0, '2022-02-18 23:10:13', '2022-02-18 23:10:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `nominal` double NOT NULL,
  `keterangan` text DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status` enum('Menunggu Konfirmasi','Dikonfirmasi') NOT NULL DEFAULT 'Menunggu Konfirmasi',
  `kode_hapus` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_siswa`, `tgl_bayar`, `nominal`, `keterangan`, `bukti_bayar`, `status`, `kode_hapus`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-02-18', 1000000, 'A', '164514858099.Use Case.jpg', 'Dikonfirmasi', 1, '2022-02-17 18:43:00', '2022-02-17 18:43:00'),
(2, 2, '2022-02-01', 1200000, 'Tunai', NULL, 'Menunggu Konfirmasi', 0, '2022-02-21 23:41:53', '2022-02-21 23:43:58'),
(3, 2, '2022-01-07', 1200000, NULL, NULL, 'Menunggu Konfirmasi', 0, '2022-02-21 23:54:53', '2022-02-21 23:54:53'),
(7, 3, '2002-11-07', 1200000, 'Ea at veritatis veli', NULL, 'Menunggu Konfirmasi', 0, '2022-02-22 06:51:41', '2022-02-22 06:52:58'),
(8, 3, '1981-03-08', 1200000, 'Id dolore irure vol', NULL, 'Menunggu Konfirmasi', 0, '2022-02-22 06:54:15', '2022-02-22 06:54:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `nominal` double NOT NULL,
  `keterangan` text DEFAULT NULL,
  `tgl_lunas` date DEFAULT NULL,
  `status` enum('Lunas','Belum Lunas') NOT NULL DEFAULT 'Belum Lunas',
  `kode_hapus` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pinjaman`
--

INSERT INTO `pinjaman` (`id`, `id_user`, `tgl_pinjam`, `nominal`, `keterangan`, `tgl_lunas`, `status`, `kode_hapus`, `created_at`, `updated_at`) VALUES
(1, 2, '2022-02-15', 400000, 'Lorem ipsum dolor sit amet', NULL, 'Belum Lunas', 1, '2022-02-16 07:18:35', '2022-02-16 07:19:16'),
(2, 4, '1974-05-01', 90000, 'Culpa in tempor occ', NULL, 'Belum Lunas', 1, '2022-02-16 07:19:44', '2022-02-16 08:00:21'),
(3, 11, '2020-12-24', 5000000, 'Pinjaman Tunai', NULL, 'Belum Lunas', 0, '2022-02-21 23:31:35', '2022-02-21 23:31:35'),
(4, 12, '2022-02-20', 4000000, 'Pinjaman untuk biaya pendidikan anak', '2022-02-22', 'Lunas', 0, '2022-02-22 01:33:14', '2022-02-22 08:20:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanan`
--

CREATE TABLE `simpanan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `tgl_simpan` date NOT NULL,
  `nominal` double NOT NULL,
  `keterangan` text DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `kode_hapus` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `simpanan`
--

INSERT INTO `simpanan` (`id`, `id_user`, `id_jenis`, `tgl_simpan`, `nominal`, `keterangan`, `bukti_bayar`, `kode_hapus`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2022-01-16', 600000, 'Hello summernote', '1645015601100.Bukti Pembayaran.jpeg', 1, '2022-02-16 05:07:25', '2022-02-16 05:46:41'),
(2, 6, 1, '1995-07-05', 16, 'Deleniti veniam neq', NULL, 1, '2022-02-16 05:23:23', '2022-02-16 05:23:23'),
(3, 2, 4, '2022-02-19', 50000, 'Tunai', NULL, 1, '2022-02-19 04:59:14', '2022-02-19 04:59:14'),
(4, 7, 4, '2022-02-21', 50000, 'Tunai', NULL, 1, '2022-02-20 22:12:26', '2022-02-20 22:12:26'),
(5, 7, 1, '2022-01-05', 500000, NULL, NULL, 1, '2022-02-21 04:40:15', '2022-02-21 04:40:15'),
(6, 4, 4, '2022-11-02', 99, 'Sit est quia sint ac', NULL, 1, '2022-02-21 04:40:41', '2022-02-21 04:40:41'),
(7, 10, 1, '2022-01-17', 500000, 'Tunai', NULL, 0, '2022-02-21 04:54:55', '2022-02-21 04:54:55'),
(8, 11, 4, '2022-01-06', 600000, 'Tunai', NULL, 0, '2022-02-21 23:17:31', '2022-02-21 23:17:31'),
(9, 10, 4, '2022-01-12', 300000, 'Tunai', NULL, 0, '2022-02-21 23:18:24', '2022-02-21 23:18:24'),
(10, 12, 4, '2022-01-13', 50000, 'Tunai', NULL, 0, '2022-02-21 23:21:49', '2022-02-21 23:21:49'),
(11, 2, 1, '2022-02-23', 500000, 'Tunai', NULL, 0, '2022-02-21 23:22:15', '2022-02-21 23:22:15'),
(12, 12, 4, '2022-02-10', 50000, 'Tunai', NULL, 0, '2022-02-21 23:22:47', '2022-02-21 23:22:47'),
(13, 11, 4, '2022-02-22', 50000, 'Tunai', NULL, 0, '2022-02-22 01:34:17', '2022-02-22 01:34:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nisn` int(11) NOT NULL,
  `id_golongan` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `nama_ortu` varchar(30) NOT NULL,
  `nohp_ortu` varchar(15) NOT NULL,
  `kode_hapus` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `nisn`, `id_golongan`, `nama`, `gender`, `alamat`, `nama_ortu`, `nohp_ortu`, `kode_hapus`, `created_at`, `updated_at`) VALUES
(1, 100952, 1, 'Difa Fadmadila Azzahra', 'Perempuan', 'Komplek Perumnas Balai Baru Halaban Bukittinggi', 'Nur Malawati', '+6282387072785', 1, NULL, '2022-02-18 22:34:55'),
(2, 100953, 2, 'Rian Alfa Nurfalah', 'Laki-laki', 'Bukittingging', 'Supriadi', '628876893458', 1, '2022-02-15 23:11:35', '2022-02-15 23:11:35'),
(3, 66119688, 2, 'AHMAD SYAUQY ALLIEF', 'Laki-laki', 'Jl. Pasaman Baru No. 42 Simpang Empat', 'Marton', '+6281266836494', 0, '2022-02-21 23:38:43', '2022-02-21 23:38:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(65) NOT NULL,
  `role` enum('Anggota','Atasan','Admin') NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tempat_lahir` varchar(30) DEFAULT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `pekerjaan` varchar(30) NOT NULL,
  `kode_hapus` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `nama`, `tempat_lahir`, `tgl_lahir`, `alamat`, `nohp`, `foto`, `pekerjaan`, `kode_hapus`, `created_at`, `updated_at`) VALUES
(1, 'atasan', '$2y$10$GRBMrxFHxyxwP4KhtqNINuScIHtx9To/WruZaturw9I13aAZ5S8w2', 'Atasan', 'Kepala Sekola', 'Pariaman', '1969-06-12', 'Padang Pariaman', '000000000001', '1645237437100.logo.png', 'Kepala Sekolah', 1, NULL, '2022-02-18 19:23:56'),
(2, 'admin', '$2y$10$8ddhqcJhy.wTKfgqfFPituEp.reFaBHbTO.RV/jC5GHU/ZzO2/T4K', 'Admin', 'Zahratul Aini Akbar', 'Bukittinggi', '2000-02-21', 'Padang Pariaman', '+628229831908', '1645326983100.2572b4acb22cb3ba7bf9d97690383aae--wood-burning-red-moon.jpg', 'Staf IT', 0, NULL, '2022-02-21 05:07:57'),
(3, 'nahuninomo', '$2y$10$CWm0zCLOdAHendz0tZxdee4P7tf79k0nzJmwIH/Z2d9sge6CnTW6u', 'Admin', 'Eaque ut accusamus s', 'Qui natus doloremque', '1987-03-09', 'Sequi ullam eos nihi', '12345678900', NULL, 'Consequatur amet a', 1, NULL, NULL),
(4, 'anggota', '$2y$10$q55ATa1/w3EbuEs3E.N9k.i7wFjICB96SCyVhN9gkpxe0nJg3OtLu', 'Anggota', 'Dummy', 'Padang Panjang', '1985-05-24', 'dummydummydummy', '6283899196999', '164494197499.pic7.jpg', 'Guru', 1, NULL, '2022-02-15 20:05:04'),
(5, 'wewecuhyn', '$2y$10$d.cPuUK3KPOzqBo4VS/l8uPziR8v0xgCWN/vo2TREbz9LVVuClbDK', 'Admin', 'Vel sapiente et debi', 'Autem temporibus exc', '1975-04-22', 'Tempore necessitati', '765740653476', NULL, 'Neque officiis molli', 1, '2022-02-15 19:53:03', '2022-02-15 19:53:03'),
(6, 'kyzeqys', '$2y$10$CZa8G16j17S0TZkq7WyK1.dJ6axU4oMRqgeush24Nu.WnlI9lLwva', 'Admin', 'ecrrsbtru', 'Dolorem est placeat', '2011-11-20', 'Voluptas laboriosam', '7564344461545', NULL, 'Perferendis accusant', 1, '2022-02-16 04:45:07', '2022-02-16 04:45:19'),
(7, 'Zahra', '$2y$10$SDfB9yF3AWol.MMNObw9wuzlgC8dTlipMksa7ERIzAgGf0A5KsXu.', 'Anggota', 'Zahra', 'Bukittinggi', '2022-01-30', 'BKT', '9090909090', NULL, 'Pegawai', 1, '2022-02-20 22:11:32', '2022-02-20 22:11:32'),
(8, 'Hendri', '$2y$10$eAEndF3HQcis/SaHthwOleT.daPnkvk49zXZwNf6GNOf4l7FmCzai', 'Atasan', 'Hendrisakti Hoktovianus', 'Bukittinggi', '1964-06-21', 'Padang Pariaman', '+6281234567890', '1645425876100.Kementerian_Agama_new_logo.png', 'Kepala Madrasah', 0, '2022-02-20 23:39:34', '2022-02-20 23:44:36'),
(10, 'Fardi', '$2y$10$QX9HMdK2wvbDxDTLNDiQaunAyT.1utjzj6WJF810ztT4r6fvx3ENK', 'Anggota', 'Fardi Rahman', 'Padang', '1984-06-26', 'Komplek MESS Guru MAN IC Padang Pariaman', '+6285263377015', NULL, 'Guru', 0, '2022-02-21 04:53:09', '2022-02-21 04:53:09'),
(11, 'ardison', '$2y$10$y3IqIFsQJnbvJ8XN902Yf.pjYP5qN7M3UoQdkccHnOgxrEq0IebQ6', 'Anggota', 'Ardison', 'Kerinci', '1970-12-22', 'Komplek MESS Guru MAN IC Padang Pariaman', '+6285256705881', NULL, 'Teknisi', 0, '2022-02-21 23:15:10', '2022-02-21 23:15:10'),
(12, 'yulia', '$2y$10$xsBr.CvSu3tYLsN0/YPGtuzdQduIiEUOByEigZ3jTW05hTHfENu1G', 'Anggota', 'Yulia Fitri Yenti', 'Padang Panjang', '1984-07-09', 'Komplek MESS Guru MAN IC Padang Pariaman', '+6285374185814', NULL, 'Staf TU', 0, '2022-02-21 23:21:09', '2022-02-21 23:21:09'),
(13, 'roslaini', '$2y$10$hqFRey2errXop1GWrH5Hc.HPqbYKeE69Auty6d6sPF94hex.52yN2', 'Anggota', 'Roslaini', 'Pasilihan Kota Solok', '1963-12-31', 'Komplek MESS Guru MAN IC Padang Pariaman', '+6282171549119', '164551928499.WhatsApp Image 2022-02-22 at 3.40.05 PM.jpeg', 'Guru', 0, '2022-02-22 01:41:24', '2022-02-22 01:43:41');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `simpanan`
--
ALTER TABLE `simpanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `golongan`
--
ALTER TABLE `golongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `simpanan`
--
ALTER TABLE `simpanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
