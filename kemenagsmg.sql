-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2026 at 08:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kemenagsmg`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `judul` varchar(200) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `gambar` varchar(150) DEFAULT NULL,
  `status` enum('pending','publish','rejected') DEFAULT 'pending',
  `pengirim` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `judul`, `isi`, `tanggal`, `bulan`, `tahun`, `gambar`, `status`, `pengirim`) VALUES
(3, 'Berita', 'sadssdsvsadvdavdavdavdavda', '0000-00-00', 12, 2026, '1769406778_192.jpg', 'publish', 'KUA Mijen'),
(4, 'Pengaduan', 'fgfhdghehethtefegfegefg', '0000-00-00', 2, 2026, '1769407652_220.png', 'publish', 'KUA Mijen');

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `id_bidang` int(11) NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `nama_bidang` varchar(100) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bidang`
--

INSERT INTO `bidang` (`id_bidang`, `slug`, `nama_bidang`, `icon`, `urutan`) VALUES
(1, 'berita', 'Berita', 'berita.png', 1),
(2, 'bimas-islam', 'Bimas Islam', 'bimas.png', 2),
(3, 'penma', 'PENMA', 'penma.png', 3),
(4, 'pd-pontren', 'PD Pontren', 'pontren.png', 4),
(5, 'zakat-wakaf', 'Zakat & Wakaf', 'zakat.png', 5),
(6, 'pais', 'PAIS', 'pais.png', 6),
(7, 'kristen', 'Kristen', 'kristen.png', 7),
(8, 'katolik', 'Katolik', 'katolik.png', 8),
(9, 'hindu', 'Hindu', 'hindu.png', 9),
(10, 'buddha', 'Buddha', 'buddha.png', 10),
(11, 'tu', 'Sub Bag TU', 'tu.png', 11),
(12, 'pipd', 'PIPD', 'pipd.png', 12),
(13, 'pengaduan', 'Pengaduan', 'pengaduan.png', 13),
(15, 'gabut', 'gabut', 'gabut.png', 14);

-- --------------------------------------------------------

--
-- Table structure for table `detail_layanan`
--

CREATE TABLE `detail_layanan` (
  `id_detail` int(11) NOT NULL,
  `id_profil` int(11) DEFAULT NULL,
  `judul_detail` varchar(150) DEFAULT NULL,
  `isi_detail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `editor`
--

CREATE TABLE `editor` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `editor`
--

INSERT INTO `editor` (`id`, `nama`, `username`, `password`) VALUES
(1, 'KUA Mijen', 'kuamijen', 'a7a06ff21e04557881462c4540cb61b9');

-- --------------------------------------------------------

--
-- Table structure for table `profil_bidang`
--

CREATE TABLE `profil_bidang` (
  `id_profil` int(11) NOT NULL,
  `id_bidang` int(11) DEFAULT NULL,
  `judul` varchar(150) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `punya_detail` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil_bidang`
--

INSERT INTO `profil_bidang` (`id_profil`, `id_bidang`, `judul`, `deskripsi`, `punya_detail`) VALUES
(1, 1, 'Berita', 'Informasi resmi mengenai Berita di Kementerian Agama Kota Semarang.', 0),
(2, 2, 'Bimas Islam', 'Informasi resmi mengenai Bimas Islam di Kementerian Agama Kota Semarang.', 1),
(3, 3, 'PENMA', 'Informasi resmi mengenai PENMA di Kementerian Agama Kota Semarang.', 1),
(4, 4, 'PD Pontren', 'Informasi resmi mengenai PD Pontren di Kementerian Agama Kota Semarang.', 1),
(5, 5, 'Zakat & Wakaf', 'Informasi resmi mengenai Zakat & Wakaf di Kementerian Agama Kota Semarang.', 1),
(6, 6, 'PAIS', 'Informasi resmi mengenai PAIS di Kementerian Agama Kota Semarang.', 1),
(7, 7, 'Kristen', 'Informasi resmi mengenai Kristen di Kementerian Agama Kota Semarang.', 1),
(8, 8, 'Katolik', 'Informasi resmi mengenai Katolik di Kementerian Agama Kota Semarang.', 1),
(9, 9, 'Hindu', 'Informasi resmi mengenai Hindu di Kementerian Agama Kota Semarang.', 1),
(10, 10, 'Buddha', 'Informasi resmi mengenai Buddha di Kementerian Agama Kota Semarang.', 1),
(11, 11, 'Sub Bag TU', 'Informasi resmi mengenai Sub Bag TU di Kementerian Agama Kota Semarang.', 1),
(12, 12, 'PIPD', 'Informasi resmi mengenai PIPD di Kementerian Agama Kota Semarang.', 0),
(13, 13, 'Pengaduan', 'Informasi resmi mengenai Pengaduan di Kementerian Agama Kota Semarang.', 0),
(16, 15, 'gabut', 'Informasi resmi mengenai gabut di Kementerian Agama Kota Semarang.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profil_umum`
--

CREATE TABLE `profil_umum` (
  `id` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `visi` text DEFAULT NULL,
  `misi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil_umum`
--

INSERT INTO `profil_umum` (`id`, `deskripsi`, `visi`, `misi`) VALUES
(1, 'Kementerian Agama Republik Indonesia bertugas menyelenggarakan urusan pemerintahan di bidang keagamaan di wilayah Kota Semarang.', 'Terwujudnya masyarakat Indonesia yang taat beragama, rukun, cerdas, dan sejahtera lahir batin.', 'Meningkatkan kualitas pemahaman agama;Meningkatkan pelayanan keagamaan;Memperkuat kerukunan umat beragama');

-- --------------------------------------------------------

--
-- Table structure for table `struktur_jabatan`
--

CREATE TABLE `struktur_jabatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `foto` varchar(150) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `struktur_jabatan`
--

INSERT INTO `struktur_jabatan` (`id`, `nama`, `jabatan`, `foto`, `urutan`) VALUES
(1, 'H. Muhtasit, S.Ag, M.Si,', 'KakanKemenag', '1769397950_575.png', 1),
(2, 'H. Muhtasit, S.Ag, M.Si,', 'KakanKemenag', '1769397980_285.png', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id_bidang`);

--
-- Indexes for table `detail_layanan`
--
ALTER TABLE `detail_layanan`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `editor`
--
ALTER TABLE `editor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil_bidang`
--
ALTER TABLE `profil_bidang`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indexes for table `profil_umum`
--
ALTER TABLE `profil_umum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `struktur_jabatan`
--
ALTER TABLE `struktur_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `detail_layanan`
--
ALTER TABLE `detail_layanan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `editor`
--
ALTER TABLE `editor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profil_bidang`
--
ALTER TABLE `profil_bidang`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `profil_umum`
--
ALTER TABLE `profil_umum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `struktur_jabatan`
--
ALTER TABLE `struktur_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
