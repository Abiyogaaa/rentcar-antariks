-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 01 Feb 2025 pada 06.35
-- Versi server: 8.0.30
-- Versi PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentcar-antariks`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id_booking` int NOT NULL,
  `kode_booking` varchar(255) NOT NULL,
  `id_login` int NOT NULL,
  `id_mobil` int NOT NULL,
  `ktp` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `lama_sewa` int NOT NULL,
  `total_harga` int NOT NULL,
  `konfirmasi_pembayaran` varchar(255) NOT NULL,
  `tgl_input` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`id_booking`, `kode_booking`, `id_login`, `id_mobil`, `ktp`, `nama`, `alamat`, `no_tlp`, `tanggal`, `lama_sewa`, `total_harga`, `konfirmasi_pembayaran`, `tgl_input`) VALUES
(1, '1576329294', 3, 5, '231423123', 'Krisna', 'Bekasi', '08132312321', '2019-12-28', 2, 400000, 'Pembayaran di terima', '2019-12-14'),
(2, '1576671989', 3, 5, '231423', 'Krisna Waskita', 'Bekasi Ujung Harapan', '082391273127', '2019-12-20', 2, 400525, 'Pembayaran di terima', '2019-12-18'),
(3, '1642998828', 3, 5, '1283821832813', 'Krisna', 'Bekasi', '089618173609', '2022-01-26', 4, 800743, 'Pembayaran di terima', '2022-01-24'),
(4, '1727145539', 3, 6, '11111111111111', 'aaaaaaaaaa', 'aaaaaaaaa', '0787586', '2024-09-19', 3, 1500792, 'Pembayaran di terima', '2024-09-24'),
(5, '1728267445', 2, 6, '22222222', 'aji', 'angkasa', '222222222222', '2024-10-07', 3, 1500226, 'Belum Bayar', '2024-10-07'),
(6, '1728267499', 2, 6, '22222222', 'aji', 'angkasa', '222222222222', '2024-10-07', 3, 1500210, 'Belum Bayar', '2024-10-07'),
(7, '1728269930', 2, 6, '234234326364', 'Abi yoga', 'angkasa', '087714141091', '2024-10-07', 2, 1000383, 'Belum Bayar', '2024-10-07'),
(8, '1728285124', 2, 6, '5232631265222', 'Abi yoga', 'angkasa', '08272363636', '2024-10-07', 2, 1000628, 'Sedang di proses', '2024-10-07'),
(9, '1728290246', 2, 27, '5232631265222', 'Farid Rahman', 'angkasa', '08272363636', '2024-10-08', 3, 7500517, 'Sedang di proses', '2024-10-07'),
(10, '1728291068', 2, 24, '11111111111111', 'Vina', 'angkasa', '08272363636', '2024-10-08', 4, 6000194, 'Sedang di proses', '2024-10-07'),
(11, '1738232974', 2, 24, '11111111111111', 'Abi yoga', 'angkasa', '222222222', '2025-01-30', 3, 4500561, 'Belum Bayar', '2025-01-30'),
(12, '1738234667', 2, 25, '11111111111111', 'Abi yoga', 'angkasa', '222222222222', '2025-01-30', 2, 3600930, 'Sedang di proses', '2025-01-30'),
(13, '1738235082', 2, 25, '11111111111111', 'Abi yoga', 'angkasa', '222222222222', '2025-01-30', 2, 3600204, 'Sedang di proses', '2025-01-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `infoweb`
--

CREATE TABLE `infoweb` (
  `id` int NOT NULL,
  `nama_rental` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telp` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_rek` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `updated_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `infoweb`
--

INSERT INTO `infoweb` (`id`, `nama_rental`, `telp`, `alamat`, `email`, `no_rek`, `updated_at`) VALUES
(1, 'Rentcar-Antariks', '08232637233', 'Jl. Kuripan, Kota Banjarmasin Kalimantan Selatan', 'Rentcar-Antariks@gmail.com', '901544218329', '\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id_login` int NOT NULL,
  `nama_pengguna` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `notlp` varchar(15) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id_login`, `nama_pengguna`, `username`, `password`, `email`, `notlp`, `level`) VALUES
(1, 'admin', 'Rentcar-Antariks@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '08131536622', 'admin'),
(2, 'demo', 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@gmail.com', '081728128718', 'pengguna'),
(4, 'Herry Susantoo', 'herry', '673491c1a59d25086ac3c58964dae71a', 'herry@gmail.com', '09102912091', 'pengguna');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` int NOT NULL,
  `no_plat` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `harga` int NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `gambar` text NOT NULL,
  `tahun` varchar(100) NOT NULL,
  `spesifikasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `no_plat`, `merk`, `harga`, `deskripsi`, `status`, `gambar`, `tahun`, `spesifikasi`) VALUES
(5, 'N34234', 'Avanza', 200000, 'Apa aja', 'Tidak Tersedia', '1727872649.png', '2022', '6 orang'),
(6, 'N 1232 BKT', 'New Xenia', 500000, 'Baru', 'Tersedia', '1727872664.png', '2022', '6 orang'),
(24, 'B 1234 XYZ', 'Fortuner', 1500000, 'SUV mewah dan tangguh dengan kapasitas 7 penumpang', 'Tidak Tersedia', '1727872686.png', '2022', '6 orang'),
(25, 'D 5678 ABC', 'Pajero', 1800000, 'SUV premium dengan performa off-road yang kuat', 'Tersedia', '1727872890.png', '2022', '6 orang'),
(26, 'B 9101 DEF', 'BR-V', 1200000, 'SUV kompak dengan desain modern dan hemat bahan bakar', 'Tersedia', '1727872905.png', '2022', '6 orang'),
(27, 'L 1122 GHI', 'Alphard', 2500000, 'MPV mewah untuk perjalanan keluarga dan eksekutif', 'Tidak Tersedia', '1727872917.png', '2022', '6 orang'),
(28, 'N 3344 JKL', 'CR-V', 1600000, 'SUV elegan dan nyaman dengan performa tinggi', 'Tersedia', '1727872931.png', '2022', '6 orang'),
(29, 'B 5566 MNO', 'Suzuki Ertiga', 900000, 'MPV keluarga dengan fitur lengkap dan irit bahan bakar', 'Tersedia', '1727872945.jpg', '2022', '6 orang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `id_booking` int NOT NULL,
  `no_rekening` varchar(50) DEFAULT NULL,
  `nama_rekening` varchar(255) NOT NULL,
  `nominal` int NOT NULL,
  `tanggal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_booking`, `no_rekening`, `nama_rekening`, `nominal`, `tanggal`) VALUES
(3, 1, '2131241', 'Krisna Aldi Waskito', 400000, '2019-12-14'),
(4, 2, '2131241', 'Krisna Aldi Waskito', 400525, '2019-12-18'),
(5, 3, '13213', 'Fauzan Falah', 800743, '2022-01-24'),
(6, 4, '231232333', 'aaaaaaaaaa', 1500000, '2024-09-19'),
(7, 8, '901544218329', 'Abi yoga', 1500000, '2024-10-07'),
(8, 9, '901544218329', 'Farid Rahman', 76000000, '2024-10-07'),
(9, 10, '901544218329', 'vina', 7000000, '2024-10-07'),
(10, 12, '901544218329', 'Abi yoga', 1500000, '2025-01-30'),
(11, 13, '901544218329', 'Dinas', 3600204, '2025-01-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int NOT NULL,
  `kode_booking` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `denda` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indeks untuk tabel `infoweb`
--
ALTER TABLE `infoweb`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indeks untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `infoweb`
--
ALTER TABLE `infoweb`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
