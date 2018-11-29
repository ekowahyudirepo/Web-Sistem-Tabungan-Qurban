-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29 Nov 2018 pada 06.48
-- Versi Server: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_qurbanapp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `ADMIN_ID` int(11) NOT NULL,
  `ADMIN_USERNAME` varchar(50) NOT NULL,
  `ADMIN_PASSWORD` varchar(50) NOT NULL,
  `ADMIN_NAMA` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `ADMIN_USERNAME`, `ADMIN_PASSWORD`, `ADMIN_NAMA`) VALUES
(1, 'admin', '97101111108112', 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hewan`
--

CREATE TABLE IF NOT EXISTS `hewan` (
  `HEWAN_ID` int(11) NOT NULL,
  `HEWAN_NAMA` varchar(50) NOT NULL,
  `HEWAN_JENIS` enum('KAMBING','SAPI') NOT NULL,
  `HEWAN_HARGA` varchar(50) NOT NULL,
  `HEWAN_BERAT` varchar(50) NOT NULL,
  `HEWAN_URUT` int(11) NOT NULL,
  `HEWAN_STATUS` enum('TAMPIL','SEMBUNYI') NOT NULL,
  `HEWAN_ADD` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `hewan`
--

INSERT INTO `hewan` (`HEWAN_ID`, `HEWAN_NAMA`, `HEWAN_JENIS`, `HEWAN_HARGA`, `HEWAN_BERAT`, `HEWAN_URUT`, `HEWAN_STATUS`, `HEWAN_ADD`) VALUES
(1, 'KAMBING JAWA', 'KAMBING', '900000', '75 - 80 KG', 1, 'TAMPIL', 1539500718),
(2, 'KAMBING MADURA', 'KAMBING', '2000000', '80 - 90 KG', 2, 'TAMPIL', 1539500744),
(3, 'SAPI MADURA', 'SAPI', '13000000', '200 - 210 KG', 3, 'TAMPIL', 1539500779),
(4, 'SAPI MAKKAH', 'SAPI', '15000000', '200 - 215 KG', 4, 'TAMPIL', 1539500813);

-- --------------------------------------------------------

--
-- Struktur dari tabel `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `INFO_ID` int(11) NOT NULL,
  `INFO_LOGO` text NOT NULL,
  `INFO_META_DESC` text NOT NULL,
  `INFO_TENTANG` text NOT NULL,
  `INFO_FB` text NOT NULL,
  `INFO_INSTAGRAM` text NOT NULL,
  `INFO_YOUTUBE` text NOT NULL,
  `INFO_EMAIL` varchar(50) NOT NULL,
  `INFO_HP` varchar(50) NOT NULL,
  `INFO_ALAMAT` text NOT NULL,
  `INFO_RUN_TEXT` text NOT NULL,
  `INFO_RUN_TEXT_STATUS` enum('TAMPIL','SEMBUNYI') NOT NULL,
  `INFO_KETENTUAN` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `info`
--

INSERT INTO `info` (`INFO_ID`, `INFO_LOGO`, `INFO_META_DESC`, `INFO_TENTANG`, `INFO_FB`, `INFO_INSTAGRAM`, `INFO_YOUTUBE`, `INFO_EMAIL`, `INFO_HP`, `INFO_ALAMAT`, `INFO_RUN_TEXT`, `INFO_RUN_TEXT_STATUS`, `INFO_KETENTUAN`) VALUES
(1, 'sitaqur.png', 'tabungan qurban qurban online sistem tabungan qurban sistem qurban online', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'http://instagram.com/sitaqur', 'http://facebook.com/sitaqur', 'http://youtube.com/sitaqur', 'cs@qurbanapp.com', '085856361781', 'Kompleks PP. Darul ''Ulum Peterongan Jombang \r\nFakultas Sainstek Unipdu Jombang ', '© Assalamu''alaikum wr. wb.  Sahabat qurban alhamdulillah sebentar lagi akan <span class="text-success"> Segera diluncurkan <b>versi Alpha</b> </span> Sistem tabungan qurban <span class="text-success">mohon do''a restunya</span> terima kasih . <a href="tentang">Info lebih lanjut</a>', 'TAMPIL', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE IF NOT EXISTS `keranjang` (
  `KERANJANG_ID` int(11) NOT NULL,
  `NOTA_NO` varchar(50) NOT NULL,
  `HEWAN_ID` int(11) NOT NULL,
  `KERANJANG_QTY` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`KERANJANG_ID`, `NOTA_NO`, `HEWAN_ID`, `KERANJANG_QTY`) VALUES
(1, 'QURBAN1539752416-2', 1, 1),
(2, 'QURBAN1541771541-1', 1, 2),
(3, 'QURBAN1541778226-1', 3, 1),
(4, 'QURBAN1541814803-1', 1, 1),
(5, 'QURBAN1541814803-1', 2, 1),
(6, 'QURBAN1543231763-1', 1, 1),
(7, 'QURBAN1543395952-1', 4, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lembaga`
--

CREATE TABLE IF NOT EXISTS `lembaga` (
  `LEMBAGA_ID` int(11) NOT NULL,
  `LEMBAGA_NAMA` varchar(50) NOT NULL,
  `LEMBAGA_HP` varchar(50) NOT NULL,
  `LEMBAGA_EMAIL` varchar(50) NOT NULL,
  `LEMBAGA_PASSWORD` varchar(100) NOT NULL,
  `LEMBAGA_ALAMAT` text NOT NULL,
  `LEMBAGA_LAT` varchar(50) NOT NULL,
  `LEMBAGA_LONG` varchar(50) NOT NULL,
  `LEMBAGA_STATUS` enum('TAMPIL','SEMBUNYI') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `lembaga`
--

INSERT INTO `lembaga` (`LEMBAGA_ID`, `LEMBAGA_NAMA`, `LEMBAGA_HP`, `LEMBAGA_EMAIL`, `LEMBAGA_PASSWORD`, `LEMBAGA_ALAMAT`, `LEMBAGA_LAT`, `LEMBAGA_LONG`, `LEMBAGA_STATUS`) VALUES
(1, 'PONDOK DARUL ULUM', '0321090090', 'humas@darululum.com', '1.0411811110012e54', 'PP DARUL ULUM PETERONGAN JOMBANG', '100.09', '101.01', 'TAMPIL'),
(2, 'YAYASAN QURAN AL HAKIM', '0321999999', 'humas@alhakim.com', '1.0411811110012e48', 'JLN. RAYA KEMERDEKAAN NO.10 JOMBANG', '90.12', '95.99', 'TAMPIL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `MEMBER_ID` int(11) NOT NULL,
  `MEMBER_NIK` varchar(50) DEFAULT NULL,
  `MEMBER_EMAIL` varchar(50) NOT NULL,
  `MEMBER_NAMA` varchar(50) NOT NULL,
  `MEMBER_JK` enum('L','p') NOT NULL,
  `MEMBER_HP` varchar(50) NOT NULL,
  `MEMBER_FOTO` text,
  `MEMBER_PROVINSI` text,
  `MEMBER_KABUPATEN` text,
  `MEMBER_KECAMATAN` text,
  `MEMBER_DESA` text,
  `MEMBER_DUSUN` text,
  `MEMBER_VERIFIKASI` enum('BELUM','SUDAH') NOT NULL,
  `MEMBER_STATUS` enum('BARU','AKTIF','BLOKIR') NOT NULL,
  `MEMBER_PASSWORD` varchar(100) NOT NULL,
  `MEMBER_BANK` varchar(50) DEFAULT NULL,
  `MEMBER_NO_REK` varchar(50) DEFAULT NULL,
  `MEMBER_AN_REK` varchar(50) DEFAULT NULL,
  `MEMBER_ADD` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`MEMBER_ID`, `MEMBER_NIK`, `MEMBER_EMAIL`, `MEMBER_NAMA`, `MEMBER_JK`, `MEMBER_HP`, `MEMBER_FOTO`, `MEMBER_PROVINSI`, `MEMBER_KABUPATEN`, `MEMBER_KECAMATAN`, `MEMBER_DESA`, `MEMBER_DUSUN`, `MEMBER_VERIFIKASI`, `MEMBER_STATUS`, `MEMBER_PASSWORD`, `MEMBER_BANK`, `MEMBER_NO_REK`, `MEMBER_AN_REK`, `MEMBER_ADD`) VALUES
(1, '123456789', 'akun.zudi@gmail.com', 'EKO WAHYUDI', 'L', '085856361781', '4x6.jpg', 'JAMBI', 'KAB. MUARO JAMBI', ' BAHAR UTARA', 'PINANG TINGGI', 'RT.01 / RW.09 ', 'SUDAH', 'AKTIF', '97101111108112', 'BRI', '998778887777', 'EKO WAHYUDI', 1539650811),
(2, '23253546578669', 'fadkur.asyari@gmail.com', 'ASYARI', 'L', '085655170762', 'ikon_kecil.png', '', '', '', '', 'PETERONGAN', 'SUDAH', 'AKTIF', '1.0798112106105e19', 'BRI', '12344545452767', 'KANG EKO', 1539751072),
(3, '3516163003840003', 'emilfaidah@gmail.com', 'EMILDA MUFIDAH', '', '085655446789', NULL, '', '', '', '', 'DUSUN CANDISARI DESA JOMBATAN KECAMATAN KESAMBEN KABUPATEN JOMBANG', 'SUDAH', 'BARU', '1.0998117117121e24', 'BNI', '436376172', 'MUKHAMAD MASRUR', 1540794813),
(4, '35161613003840003', 'mu.masrur@gmail.com', 'MUKHAMAD MASRUR', 'L', '085655446789', NULL, '', '', '', '', 'CANDISARI RT/RW 003/001 DESA JOMBATAN KECAMATAN KESAMBEN KABUPATEN JOMBANG', 'SUDAH', 'AKTIF', '1.0998117117121e24', 'BNI', '436376172', 'MUKHAMAD MASRUR', 1540955447),
(5, NULL, 'ahmad@gmail.com', 'AHMAD', 'L', '', NULL, NULL, NULL, NULL, NULL, NULL, 'BELUM', 'BARU', '97105111100102', NULL, NULL, NULL, 1543362234);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota`
--

CREATE TABLE IF NOT EXISTS `nota` (
  `NOTA_ID` int(11) NOT NULL,
  `MEMBER_ID` int(11) NOT NULL,
  `LEMBAGA_ID` int(11) NOT NULL,
  `NOTA_NO` varchar(50) NOT NULL,
  `NOTA_TOTAL` int(11) NOT NULL,
  `NOTA_CATATAN` text NOT NULL,
  `NOTA_STATUS` enum('PROSES','TERIMA') NOT NULL,
  `NOTA_ADD` date NOT NULL,
  `NOTA_TGL_TERIMA` date NOT NULL,
  `NOTA_GMB1` text,
  `NOTA_GMB2` text,
  `NOTA_GMB3` text,
  `NOTA_GMB4` text
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `nota`
--

INSERT INTO `nota` (`NOTA_ID`, `MEMBER_ID`, `LEMBAGA_ID`, `NOTA_NO`, `NOTA_TOTAL`, `NOTA_CATATAN`, `NOTA_STATUS`, `NOTA_ADD`, `NOTA_TGL_TERIMA`, `NOTA_GMB1`, `NOTA_GMB2`, `NOTA_GMB3`, `NOTA_GMB4`) VALUES
(1, 2, 2, 'QURBAN1539752416-2', 900000, 'KANG EKO', 'TERIMA', '2018-10-17', '2018-10-17', 'photo.jpg', 'photo1.jpg', 'photo2.jpg', 'photo3.jpg'),
(2, 1, 1, 'QURBAN1541771541-1', 1800000, 'ERTYUIOP', 'TERIMA', '2018-11-09', '2018-11-09', '067361800_1442825157-liputan6_kurban_673x373.jpg', 'google_logo_wall_android_26167_1600x1200.jpg', 'Qurban_5.jpg', 'images.jpg'),
(3, 1, 1, 'QURBAN1541778226-1', 2000000, 'ISMAIL', 'TERIMA', '2016-11-09', '2016-11-20', NULL, NULL, NULL, NULL),
(4, 1, 1, 'QURBAN1541814803-1', 900000, 'MAS AVAN ', 'TERIMA', '2017-11-10', '2017-11-10', '067361800_1442825157-liputan6_kurban_673x3731.jpg', 'Qurban_51.jpg', 'Qurban_52.jpg', '067361800_1442825157-liputan6_kurban_673x3732.jpg'),
(5, 1, 2, 'QURBAN1543231763-1', 900000, 'M HASAN MARZUKI', 'TERIMA', '2018-11-26', '2018-11-26', '067361800_1442825157-liputan6_kurban_673x3733.jpg', 'google_logo_wall_android_26167_1600x12001.jpg', 'Qurban_53.jpg', 'images1.jpg'),
(6, 1, 2, 'QURBAN1543395952-1', 45000000, 'ALI, GHOZALI, FULAN, ANGGI, ZAHRAH, FUAD, BUDI', 'PROSES', '2018-11-28', '0000-00-00', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengunjung`
--

CREATE TABLE IF NOT EXISTS `pengunjung` (
  `PENGUNJUNG_ID` int(11) NOT NULL,
  `PENGUNJUNG_IP` varchar(50) NOT NULL,
  `PENGUNJUNG_DEVICE` text NOT NULL,
  `PENGUNJUNG_AGENT` text NOT NULL,
  `PENGUNJUNG_FLATFORM` text NOT NULL,
  `PENGUNJUNG_TGL` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pengunjung`
--

INSERT INTO `pengunjung` (`PENGUNJUNG_ID`, `PENGUNJUNG_IP`, `PENGUNJUNG_DEVICE`, `PENGUNJUNG_AGENT`, `PENGUNJUNG_FLATFORM`, `PENGUNJUNG_TGL`) VALUES
(1, '::1', '', '', '', '2018-10-14'),
(2, '::1', '', '', '', '2018-10-15'),
(3, '114.4.82.221', '', '', '', '2018-10-15'),
(4, '8.37.232.185', '', '', '', '2018-10-16'),
(5, '114.4.82.221', '', '', '', '2018-10-16'),
(6, '128.30.52.134', '', '', '', '2018-10-16'),
(7, '128.30.52.64', '', '', '', '2018-10-16'),
(8, '66.249.82.72', '', '', '', '2018-10-16'),
(9, '66.249.82.70', '', '', '', '2018-10-16'),
(10, '71.114.67.62', '', '', '', '2018-10-16'),
(11, '209.85.238.93', '', '', '', '2018-10-16'),
(12, '66.249.93.60', '', '', '', '2018-10-16'),
(13, '66.249.93.194', '', '', '', '2018-10-16'),
(14, '209.85.238.89', '', '', '', '2018-10-16'),
(15, '66.249.81.28', '', '', '', '2018-10-16'),
(16, '8.37.232.36', '', '', '', '2018-10-16'),
(17, '66.102.8.154', '', '', '', '2018-10-16'),
(18, '66.102.8.152', '', '', '', '2018-10-16'),
(19, '8.37.232.166', '', '', '', '2018-10-16'),
(20, '8.37.232.17', '', '', '', '2018-10-16'),
(21, '120.188.92.92', '', '', '', '2018-10-16'),
(22, '120.188.92.92', '', '', '', '2018-10-17'),
(23, '8.37.232.58', '', '', '', '2018-10-17'),
(24, '120.188.67.188', '', '', '', '2018-10-17'),
(25, '114.4.215.73', '', '', '', '2018-10-17'),
(26, '8.37.230.253', '', '', '', '2018-10-17'),
(27, '116.206.40.64', '', '', '', '2018-10-17'),
(28, '120.188.67.123', '', '', '', '2018-10-17'),
(29, '157.185.130.206', '', '', '', '2018-10-17'),
(30, '131.220.6.94', '', '', '', '2018-10-17'),
(31, '66.249.65.187', '', '', '', '2018-10-20'),
(32, '66.249.65.189', '', '', '', '2018-10-20'),
(33, '36.82.97.64', '', '', '', '2018-10-20'),
(34, '8.37.232.40', '', '', '', '2018-10-20'),
(35, '114.4.214.238', '', '', '', '2018-10-20'),
(36, '36.81.192.217', '', '', '', '2018-10-20'),
(37, '157.185.130.204', '', '', '', '2018-10-21'),
(38, '114.125.110.250', '', '', '', '2018-10-22'),
(39, '114.125.109.249', '', '', '', '2018-10-22'),
(40, '114.125.125.233', '', '', '', '2018-10-22'),
(41, '64.233.173.3', '', '', '', '2018-10-22'),
(42, '114.125.111.228', '', '', '', '2018-10-22'),
(43, '66.249.65.189', '', '', '', '2018-10-23'),
(44, '118.136.3.128', '', '', '', '2018-10-24'),
(45, '120.188.85.98', '', '', '', '2018-10-25'),
(46, '66.249.65.121', '', '', '', '2018-10-26'),
(47, '114.125.95.32', '', '', '', '2018-10-26'),
(48, '36.82.99.37', '', '', '', '2018-10-26'),
(49, '66.249.65.125', '', '', '', '2018-10-27'),
(50, '66.249.79.155', '', '', '', '2018-10-29'),
(51, '36.81.207.105', '', '', '', '2018-10-29'),
(52, '112.215.240.170', '', '', '', '2018-10-29'),
(53, '114.4.220.228', '', '', '', '2018-10-29'),
(54, '66.102.8.56', '', '', '', '2018-10-29'),
(55, '66.102.8.58', '', '', '', '2018-10-29'),
(56, '8.37.232.19', '', '', '', '2018-10-29'),
(57, '36.73.223.111', '', '', '', '2018-10-30'),
(58, '120.188.64.220', '', '', '', '2018-10-30'),
(59, '112.215.241.143', '', '', '', '2018-10-30'),
(60, '36.73.223.111', '', '', '', '2018-10-31'),
(61, '125.164.128.45', '', '', '', '2018-10-31'),
(62, '114.125.110.213', '', '', '', '2018-10-31'),
(63, '114.125.108.202', '', '', '', '2018-10-31'),
(64, '114.125.127.196', '', '', '', '2018-10-31'),
(65, '114.125.108.88', '', '', '', '2018-10-31'),
(66, '114.125.110.200', '', '', '', '2018-10-31'),
(67, '114.125.111.212', '', '', '', '2018-10-31'),
(68, '114.125.126.197', '', '', '', '2018-10-31'),
(69, '114.125.109.203', '', '', '', '2018-10-31'),
(70, '114.125.110.233', '', '', '', '2018-10-31'),
(71, '114.125.124.72', '', '', '', '2018-10-31'),
(72, '182.1.97.69', '', '', '', '2018-10-31'),
(73, '182.1.96.236', '', '', '', '2018-10-31'),
(74, '182.1.113.85', '', '', '', '2018-10-31'),
(75, '182.1.115.109', '', '', '', '2018-10-31'),
(76, '182.1.113.197', '', '', '', '2018-10-31'),
(77, '114.125.127.127', '', '', '', '2018-10-31'),
(78, '66.249.65.121', '', '', '', '2018-11-01'),
(79, '114.4.219.99', '', '', '', '2018-11-01'),
(80, '120.188.34.29', '', '', '', '2018-11-01'),
(81, '::1', '', '', '', '2018-11-02'),
(82, '::1', '', '', '', '2018-11-03'),
(83, '::1', '', '', '', '2018-11-04'),
(84, '::1', '', '', '', '2018-11-05'),
(85, '::1', '', '', '', '2018-11-06'),
(86, '::1', '', '', '', '2018-11-07'),
(87, '::1', '', '', '', '2018-11-09'),
(88, '::1', '', '', '', '2018-11-10'),
(89, '::1', '', '', '', '2018-11-14'),
(90, '::1', '', '', '', '2018-11-17'),
(91, '::1', '', '', '', '2018-11-18'),
(92, '::1', '', '', '', '2018-11-19'),
(93, '::1', '', '', '', '2018-11-20'),
(94, '::1', '', '', '', '2018-11-21'),
(95, '::1', '', '', '', '2018-11-22'),
(96, '::1', '', '', '', '2018-11-23'),
(97, '::1', '', '', '', '2018-11-24'),
(98, '::1', '', '', '', '2018-11-25'),
(101, '::1', 'BROWSER', 'Safari 534.30', 'Android', '2018-11-26'),
(102, '::1', 'BROWSER', 'Chrome 70.0.3538.102', 'Windows 7', '2018-11-27'),
(103, '::1', 'BROWSER', 'Chrome 70.0.3538.102', 'Windows 7', '2018-11-28'),
(104, '::1', 'BROWSER', 'Chrome 70.0.3538.102', 'Windows 7', '2018-11-29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE IF NOT EXISTS `rekening` (
  `REKENING_ID` int(11) NOT NULL,
  `REKENING_NAMA` varchar(50) NOT NULL,
  `REKENING_NO` varchar(50) NOT NULL,
  `REKENING_AN` varchar(50) NOT NULL,
  `REKENING_STATUS` enum('TAMPIL','SEMBUNYI') NOT NULL,
  `REKENING_ADD` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`REKENING_ID`, `REKENING_NAMA`, `REKENING_NO`, `REKENING_AN`, `REKENING_STATUS`, `REKENING_ADD`) VALUES
(1, 'BRI', '098-090-000-990', 'TABUNGAN QURBAN', 'TAMPIL', 1538747285),
(2, 'BCA', '777-888-999-768', 'TABUNGAN QURBAN', 'TAMPIL', 1538747351),
(3, 'MANDIRI', '777-888-999-765', 'TABUNGAN QURBAN', 'TAMPIL', 1538747369),
(4, 'BNI', '876-909-888-000', 'TABUNGAN QURBAN', 'TAMPIL', 1538747383);

-- --------------------------------------------------------

--
-- Struktur dari tabel `saran`
--

CREATE TABLE IF NOT EXISTS `saran` (
  `SARAN_ID` int(11) NOT NULL,
  `SARAN_NAMA` varchar(50) NOT NULL,
  `SARAN_EMAIL` varchar(50) NOT NULL,
  `SARAN_ISI` text NOT NULL,
  `SARAN_DEVICE` text NOT NULL,
  `SARAN_AGENT` text NOT NULL,
  `SARAN_PLATFORM` text NOT NULL,
  `SARAN_STATUS` enum('BELUM','SUDAH') NOT NULL,
  `SARAN_ADD` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `saran`
--

INSERT INTO `saran` (`SARAN_ID`, `SARAN_NAMA`, `SARAN_EMAIL`, `SARAN_ISI`, `SARAN_DEVICE`, `SARAN_AGENT`, `SARAN_PLATFORM`, `SARAN_STATUS`, `SARAN_ADD`) VALUES
(1, 'AHMAD', 'dh@gmail.com', '', '', '', '', 'SUDAH', 1539566447),
(2, 'EKO WAHYDI', 'akun.zudi@gmail.com', 'Tambah fitur penarikan tabungan', '', '', '', 'SUDAH', 1539569073),
(3, 'EKO WAHYUDI', 'akun.zudi@gmail.com', 'Saya melaporkan URL ini rusak localhost:8080/ci__sitaqur/masuka					  			', '', '', '', 'SUDAH', 1541758858);

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `SLIDER_ID` int(11) NOT NULL,
  `SLIDER_GMB` text NOT NULL,
  `SLIDER_LINK` text NOT NULL,
  `SLIDER_STATUS` enum('TAMPIL','SEMBUNYI') NOT NULL,
  `SLIDER_ADD` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`SLIDER_ID`, `SLIDER_GMB`, `SLIDER_LINK`, `SLIDER_STATUS`, `SLIDER_ADD`) VALUES
(1, '2.png', 'google.com', 'SEMBUNYI', 1539400148),
(2, 'Penguins1.jpg', 'google.com', 'SEMBUNYI', 1539400343),
(3, 'Koala1.jpg', 'google.com', 'SEMBUNYI', 1539400436),
(4, '067361800_1442825157-liputan6_kurban_673x373.jpg', 'google.com', 'TAMPIL', 1539401375),
(5, 'Lighthouse.jpg', 'google.com', 'SEMBUNYI', 1539409816),
(6, 'wallhaven-320709.png', 'google.com', 'SEMBUNYI', 1539410825),
(7, 'Qurban_5.jpg', 'google.com', 'TAMPIL', 1539422536),
(8, '1d149b69ee48b05ec0f859d605ec07d9.jpg', 'google.com', 'TAMPIL', 1539423654),
(9, 'Qurban_5.jpg', 'google.com', 'SEMBUNYI', 1541746551),
(10, 'khitdhys+logo+jombang+hitam+putih.jpg', 'google.com', 'TAMPIL', 1543227186);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabungan`
--

CREATE TABLE IF NOT EXISTS `tabungan` (
  `TABUNGAN_ID` int(11) NOT NULL,
  `MEMBER_ID` int(11) NOT NULL,
  `REKENING_ID` int(11) NOT NULL,
  `TABUNGAN_NOMINAL` int(11) NOT NULL,
  `TABUNGAN_TGL` date NOT NULL,
  `TABUNGAN_BUKTI` text NOT NULL,
  `TABUNGAN_CATATAN` text,
  `TABUNGAN_STATUS` enum('PROSES','TERIMA','TOLAK') NOT NULL,
  `TABUNGAN_ADD` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tabungan`
--

INSERT INTO `tabungan` (`TABUNGAN_ID`, `MEMBER_ID`, `REKENING_ID`, `TABUNGAN_NOMINAL`, `TABUNGAN_TGL`, `TABUNGAN_BUKTI`, `TABUNGAN_CATATAN`, `TABUNGAN_STATUS`, `TABUNGAN_ADD`) VALUES
(1, 1, 1, 1000000, '2018-10-16', 'Qurban_5.jpg', 'mohon maaf', 'TOLAK', 1539708212),
(2, 1, 1, 500000000, '2018-10-17', 'photo.jpg', 'Terimakasih telah menabung', 'TERIMA', 1539712021),
(3, 2, 1, 0, '2018-10-18', 'Untitled.png', 'Masukkan nominal yang sesuai ', 'TOLAK', 1539751513),
(4, 2, 1, 1000000, '2018-10-18', 'Untitled1.png', 'Terima kasih ', 'TERIMA', 1539751584),
(5, 4, 4, 12000, '2018-10-31', 'IMG_5945.PNG', NULL, 'PROSES', 1540957122),
(6, 1, 1, 200000, '2018-11-09', '1d149b69ee48b05ec0f859d605ec07d9.jpg', 'Terima kasih\r\n', 'TERIMA', 1541730896),
(7, 1, 1, 5000000, '2018-11-09', '067361800_1442825157-liputan6_kurban_673x373.jpg', 'terima', 'TERIMA', 1541770496),
(8, 1, 2, 50000, '2018-11-10', 'images.jpg', 'Terima kasih', 'TERIMA', 1541814711),
(9, 1, 2, 325435, '2018-11-26', 'kabupaten%2Bjombang%2Bvector%2Blogo.png', 'Terima Kasih', 'TERIMA', 1543231172),
(10, 1, 2, 1000000, '2018-11-27', 'google_logo_wall_android_26167_1600x1200.jpg', NULL, 'PROSES', 1543383849),
(11, 1, 2, 500000, '2018-11-28', 'Qurban_51.jpg', NULL, 'PROSES', 1543384672);

-- --------------------------------------------------------

--
-- Struktur dari tabel `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
  `UPLOADS_ID` int(11) NOT NULL,
  `UPLOADS_FILE` text NOT NULL,
  `UPLOADS_ADD` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `uploads`
--

INSERT INTO `uploads` (`UPLOADS_ID`, `UPLOADS_FILE`, `UPLOADS_ADD`) VALUES
(30, 'sitaqur.png', 1539499371),
(37, '1d149b69ee48b05ec0f859d605ec07d9.jpg', 1541174678),
(38, '1d149b69ee48b05ec0f859d605ec07d91.jpg', 1541746197),
(39, '067361800_1442825157-liputan6_kurban_673x373.jpg', 1541746211),
(41, 'Qurban_5.jpg', 1541746379),
(42, 'google_logo_wall_android_26167_1600x1200.jpg', 1541815919),
(43, '067361800_1442825157-liputan6_kurban_673x3731.jpg', 1541816014),
(44, 'Qurban_51.jpg', 1541816014),
(46, 'khitdhys+logo+jombang+hitam+putih.jpg', 1543226413);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`),
  ADD UNIQUE KEY `admin_username` (`ADMIN_USERNAME`);

--
-- Indexes for table `hewan`
--
ALTER TABLE `hewan`
  ADD PRIMARY KEY (`HEWAN_ID`),
  ADD UNIQUE KEY `HEWAN_NAMA` (`HEWAN_NAMA`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`INFO_ID`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`KERANJANG_ID`);

--
-- Indexes for table `lembaga`
--
ALTER TABLE `lembaga`
  ADD PRIMARY KEY (`LEMBAGA_ID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`MEMBER_ID`),
  ADD UNIQUE KEY `member_nip` (`MEMBER_EMAIL`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`NOTA_ID`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`PENGUNJUNG_ID`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`REKENING_ID`);

--
-- Indexes for table `saran`
--
ALTER TABLE `saran`
  ADD PRIMARY KEY (`SARAN_ID`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`SLIDER_ID`);

--
-- Indexes for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD PRIMARY KEY (`TABUNGAN_ID`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`UPLOADS_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ADMIN_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hewan`
--
ALTER TABLE `hewan`
  MODIFY `HEWAN_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `INFO_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `KERANJANG_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `lembaga`
--
ALTER TABLE `lembaga`
  MODIFY `LEMBAGA_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `MEMBER_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `nota`
--
ALTER TABLE `nota`
  MODIFY `NOTA_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `PENGUNJUNG_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `REKENING_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `saran`
--
ALTER TABLE `saran`
  MODIFY `SARAN_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `SLIDER_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tabungan`
--
ALTER TABLE `tabungan`
  MODIFY `TABUNGAN_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `UPLOADS_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
DELIMITER $$
--
-- Event
--
CREATE DEFINER=`root`@`localhost` EVENT `verfikasi_pendaftaran` ON SCHEDULE EVERY 1 MINUTE STARTS '2018-11-23 00:00:00' ENDS '2030-11-23 00:00:00' ON COMPLETION PRESERVE ENABLE DO DELETE FROM member WHERE MEMBER_VERIFIKASI = 'BELUM' AND MEMBER_ADD < UNIX_TIMESTAMP(now()) - 68400$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
