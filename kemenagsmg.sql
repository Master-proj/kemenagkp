-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2026 at 08:14 AM
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
(6, 'Pengaduan', '<strong style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span>', '0000-00-00', 2, 2026, '1769568417_107.png', 'publish', 'KUA Semarang Barat'),
(7, 'Pengaduan', '<strong style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span>', '0000-00-00', 1, 2026, '1769568453_816.png', 'publish', 'KUA Semarang Barat'),
(8, 'Pengaduan', '<div style=\"text-align: left;\"><strong style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></div>', '0000-00-00', 4, 2023, '1769569171_243.png', 'publish', 'KUA Semarang Barat'),
(10, 'Pengaduan', '<p style=\"margin-bottom: 15px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p><form method=\"post\" action=\"https://www.lipsum.com/feed/html\" style=\"margin-bottom: 10px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><br></form>', '0000-00-00', 1, 2023, '1769570338_857.jpg', 'publish', 'KUA Tugu');

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
(12, 'ppid', 'PPID', 'pipd.png', 12),
(13, 'pengaduan', 'Pengaduan', 'pengaduan.png', 13);

-- --------------------------------------------------------

--
-- Table structure for table `detail_layanan`
--

CREATE TABLE `detail_layanan` (
  `id_detail` int(11) NOT NULL,
  `id_profil` int(11) DEFAULT NULL,
  `judul_detail` varchar(150) DEFAULT NULL,
  `isi_detail` text DEFAULT NULL,
  `file_pdf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_layanan`
--

INSERT INTO `detail_layanan` (`id_detail`, `id_profil`, `judul_detail`, `isi_detail`, `file_pdf`) VALUES
(2, 2, 'surat pengajuan kkl', 'surat pengajuan kkl', '1769575409_340.pdf'),
(3, 11, 'Pengaduan', 'Surat Pengaduan', '1769583716_141.pdf');

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
(1, 'KUA Mijen', 'kuamijen', 'a7a06ff21e04557881462c4540cb61b9'),
(2, 'KUA Semarang Barat', 'kuabarat', '62e59d8dcbc2aa4a88f24aef3e916d31'),
(3, 'KUA Tugu', 'kuatugu', '1e53747b0e390077d3897416583d481b');

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
(1, 1, 'Berita', 'Menu Berita menyajikan berbagai informasi terkini seputar kegiatan, program, agenda, dan kebijakan instansi. Pengunjung dapat mengikuti perkembangan terbaru, pengumuman resmi, dokumentasi kegiatan, serta berita penting lainnya yang berkaitan dengan layanan keagamaan dan pendidikan. Halaman ini menjadi sumber utama informasi yang akurat, transparan, dan dapat dipercaya oleh masyarakat.', 0),
(2, 2, 'Bimas Islam', 'Bimas Islam merupakan layanan yang menangani pembinaan dan pengelolaan urusan keagamaan Islam. Cakupan layanan meliputi administrasi nikah, rujuk, pembinaan keluarga sakinah, pengelolaan masjid, serta pemberdayaan umat. Melalui layanan ini, masyarakat dapat memperoleh informasi, bimbingan, dan fasilitasi terkait kehidupan beragama Islam secara tertib, harmonis, dan berkelanjutan.', 1),
(3, 3, 'PENMA', 'PENMA bertanggung jawab atas pengelolaan dan pengembangan pendidikan madrasah mulai dari RA, MI, MTs, hingga MA. Layanan ini mencakup pembinaan kelembagaan, peningkatan mutu pendidikan, pendataan madrasah, serta pengembangan tenaga pendidik. Tujuannya adalah mewujudkan madrasah yang berkualitas, berdaya saing, dan mampu menghasilkan generasi yang beriman, berilmu, serta berakhlak mulia.', 1),
(4, 4, 'PD Pontren', 'PD Pontren mengelola seluruh urusan yang berkaitan dengan pendidikan diniyah dan pondok pesantren. Layanan ini meliputi pendataan lembaga, pembinaan pesantren, fasilitasi bantuan, serta penguatan kelembagaan. PD Pontren berperan penting dalam menjaga eksistensi pesantren sebagai pusat pendidikan agama dan pembentukan karakter umat.', 1),
(5, 5, 'Zakat & Wakaf', 'Layanan Zakat & Wakaf berfokus pada pengelolaan, pembinaan, dan pengembangan potensi zakat serta wakaf. Masyarakat dapat memperoleh informasi terkait regulasi, tata kelola, pendataan, serta pemanfaatan zakat dan wakaf secara produktif. Layanan ini bertujuan mendorong optimalisasi aset umat demi kesejahteraan sosial dan pemberdayaan ekonomi masyarakat.', 1),
(6, 6, 'PAIS', 'PAIS mengelola penyelenggaraan pendidikan agama Islam pada sekolah umum. Ruang lingkupnya meliputi pembinaan guru PAI, pengembangan kurikulum, peningkatan kompetensi pendidik, serta penguatan karakter peserta didik. Layanan ini hadir untuk memastikan pendidikan agama Islam berjalan efektif dalam membentuk kepribadian siswa yang religius, moderat, dan berakhlak.', 1),
(7, 7, 'Kristen', 'Layanan Kristen menangani pembinaan dan administrasi urusan keagamaan umat Kristen. Cakupan layanan meliputi pendidikan keagamaan, pengelolaan rumah ibadah, pendataan lembaga, serta fasilitasi kegiatan keumatan. Melalui layanan ini, umat Kristen dapat memperoleh dukungan dalam menjalankan kehidupan beragama secara tertib dan harmonis.', 1),
(8, 8, 'Katolik', 'Layanan Katolik menyediakan pembinaan dan pengelolaan urusan keagamaan Katolik, termasuk pendidikan, gereja, serta kegiatan umat. Layanan ini membantu masyarakat dalam mendapatkan informasi, administrasi, dan fasilitasi terkait kebutuhan keagamaan Katolik, dengan tujuan menciptakan pelayanan yang profesional, transparan, dan akuntabel.', 1),
(9, 9, 'Hindu', 'Layanan Hindu mengelola berbagai urusan keagamaan umat Hindu, mulai dari pembinaan umat, pendidikan, hingga pengelolaan tempat ibadah. Melalui layanan ini, umat Hindu dapat memperoleh informasi dan dukungan dalam menjalankan kegiatan keagamaan serta pengembangan kelembagaan secara berkelanjutan.', 1),
(10, 10, 'Buddha', 'Layanan Buddha berfokus pada pembinaan dan pengelolaan urusan keagamaan Buddha. Layanan ini mencakup pendidikan, pengelolaan vihara, serta kegiatan keumatan. Tujuannya adalah memberikan kemudahan akses informasi dan pelayanan bagi umat Buddha dalam menjalankan kehidupan beragama yang tertib dan harmonis.', 1),
(11, 11, 'Sub Bag TU', 'Sub Bag TU merupakan pusat layanan administrasi yang mengelola kepegawaian, keuangan, persuratan, arsip, serta tata kelola perkantoran. Layanan ini berperan penting dalam mendukung kelancaran operasional instansi agar seluruh kegiatan berjalan efektif, tertib, dan sesuai dengan ketentuan yang berlaku.', 1),
(12, 12, 'PIPD', 'PPID menyediakan layanan keterbukaan informasi publik sesuai dengan peraturan perundang-undangan. Masyarakat dapat mengakses data dan dokumen resmi, mengajukan permohonan informasi, serta memperoleh penjelasan terkait hak atas informasi. Layanan ini mendukung terwujudnya pemerintahan yang transparan, akuntabel, dan terpercaya.', 0),
(13, 13, 'Pengaduan', 'Menu Pengaduan menjadi sarana bagi masyarakat untuk menyampaikan keluhan, saran, kritik, maupun laporan terkait layanan instansi. Setiap pengaduan akan ditangani secara profesional, transparan, dan bertanggung jawab. Fitur ini bertujuan meningkatkan kualitas pelayanan publik serta memperkuat partisipasi masyarakat.', 0);

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
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `detail_layanan`
--
ALTER TABLE `detail_layanan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `editor`
--
ALTER TABLE `editor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
