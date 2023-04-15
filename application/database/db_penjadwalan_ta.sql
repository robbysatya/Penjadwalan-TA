-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 15, 2023 at 12:44 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penjadwalan_ta`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_acak_sa`
--

CREATE TABLE `data_acak_sa` (
  `kode_sa` int NOT NULL,
  `hari` int NOT NULL,
  `jam` int NOT NULL,
  `tanggal` date DEFAULT NULL,
  `link` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_acak_sp`
--

CREATE TABLE `data_acak_sp` (
  `kode_sp` int NOT NULL,
  `kode_waktu` int NOT NULL,
  `dospeng_1` int NOT NULL,
  `dospeng_2` int NOT NULL,
  `tanggal` date DEFAULT NULL,
  `link` varchar(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_acak_sp`
--

INSERT INTO `data_acak_sp` (`kode_sp`, `kode_waktu`, `dospeng_1`, `dospeng_2`, `tanggal`, `link`) VALUES
(1, 11, 6, 7, NULL, NULL),
(2, 24, 8, 10, NULL, NULL),
(3, 25, 10, 3, NULL, NULL),
(4, 19, 9, 7, NULL, NULL),
(5, 44, 7, 9, NULL, NULL),
(6, 12, 11, 9, NULL, NULL),
(7, 35, 11, 9, NULL, NULL),
(8, 10, 5, 6, NULL, NULL),
(9, 21, 6, 7, NULL, NULL),
(10, 12, 10, 2, NULL, NULL),
(11, 34, 6, 8, NULL, NULL),
(12, 14, 7, 9, NULL, NULL),
(13, 32, 5, 3, NULL, NULL),
(14, 9, 2, 3, NULL, NULL),
(15, 16, 9, 6, NULL, NULL),
(16, 8, 2, 7, NULL, NULL),
(17, 11, 2, 6, NULL, NULL),
(18, 8, 8, 11, NULL, NULL),
(19, 25, 9, 4, NULL, NULL),
(20, 33, 4, 3, NULL, NULL),
(21, 31, 4, 10, NULL, NULL),
(22, 6, 2, 3, NULL, NULL),
(23, 36, 10, 4, NULL, NULL),
(24, 40, 2, 11, NULL, NULL),
(25, 24, 6, 2, NULL, NULL),
(32, 18, 6, 7, NULL, NULL),
(33, 18, 7, 7, NULL, NULL),
(34, 41, 2, 11, NULL, NULL),
(35, 36, 4, 7, NULL, NULL),
(36, 19, 2, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_dosen`
--

CREATE TABLE `tb_dosen` (
  `id` int NOT NULL,
  `nip` bigint NOT NULL,
  `nidn` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `keahlian_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_dosen`
--

INSERT INTO `tb_dosen` (`id`, `nip`, `nidn`, `name`, `email`, `keahlian_id`) VALUES
(1, 199111272022031007, '0027119101', 'Andika Setiawan, S.Kom., M.Cs.', 'andika.setiawan@if.itera.ac.id', 2),
(2, 199303142019031018, '0014039305', 'Ilham Firman Ashari, S.Kom., M.T.', 'firman.ashari@if.itera.ac.id', 1),
(3, 199105252022031002, '0025059109', 'Muhammad Habib Algifari, S.Kom., M.T.I.', 'muhammad.algifari@if.itera.ac.id', 3),
(4, 199411272020121018, '0027119401', 'Radhinka Bagaskara, S.Si., M.Si., M.Sc', 'radhinka.bagaskara@if.itera.ac.id', 2),
(5, 199307272022032022, '0027079304', 'Winda Yulita, S.Pd., M.Cs.\n', 'winda.yulita@if.itera.ac.id', 2),
(6, 198602142019031008, '0014028604', 'Andre Febrianto, S.Kom., M.Eng.', 'andre.febrianto@if.itera.ac.id', 3),
(7, 199104162019031015, '0', 'Aidil Afriansyah, S.Kom., M.Kom.', 'aidil.afriansyah@if.itera.ac.id', 3),
(8, 198905182019031011, '0', 'Meida Cahyo Untoro, S.Kom., M.Kom.', 'cahyo.untoro@if.itera.ac.id', 2),
(9, 198509212019031012, '0421098502', 'Mugi Praseptiawan, S.T., M.Kom.', 'mugi.praseptiawan@if.itera.ac.id', 1),
(10, 1991020920201279, '0509029102', 'Eko Dwi Nugroho, S.Kom., M.Cs.', 'eko.nugroho@if.itera.ac.id', 1),
(11, 0, '0', 'Miranti Verdiana, M.Si. ', 'miranti.verdiana@if.itera.ac.id', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_hari`
--

CREATE TABLE `tb_hari` (
  `kode_hari` int NOT NULL,
  `nama_hari` varchar(225) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_hari`
--

INSERT INTO `tb_hari` (`kode_hari`, `nama_hari`) VALUES
(1, 'Senin'),
(2, 'Selasa'),
(3, 'Rabu'),
(4, 'Kamis'),
(5, 'Jum\'at');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal_proposal`
--

CREATE TABLE `tb_jadwal_proposal` (
  `kode_jadwal_sp` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_sp` int NOT NULL,
  `dospeng_1` int NOT NULL,
  `dospeng_2` int NOT NULL,
  `hari` int NOT NULL,
  `jam` int NOT NULL,
  `tanggal` date NOT NULL,
  `link` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `tahun_ajaran` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `periode` varchar(225) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal_sidang`
--

CREATE TABLE `tb_jadwal_sidang` (
  `kode_jadwal_sa` varchar(225) NOT NULL,
  `kode_sa` int NOT NULL,
  `hari` int NOT NULL,
  `jam` int NOT NULL,
  `tanggal` date NOT NULL,
  `link` varchar(225) NOT NULL,
  `tahun_ajaran` varchar(225) NOT NULL,
  `periode` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jam_sempro`
--

CREATE TABLE `tb_jam_sempro` (
  `kode_jam` int NOT NULL,
  `range_jam` varchar(225) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jam_sempro`
--

INSERT INTO `tb_jam_sempro` (`kode_jam`, `range_jam`) VALUES
(1, '08.00-09.00'),
(2, '09.00-10.00'),
(3, '11.00-12.00'),
(4, '12.00-13.00'),
(5, '13.00-14.00'),
(6, '14.00-15.00'),
(7, '15.00-16.00'),
(8, '16.00-17.00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jam_sidang`
--

CREATE TABLE `tb_jam_sidang` (
  `kode_jam` int NOT NULL,
  `range_jam` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jam_sidang`
--

INSERT INTO `tb_jam_sidang` (`kode_jam`, `range_jam`) VALUES
(1, '08.00-10.00'),
(2, '10.00-12.00'),
(3, '12.00-14.00'),
(4, '14.00-16.00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_ujian`
--

CREATE TABLE `tb_jenis_ujian` (
  `id` int NOT NULL,
  `jenis_ujian` varchar(225) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jenis_ujian`
--

INSERT INTO `tb_jenis_ujian` (`id`, `jenis_ujian`) VALUES
(1, 'Seminar Proposal'),
(2, 'Seminar Hasil'),
(3, 'Sidang Akhir');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keahlian`
--

CREATE TABLE `tb_keahlian` (
  `id` int NOT NULL,
  `keahlian` varchar(225) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_keahlian`
--

INSERT INTO `tb_keahlian` (`id`, `keahlian`) VALUES
(1, 'Keamanan Siber dan Pervasif'),
(2, 'Artificial Intelegence dan Data Engineering'),
(3, 'Rekayasa Perangkat Lunak dan Sistem Informasi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_proposal`
--

CREATE TABLE `tb_proposal` (
  `kode_sp` int NOT NULL,
  `nim` int NOT NULL,
  `name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `judul` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `keahlian_id` int NOT NULL,
  `id_jenis_ujian` int NOT NULL,
  `dosbim_1` int NOT NULL,
  `dosbim_2` int NOT NULL,
  `file_draft` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `file_ppt` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `file_persetujuan` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `date_created` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_proposal`
--

INSERT INTO `tb_proposal` (`kode_sp`, `nim`, `name`, `email`, `judul`, `keahlian_id`, `id_jenis_ujian`, `dosbim_1`, `dosbim_2`, `file_draft`, `file_ppt`, `file_persetujuan`, `status`, `date_created`) VALUES
(1, 118140155, 'Robby Satya Wicaksana', 'robby.118140155@student.itera.ac.id', 'RANCANG BANGUN SISTEM PENJADWALAN TUGAS AKHIR DENGAN METODE ALGORITMA GENETIKA (STUDI KASUS: PROGRAM STUDI TEKNIK INFORMATIKA ITERA)', 2, 1, 2, 5, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(2, 118140154, 'Muhammad Adam Aslamsyah', 'muhammad.118140154@student.itera.ac.id', 'Pengembangan Sistem Peminjaman Alat Laboratorium Dan Pembuatan Surat Bebas Laboratorium Menggunakan Metode Agile (Studi Kasus: UPT Lab Terpadu Itera)', 3, 1, 1, 7, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(3, 118140156, 'Muhammad Zulfarhan', 'muhammad.118140156@student.itera.ac.id', 'PERBANDINGAN METODE TREND MOMENT DENGAN DOUBLE EXPONENTIAL SMOOTHING HOLT UNTUK PREDIKSI PENJUALAN ALAT PEMADAM KEBAKARAN', 2, 1, 8, 5, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(4, 118140161, 'Muhammad Rafi Farhan', 'muhammad.118140161@student.itera.ac.id', 'RANCANG BANGUN SISTEM POINT OF SALES (POS) BERBASIS PROGRESIF WEB APP (PWA) Studi Kasus (UD. Amanah)', 3, 1, 6, 3, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(5, 118140136, 'Muhammad Nashrullah', 'muhammad.118140136@student.itera.ac.id', 'ANALISIS PENGARUH PENERAPAN KOMPUTASI PARALEL TERHADAP WAKTU KOMPUTASI ALGORITMA TIM SORT MENGGUNAKAN OPENMP DAN PTHREAD', 2, 1, 10, 2, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(6, 118140164, 'Muhammad Abdul Hakim', 'hakim.118140164@student.itera.ac.id', 'Evaluasi Dan Pengembangan Website Smas Kartikatama Metro Menggunakan Metode Goal Directed Design Dan Rapid Application Development', 2, 1, 9, 7, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(7, 118140166, 'Aris Ilham Nugraha', 'aris.118140166@student.itera.ac.id', 'Rancang Bangun Sistem Inventori Sarana dan Prasarana Sekolah Menggunakan Metode SDLC Waterfall Berbasis Web (Studi Kasus: SMA Yadika Soreang)', 3, 1, 6, 9, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(8, 118140058, 'Andika Saputra', 'andika.118140058@student.itera.ac.id', 'Klasifikasi Tipe Sel Darah Putih Dengan Metode Seed Region Growing dan Learning Vector Quantization', 2, 1, 1, 5, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(9, 118140124, 'Annisa Jufe Aryani', 'annisa.118140124@student.itera.ac.id', 'KLASIFIKASI CITRA KAIN BATIK LAMPUNG MENGGUNAKAN METODE K-NEAREST NEIGHBOR DENGAN EKSTRAKSI CIRI WARNA DAN TEKSTUR', 2, 1, 1, 2, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(10, 118140088, 'Ardi Gaya Manalu', 'ardi.118140088@student.itera.ac.id', 'PENGEMBANGAN SISTEM INFORMASI INVENTORY DAN PENJUALAN OBAT BERBASIS WEB MENGGUNAKAN METODE WATERFALL (STUDI KASUS : RSUD JEND A. YANI METRO )', 3, 1, 6, 3, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(11, 118140153, 'Aulia Belsasar', 'aulia.118140153@student.itera.ac.id', 'ANALISIS TINGKAT KEPUASAAN MAHASISWA TERHADAP SISTEM INFORMASI AKADEMIK (SIAKAD) INSTITUT TEKNOLOGI SUMATERA DENGAN METODE KANO', 2, 1, 2, 9, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(12, 118140041, 'Aulia Ul Izzatil Adilah', 'aulia.118140041@student.itera.ac.id', 'Rancang Bangun UI/UX Aplikasi Kesehatan Mental: Lucely Menggunakan Metode User Centered Design dan Usability Cognitive Walkthrough (Studi Kasus: Mahasiswa D1-S1 di Provinsi Lampung)', 3, 1, 1, 5, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(13, 118140023, 'Christop Pasu Marpaung', 'christop.118140023@student.itera.ac.id', 'PENGEMBANGAN SISTEM INFORMASI MENGGUNAKAN METODE PERSONAL EXTREME PROGRAMMING DENGAN MODEL PROSES ANWER-AFBAT (STUDI KASUS JASA CUCI MOBIL PASU JAYA)', 3, 1, 7, 10, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(14, 118140002, 'Citra Amelia', 'citra.118140002@student.itera.ac.id', 'Analisa Perbandingan Metode Kompresi Pesan Dengan Metode LZW Dan Deflate Pada Proses Penyisipan Citra Digital Menggunaan Metode Steganografi Bpcs Ke Dalam Citra Digital', 2, 1, 2, 10, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(15, 118140080, 'Daniel Sipangkar', 'daniel.118140080@student.itera.ac.id', 'EVALUASI DISTANCE EUCLIDEAN MANHATTAN DAN COSINE PADA ALGORITMA K-NEAREST NEIGHBOR UNTUK KLASIFIKASI CITRA MRI TUMOR OTAK', 2, 1, 8, 4, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(16, 118140104, 'Deo Alif Alfitrah', 'deo.118140104@student.itera.ac.id', 'RANCANG BANGUN SISTEM INFORMASI PENGAJUAN IZIN BELAJAR DAN TUGAS BELAJAR ASN BERBASIS WEBSITE DENGAN METODE WATERFALL (STUDI KASUS : RSUD JEND. AHMAD YANI METRO)', 3, 1, 6, 7, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(17, 118140182, 'Dhanny Adhi Pramana', 'dhanny.118140182@student.itera.ac.id', 'RANCANG BANGUN SISTEM LAYANAN PENELITIAN BERBASIS WEB MENGGUNAKAN METODE RAD MODEL (STUDI KASUS: KEBUN RAYA ITERA)', 3, 1, 6, 3, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(18, 118140035, 'Eri Yuni Nilasari', 'eri.118140035@student.itera.ac.id', 'Klasifikasi Jenis Cabai Menggunakan Metode Naive Bayes Dengan Ekstraksi Fitur Warna dan Bentuk', 2, 1, 1, 8, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(19, 118140121, 'Fajari Bagas Imami', 'fajari.118140121@student.itera.ac.id', 'PENGEMBANGAN USER INTERFACE WEB AUTOMATIC SCORING PURINO ITERA MENGGUNAKAN METODE USER CENTERED DESIGN DAN SUPR-Q', 3, 1, 2, 7, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(20, 118140012, 'Farhan Herliansyah', 'farhan.118140012@student.itera.ac.id', 'Sistem otomasi kandang terhadap peternakan ayam potong dengan metode Fuzzy Logic berbasis Internet of Things', 3, 1, 2, 9, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(21, 118140137, 'Febby Sartika', 'febby.118140137@student.itera.ac.id', 'EVALUASI SUPPORT VECTOR MACHINE DAN NEURAL NETWORK UNTUK ANALISIS SENTIMEN PADA RESESI EKONOMI GLOBAL', 2, 1, 8, 10, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(22, 118140101, 'Rahmat Ramadhan', 'rahmat.118140101@student.itera.ac.id', 'Rancang Bangun E-Modul untuk Massive Open Online Course (MOOC) Berbasis Preferensi Gaya Belajar Siswa dengan Metode Feature Driven Development (FDD) ', 3, 1, 9, 4, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(23, 118140115, 'Hamidah Firoos', 'hamidah.118104115@student.itera.ac.id', 'PERINGKASAN TEKS BERITA OTOMATIS DENGAN METODE MAXIMUM MARGINAL RELEVANCE (MMR) DENGAN PENERAPAN PART-OF-SPEECH (POS) TAGGING', 2, 1, 5, 8, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(24, 118140142, 'Khoirul Roziq', 'khoirul.118140142@student.itera.ac.id', 'PENGEMBANGAN SISTEM PAKAR TAJWID PADA AL-QURAN MENGGUNAKAN METODE FORWARD CHAINING DAN KNUTH MORRIS PRATT BERBASIS WEBSITE', 2, 1, 1, 8, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(25, 118140138, 'M. Afif Hibatullah', 'm.118140138@student.itera.ac.id', 'Pengembangan Sistem Informasi Rencana Anggaran Belanja UPT Laboratorium Terpadu Dengan Metode Waterfall', 3, 1, 1, 6, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(26, 118140125, 'Ribka Julyasih Sidabutar', 'ribka.118140102@student.itera.ac.id', 'RANCANG BANGUN SISTEM PRESENSI QR CODE DAN HONOR ASISTEN PRAKTIKUM BERBASIS WEB DENGAN MENGGUNAKAN METODE DSDM (STUDI KASUS: LABORATORIUM MULTIMEDIA ITERA)', 3, 1, 2, 10, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(27, 118140102, 'M. Galih Pratama', 'm.118140102@student.itera.ac.id', 'Rancang Bangun Sistem Inventory Barang Berbasis Android dengan Pendekatan Metode Scrum (Studi Kasus : Toko Galih)', 3, 1, 8, 1, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(28, 118140025, 'Mahdia Nisrina', 'mahdia.118140025@student.itera.ac.id', 'RANCANG BANGUN SISTEM INFORMASI PENYEWAAN ALAT BERAT BERBASIS WEB MENGGUNAKAN METODE AGILE (STUDI KASUS : PT. TRAS RENTAL UTAMA EKAMULYA)', 3, 1, 7, 4, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(29, 118140062, 'Leonard Rizta Anugerah Perdana', 'leonard.118140062@student.itera.ac.id', 'PENGENALAN KOLEKSI KAIN TENUN TRADISIONAL PADA MUSEUM BERBASIS CITRA DIGITAL MENGGUNAKAN YOLOv4 (STUDI KASUS: MUSEUM LAMPUNG)', 2, 1, 1, 2, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(30, 118140018, 'Michael Jireh Martua', 'michael.118140018@student.itera.ac.id', 'Pemodelan Prediksi Tinggi Gelombang Menggunakan Metode XG   Boost Dengan Generic Algorithm', 2, 1, 5, 2, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(31, 118140095, 'Muhammad Ariq Rafi', 'muhammad.118140095@student.itera.ac.id', 'Perbandingan Algoritma Dijkstra dan Algoritma Bellman-Ford Pada Pencarian Rute Terpendek', 2, 1, 1, 2, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(32, 119140011, 'Winda Sulistyani', 'winda.119140011@student.itera.ac.id', 'Kombinasi K-Nearest Neighbor Menggunakan Particle Swarm Optimization Untuk Klasifikasi Penyakit Pada Daun Kopi', 2, 1, 8, 5, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(33, 119140141, 'Apri Kurniawansyah', 'apri.119140141@student.itera.ac.id', 'PERANCANGAN SISTEM INFORMASI PEMBUKUAN KOPERASI DENGAN METODE EXTREME PROGRAMMING (XP) (STUDI KASUS: KOPERASI ARGO MULYO LESTARI)', 3, 1, 9, 8, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(34, 119140203, 'Akmal Fauzan Suranta', 'akmal.119140203@studen.itera.ac.id', 'Rancang Bangun Sistem informasi Basis Data Objek Langit Berbasis Website Dengan Metode Spiral (Studi Kasus: Pusat Observatorium Itera Lampung)', 3, 1, 3, 10, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(35, 119140209, 'Muhammad Nadhif Athalla', 'muhammad.119140209@student.itera.ac.id', 'PERBANDINGAN KINERJA MODEL KLASIFIKASI TINGKAT ADIKSI NIKOTIN MENGGUNAKAN ALGORITMA C4.5 DAN NAIVE BAYES BERBASIS SELEKSI ATRIBUT DENGAN METODE CHI-SQUARE', 2, 1, 2, 8, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(36, 119140056, 'Pillio Ardhil', 'pillio.119140056@student.itera.ac.id', 'SISTEM PENDUKUNG KEPUTUSAN CALON PENERIMA BANTUAN SOSIAL (BANSOS) MENGGUNAKAN METODE WEIGHTED PRODUCT (WP) DAN WEIGHTED SUM MODEL (WSM)', 2, 1, 9, 4, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 1, 1680754006),
(37, 119140110, 'Aulia Rahman Zulfi', 'aulia.119140110@student.itera.ac.id', 'Aplikasi Analisis Dan Pemetaan Kepegawaian Berbasis Pengalaman Dan Perpangkatan Dengan Metode Waterfall (Studi Kasus : Dinas Perhubungan Provinsi Lampung)', 3, 1, 3, 2, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(38, 119140050, 'Sherin Mediana Putri', 'Sherin.119140050@student.itera.ac.id', 'RANCANG BANGUN SISTEM INFORMASI MANAJEMEN PENGELOLAAN KEGIATAN DENGAN MENGGUNAKAN METODE PERSONAL EXTREME PROGRAMMING (STUDI KASUS : RADAR LAMPUNG)', 3, 1, 1, 6, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(39, 119140218, 'Andhika Wibawa Bhagaskara', 'andhika.119140218@student.itera.ac.id', 'RANCANG BANGUN ALAT MONITORING KONDISI LAUT BERBASIS IOT DAN FUZZY TSUKAMOTO UNTUK PENGKATEGORIAN KEAMANAN LAUT (STUDI KASUS: TELUK KILUAN LAMPUNG)', 3, 1, 1, 2, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(40, 119140039, 'Romaita Maria Simaibang', 'romaita.119140039@student.itera.ac.id', 'ANALISIS MENGHITUNG JUMLAH KENDARAAN MENGGUNAKAN ALGORITMA GAUSSIAN MIXTURE MODEL DAN ALGORITMA KALMAN FILTER', 2, 1, 2, 5, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(41, 119140199, 'Muhammad Fariz Luthfi', 'muhammad.119140199@student.itera.ac.id', 'RANCANG BANGUN SISTEM PAKAR ADHD (ATTENTION DEFICIT HYPERACTIVITY DISORDER) DENGAN METODE CERTAINTY FACTOR', 2, 1, 8, 3, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(42, 119140167, 'Muksin Bagaskara', 'muksin.119140167@student.itera.ac.id', 'PENGEMBANGAN SISTEM INFORMASI MANAJEMEN DATA TUMBUHAN PADA KEBUN RAYA DENGAN METODE PERSONAL EXTREME PROGRAMMING (STUDI KASUS : KEBUN RAYA ITERA)', 3, 1, 6, 3, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(43, 119140104, 'Samuel Jovial Pardede', 'samuel.119140104@student.itera.ac.id', 'PERANCANGAN SAFETY ASSIST PADA SEPEDA MOTOR BERBASIS MOBILE MENGGUNAKAN LOGIKA FUZZY SUGENO', 2, 1, 2, 10, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(44, 119140097, 'Albab Jannatul Firdaus', 'albab.119140097@student.itera.ac.id', 'SISTEM INFORMASI ITERA BERQURBAN BERBASIS WEBSITE DENGAN METODE RAD (STUDI KASUS INSTITUT TEKNOLOGI SUMATERA)', 3, 1, 6, 3, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(45, 118140063, 'Rasyidah Herawati', 'rasyidah.119140009@student.itera.ac.id', 'Sistem Pendukung Keputusan Pengangkatan Karyawan Tetap Dengan Metode Simple Additive Weighting (SAW) (Studi Kasus: PT. Sinar Pematang Mulia II)', 3, 1, 3, 9, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(46, 119140155, 'Pipit Nizaria', 'pipit.119140155@student.itera.ac.id', 'PENGEMBANGAN ANTARMUKA & FRONT-END APLIKASI MARKETPLACE MAKANAN DAN MINUMAN HALAL HARARU (???) DENGAN  PENDEKATAN USER-CENTERED DESIGN', 3, 1, 6, 1, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(47, 119140170, 'Muhammad Aldito Rizki', 'muhammad.119140170@student.itera.ac.id', 'KLASIFIKASI HOAX TERHADAP BERITA CRYPTOCURRENCY PADA SOSIAL MEDIA TWITTER DENGAN METODE MODIFIED K-NEAREST NEIGHBOR (MK-NN)', 2, 1, 5, 4, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(48, 119140070, 'Stephanie Helen Parida Napitupulu', 'stephanie.119140070@student.itera.ac.id', 'RANCANG BANGUN SISTEM INFORMASI MANAJEMEN PERPUSTAKAAN BERBASIS WEBSITE DENGAN QR-CODE MENGGUNAKAN METODE WATERFALL (STUDI KASUS : SMA NEGERI 1 BANDAR)', 3, 1, 9, 5, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(49, 14117023, 'Muhammad Izzul Islam', 'muhammad.14117023@student.itera.ac.id', 'Sistem Monitoring dan Kontroling Kandang Ternak Ayam Petelur Berbasis Internet of Things Menggunakan Metode Fuzzy Logic Sugeno', 2, 1, 2, 1, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(50, 14117018, 'Jeans Prima Simaremare', 'jeans.14117018@student.itera.ac.id', 'EKSTRAKSI DAN KLASIFIKASI KATA DASAR DARI DOKUMEN BERBAHASA BATAK TOBA DENGAN ALGORITMA PORTER STEMMER DAN LIKELIHOOD ', 2, 1, 7, 4, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(51, 14117017, 'Diza Febriyan Hasal', 'diza.14117017@student.itera.ac.id', 'TRANSFER LEARNING UNTUK PENDETEKSI MASKER WAJAH PADA CITRA TERMAL UNTUK KASUS PENGUKURAN RESPIRASI NON KONTAK', 2, 1, 2, 9, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(52, 14117132, 'Samlo Berutu', 'samlo.14117132@student.itera.ac.id', 'PENGEMBANGAN AUGMENTED REALITY SEBAGAI MEDIA EDUKASI PENGENALAN HEWAN DAN BUAH UNTUK ANAK USIA DINI DENGAN METODE MARKERLESS', 2, 1, 8, 9, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(53, 14117120, 'Febiola Agatha', 'febiola.14117120@student.itera.ac.id', 'KLASIFIKASI CITRA PENYAKIT PADA TANAMAN LIDAH BUAYA (ALOE VERA) MENGGUNAKAN METODE CONVOLUTIONAL NEURAL NETWORK DAN CONVOLUTIONAL AUTOENCODER', 2, 1, 8, 2, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(54, 14117040, 'Yustika Ayu Putri Zalukhu', 'yustika.14117040@student.itera.ac.id', 'KOMPARASI TF-IDF DAN TF-IDF-DF PADA ANALISIS SENTIMEN UU TPKS MENGGUNAKAN METODE SVM BERBASIS PSO', 2, 1, 2, 10, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(55, 14116032, 'Faizal Alif', 'faizal.14116032@student.itera.ac.id', 'SISTEM INFORMASI AKADEMIK SEKOLAH MENGGUNAKAN METODE RAPID APPLICATION DEVELOPMENT', 3, 1, 9, 10, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(56, 14116105, 'Muhammad Fahmi Akbar', 'muhammad.14116105@student.itera.ac.id', 'KLASIFIKASI DATA GEMPA BUMI DI INDONESIA MENGGUNAKAN ALGORITMA LOGISTIC REGRESSION  DESCISION TREE DAN RANDOM FOREST', 2, 1, 8, 7, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(57, 14116140, 'Qisra Lutfi Ranev', 'qisra.14116140@student.itera.ac.id', 'PERANCANGAN APLIKASI MOBILE UNTUK MENGUKUR KETINGGIAN GELOMBANG AIR LAUT DENGAN METODE WATERFALL ITERATIVE MODEL', 3, 1, 8, 9, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(58, 14116139, 'Joddy Sebastian Siregar', 'joddy.14116139@student.itera.ac.id', 'PERBANDINGAN METODE PEMBOBOTAN KATA TF-IDF DENGAN TF-RF PADA PERINGKASAN TEKS BERITA OTOMATIS DENGAN METODE MAXIMUM MARGINAL RELEVANCE', 2, 1, 5, 1, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(59, 14116082, 'Rade Arthur Mangaratua Oktavianus', 'rade.14116082@student.itera.ac.id', 'IMPLEMENTASI ALGORITMA K-MEANS DALAM DATA MINING UNTUK CLUSTERING DATA COVID-19 GLOBAL', 2, 1, 8, 5, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006),
(60, 118140073, 'Iwang Nur Hakiki', 'iwang.118140073@student.itera.ac.id', 'SISTEM INFORMASI LAYANAN ONLINE SALON KECANTIKAN BERBASIS WEBSITE MENGGUNAKAN METODE PERSONAL EXTREME PROGRAMMING (Studi Kasus: INDAHKARLINA.BEAUTYHOUSE)', 3, 1, 6, 7, 'draft.pdf', 'ppt.pdf', 'persetujuan.pdf', 2, 1680754006);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sidang`
--

CREATE TABLE `tb_sidang` (
  `kode_sa` int NOT NULL,
  `nim` int NOT NULL,
  `name` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `judul` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `keahlian_id` int NOT NULL,
  `id_jenis_ujian` int NOT NULL,
  `dosbim_1` int NOT NULL,
  `dosbim_2` int NOT NULL,
  `dospeng_1` int NOT NULL,
  `dospeng_2` int NOT NULL,
  `file_draft` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `file_ppt` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `file_persetujuan` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `date_created` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_waktu_sempro`
--

CREATE TABLE `tb_waktu_sempro` (
  `kode_waktu` int NOT NULL,
  `hari` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `jam` varchar(225) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_waktu_sempro`
--

INSERT INTO `tb_waktu_sempro` (`kode_waktu`, `hari`, `jam`) VALUES
(1, 'Senin', '08.00-09.00'),
(2, 'Senin', '09.00-10.00'),
(3, 'Senin', '10.00-11.00'),
(4, 'Senin', '11.00-12.00'),
(5, 'Senin', '12.00-13.00'),
(6, 'Senin', '13.00-14.00'),
(7, 'Senin', '14.00-15.00'),
(8, 'Senin', '15.00-16.00'),
(9, 'Senin', '16.00-17.00'),
(10, 'Selasa', '08.00-09.00'),
(11, 'Selasa', '09.00-10.00'),
(12, 'Selasa', '10.00-11.00'),
(13, 'Selasa', '11.00-12.00'),
(14, 'Selasa', '12.00-13.00'),
(15, 'Selasa', '13.00-14.00'),
(16, 'Selasa', '14.00-15.00'),
(17, 'Selasa', '15.00-16.00'),
(18, 'Selasa', '16.00-17.00'),
(19, 'Rabu', '08.00-09.00'),
(20, 'Rabu', '09.00-10.00'),
(21, 'Rabu', '10.00-11.00'),
(22, 'Rabu', '11.00-12.00'),
(23, 'Rabu', '12.00-13.00'),
(24, 'Rabu', '13.00-14.00'),
(25, 'Rabu', '14.00-15.00'),
(26, 'Rabu', '15.00-16.00'),
(27, 'Rabu', '16.00-17.00'),
(28, 'Kamis', '08.00-09.00'),
(29, 'Kamis', '09.00-10.00'),
(30, 'Kamis', '10.00-11.00'),
(31, 'Kamis', '11.00-12.00'),
(32, 'Kamis', '12.00-13.00'),
(33, 'Kamis', '13.00-14.00'),
(34, 'Kamis', '14.00-15.00'),
(35, 'Kamis', '15.00-16.00'),
(36, 'Kamis', '16.00-17.00'),
(37, 'Jum\'at', '08.00-09.00'),
(38, 'Jum\'at', '09.00-10.00'),
(39, 'Jum\'at', '10.00-11.00'),
(40, 'Jum\'at', '11.00-12.00'),
(41, 'Jum\'at', '13.00-14.00'),
(42, 'Jum\'at', '14.00-15.00'),
(43, 'Jum\'at', '15.00-16.00'),
(44, 'Jum\'at', '16.00-17.00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `nim` int NOT NULL,
  `name` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int DEFAULT NULL,
  `is_active` int NOT NULL,
  `status` int NOT NULL,
  `alasan` varchar(225) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_created` int NOT NULL,
  `last_login` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nim`, `name`, `email`, `password`, `image`, `role_id`, `is_active`, `status`, `alasan`, `date_created`, `last_login`) VALUES
(1, 0, 'Administrator', 'adminsistemtaif@admin.com', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 1, 1, 1, NULL, 0, '2023-02-13 20:23:14'),
(2, 118140155, 'Robby Satya Wicaksana', 'robby.118140155@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(3, 118140154, 'Muhammad Adam Aslamsyah', 'muhammad.118140154@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(4, 118140156, 'Muhammad Zulfarhan', 'muhammad.118140156@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(5, 118140161, 'Muhammad Rafi Farhan', 'muhammad.118140161@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(6, 118140136, 'Muhammad Nashrullah', 'muhammad.118140136@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(7, 118140164, 'Muhammad Abdul Hakim', 'hakim.118140164@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(8, 118140166, 'Aris Ilham Nugraha', 'aris.118140166@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(9, 118140058, 'Andika Saputra', 'andika.118140058@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(10, 118140124, 'Annisa Jufe Aryani', 'annisa.118140124@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(11, 118140088, 'Ardi Gaya Manalu', 'ardi.118140088@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(12, 118140153, 'Aulia Belsasar', 'aulia.118140153@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(13, 118140041, 'Aulia Ul Izzatil Adilah', 'aulia.118140041@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(14, 118140023, 'Christop Pasu Marpaung', 'christop.118140023@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(15, 118140002, 'Citra Amelia', 'citra.118140002@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(16, 118140080, 'Daniel Sipangkar', 'daniel.118140080@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(17, 118140104, 'Deo Alif Alfitrah', 'deo.118140104@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(18, 118140182, 'Dhanny Adhi Pramana', 'dhanny.118140182@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(19, 118140035, 'Eri Yuni Nilasari', 'eri.118140035@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(20, 118140121, 'Fajari Bagas Imami', 'fajari.118140121@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(21, 118140012, 'Farhan Herliansyah', 'farhan.118140012@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(22, 118140137, 'Febby Sartika', 'febby.118140137@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(23, 118140101, 'Rahmat Ramadhan', 'rahmat.118140101@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(24, 118140115, 'Hamidah Firoos', 'hamidah.118104115@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(25, 118140142, 'Khoirul Roziq', 'khoirul.118140142@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(26, 118140138, 'M. Afif Hibatullah', 'm.118140138@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(27, 118140125, 'Ribka Julyasih Sidabutar', 'ribka.118140102@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(28, 118140102, 'M. Galih Pratama', 'm.118140102@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(29, 118140025, 'Mahdia Nisrina', 'mahdia.118140025@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(30, 118140062, 'Leonard Rizta Anugerah Perdana', 'leonard.118140062@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(31, 118140018, 'Michael Jireh Martua', 'michael.118140018@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(32, 118140095, 'Muhammad Ariq Rafi', 'muhammad.118140095@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(33, 119140011, 'Winda Sulistyani', 'winda.119140011@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(34, 119140141, 'Apri Kurniawansyah', 'apri.119140141@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(35, 119140203, 'Akmal Fauzan Suranta', 'akmal.119140203@studen.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(36, 119140209, 'Muhammad Nadhif Athalla', 'muhammad.119140209@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(37, 119140056, 'Pillio Ardhil', 'pillio.119140056@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 1, NULL, 0, NULL),
(38, 119140110, 'Aulia Rahman Zulfi', 'aulia.119140110@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(39, 119140050, 'Sherin Mediana Putri', 'Sherin.119140050@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(40, 119140218, 'Andhika Wibawa Bhagaskara', 'andhika.119140218@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(41, 119140039, 'Romaita Maria Simaibang', 'romaita.119140039@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(42, 119140199, 'Muhammad Fariz Luthfi', 'muhammad.119140199@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(43, 119140167, 'Muksin Bagaskara', 'muksin.119140167@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(44, 119140104, 'Samuel Jovial Pardede', 'samuel.119140104@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(45, 119140097, 'Albab Jannatul Firdaus', 'albab.119140097@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(46, 118140063, 'Rasyidah Herawati', 'rasyidah.119140009@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(47, 119140155, 'Pipit Nizaria', 'pipit.119140155@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(48, 119140170, 'Muhammad Aldito Rizki', 'muhammad.119140170@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(49, 119140070, 'Stephanie Helen Parida Napitupulu', 'stephanie.119140070@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(50, 14117023, 'Muhammad Izzul Islam', 'muhammad.14117023@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(51, 14117018, 'Jeans Prima Simaremare', 'jeans.14117018@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(52, 14117017, 'Diza Febriyan Hasal', 'diza.14117017@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(53, 14117132, 'Samlo Berutu', 'samlo.14117132@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(54, 14117120, 'Febiola Agatha', 'febiola.14117120@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(55, 14117040, 'Yustika Ayu Putri Zalukhu', 'yustika.14117040@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(56, 14116032, 'Faizal Alif', 'faizal.14116032@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(57, 14116105, 'Muhammad Fahmi Akbar', 'muhammad.14116105@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(58, 14116140, 'Qisra Lutfi Ranev', 'qisra.14116140@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(59, 14116139, 'Joddy Sebastian Siregar', 'joddy.14116139@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(60, 14116082, 'Rade Arthur Mangaratua Oktavianus', 'rade.14116082@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL),
(61, 118140073, 'Iwang Nur Hakiki', 'iwang.118140073@student.itera.ac.id', '$2y$10$0avlTVbcd2ahYsygTzbFNOQC.EmwdUIH6kszZdkPh2SGG6Qc/jW7G', 'default.jpg', 2, 1, 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int NOT NULL,
  `role` varchar(225) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int NOT NULL,
  `email` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_acak_sa`
--
ALTER TABLE `data_acak_sa`
  ADD UNIQUE KEY `hari` (`hari`,`jam`),
  ADD UNIQUE KEY `kode_sa` (`kode_sa`),
  ADD KEY `jam` (`jam`);

--
-- Indexes for table `data_acak_sp`
--
ALTER TABLE `data_acak_sp`
  ADD UNIQUE KEY `kode_sp` (`kode_sp`,`dospeng_1`,`dospeng_2`),
  ADD KEY `dospeng_1` (`dospeng_1`),
  ADD KEY `dospeng_2` (`dospeng_2`),
  ADD KEY `kode_sp_2` (`kode_sp`),
  ADD KEY `kode_sp_3` (`kode_sp`);

--
-- Indexes for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keahlian_id` (`keahlian_id`);

--
-- Indexes for table `tb_hari`
--
ALTER TABLE `tb_hari`
  ADD PRIMARY KEY (`kode_hari`);

--
-- Indexes for table `tb_jadwal_proposal`
--
ALTER TABLE `tb_jadwal_proposal`
  ADD UNIQUE KEY `kode_sp_2` (`kode_sp`),
  ADD UNIQUE KEY `dospeng_1` (`dospeng_1`,`dospeng_2`,`hari`,`jam`),
  ADD KEY `kode_sp` (`kode_sp`,`dospeng_1`,`dospeng_2`,`hari`,`jam`),
  ADD KEY `dospeng_2` (`dospeng_2`),
  ADD KEY `hari` (`hari`),
  ADD KEY `jam` (`jam`);

--
-- Indexes for table `tb_jadwal_sidang`
--
ALTER TABLE `tb_jadwal_sidang`
  ADD UNIQUE KEY `kode_sa` (`kode_sa`,`hari`,`jam`),
  ADD KEY `hari` (`hari`),
  ADD KEY `jam` (`jam`);

--
-- Indexes for table `tb_jam_sempro`
--
ALTER TABLE `tb_jam_sempro`
  ADD PRIMARY KEY (`kode_jam`);

--
-- Indexes for table `tb_jam_sidang`
--
ALTER TABLE `tb_jam_sidang`
  ADD PRIMARY KEY (`kode_jam`);

--
-- Indexes for table `tb_jenis_ujian`
--
ALTER TABLE `tb_jenis_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_keahlian`
--
ALTER TABLE `tb_keahlian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_proposal`
--
ALTER TABLE `tb_proposal`
  ADD PRIMARY KEY (`kode_sp`),
  ADD KEY `dosbim_1` (`dosbim_1`,`dosbim_2`),
  ADD KEY `keahlian_id` (`keahlian_id`,`id_jenis_ujian`),
  ADD KEY `dosbim_2` (`dosbim_2`),
  ADD KEY `id_jenis_ujian` (`id_jenis_ujian`);

--
-- Indexes for table `tb_sidang`
--
ALTER TABLE `tb_sidang`
  ADD PRIMARY KEY (`kode_sa`),
  ADD KEY `keahlian_id` (`keahlian_id`,`id_jenis_ujian`,`dosbim_1`,`dosbim_2`,`dospeng_1`,`dospeng_2`),
  ADD KEY `keahlian_id_2` (`keahlian_id`,`id_jenis_ujian`,`dosbim_1`,`dosbim_2`,`dospeng_1`,`dospeng_2`),
  ADD KEY `id_jenis_ujian` (`id_jenis_ujian`),
  ADD KEY `dosbim_1` (`dosbim_1`),
  ADD KEY `dosbim_2` (`dosbim_2`),
  ADD KEY `dospeng_1` (`dospeng_1`),
  ADD KEY `dospeng_2` (`dospeng_2`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_jenis_ujian`
--
ALTER TABLE `tb_jenis_ujian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_keahlian`
--
ALTER TABLE `tb_keahlian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_proposal`
--
ALTER TABLE `tb_proposal`
  MODIFY `kode_sp` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tb_sidang`
--
ALTER TABLE `tb_sidang`
  MODIFY `kode_sa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_acak_sa`
--
ALTER TABLE `data_acak_sa`
  ADD CONSTRAINT `data_acak_sa_ibfk_1` FOREIGN KEY (`hari`) REFERENCES `tb_hari` (`kode_hari`),
  ADD CONSTRAINT `data_acak_sa_ibfk_2` FOREIGN KEY (`jam`) REFERENCES `tb_jam_sidang` (`kode_jam`),
  ADD CONSTRAINT `data_acak_sa_ibfk_3` FOREIGN KEY (`kode_sa`) REFERENCES `tb_sidang` (`kode_sa`);

--
-- Constraints for table `data_acak_sp`
--
ALTER TABLE `data_acak_sp`
  ADD CONSTRAINT `data_acak_sp_ibfk_1` FOREIGN KEY (`kode_sp`) REFERENCES `tb_proposal` (`kode_sp`),
  ADD CONSTRAINT `data_acak_sp_ibfk_4` FOREIGN KEY (`dospeng_1`) REFERENCES `tb_dosen` (`id`),
  ADD CONSTRAINT `data_acak_sp_ibfk_5` FOREIGN KEY (`dospeng_2`) REFERENCES `tb_dosen` (`id`);

--
-- Constraints for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD CONSTRAINT `tb_dosen_ibfk_1` FOREIGN KEY (`keahlian_id`) REFERENCES `tb_keahlian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_jadwal_proposal`
--
ALTER TABLE `tb_jadwal_proposal`
  ADD CONSTRAINT `tb_jadwal_proposal_ibfk_1` FOREIGN KEY (`kode_sp`) REFERENCES `tb_proposal` (`kode_sp`),
  ADD CONSTRAINT `tb_jadwal_proposal_ibfk_2` FOREIGN KEY (`dospeng_1`) REFERENCES `tb_dosen` (`id`),
  ADD CONSTRAINT `tb_jadwal_proposal_ibfk_3` FOREIGN KEY (`dospeng_2`) REFERENCES `tb_dosen` (`id`),
  ADD CONSTRAINT `tb_jadwal_proposal_ibfk_4` FOREIGN KEY (`hari`) REFERENCES `tb_hari` (`kode_hari`),
  ADD CONSTRAINT `tb_jadwal_proposal_ibfk_5` FOREIGN KEY (`jam`) REFERENCES `tb_jam_sempro` (`kode_jam`);

--
-- Constraints for table `tb_jadwal_sidang`
--
ALTER TABLE `tb_jadwal_sidang`
  ADD CONSTRAINT `tb_jadwal_sidang_ibfk_1` FOREIGN KEY (`kode_sa`) REFERENCES `tb_sidang` (`kode_sa`),
  ADD CONSTRAINT `tb_jadwal_sidang_ibfk_2` FOREIGN KEY (`hari`) REFERENCES `tb_hari` (`kode_hari`),
  ADD CONSTRAINT `tb_jadwal_sidang_ibfk_3` FOREIGN KEY (`jam`) REFERENCES `tb_jam_sidang` (`kode_jam`);

--
-- Constraints for table `tb_proposal`
--
ALTER TABLE `tb_proposal`
  ADD CONSTRAINT `tb_proposal_ibfk_1` FOREIGN KEY (`dosbim_1`) REFERENCES `tb_dosen` (`id`),
  ADD CONSTRAINT `tb_proposal_ibfk_2` FOREIGN KEY (`dosbim_2`) REFERENCES `tb_dosen` (`id`),
  ADD CONSTRAINT `tb_proposal_ibfk_3` FOREIGN KEY (`id_jenis_ujian`) REFERENCES `tb_jenis_ujian` (`id`),
  ADD CONSTRAINT `tb_proposal_ibfk_4` FOREIGN KEY (`keahlian_id`) REFERENCES `tb_keahlian` (`id`);

--
-- Constraints for table `tb_sidang`
--
ALTER TABLE `tb_sidang`
  ADD CONSTRAINT `tb_sidang_ibfk_1` FOREIGN KEY (`keahlian_id`) REFERENCES `tb_keahlian` (`id`),
  ADD CONSTRAINT `tb_sidang_ibfk_2` FOREIGN KEY (`id_jenis_ujian`) REFERENCES `tb_jenis_ujian` (`id`),
  ADD CONSTRAINT `tb_sidang_ibfk_3` FOREIGN KEY (`dosbim_1`) REFERENCES `tb_dosen` (`id`),
  ADD CONSTRAINT `tb_sidang_ibfk_4` FOREIGN KEY (`dosbim_2`) REFERENCES `tb_dosen` (`id`),
  ADD CONSTRAINT `tb_sidang_ibfk_5` FOREIGN KEY (`dospeng_1`) REFERENCES `tb_dosen` (`id`),
  ADD CONSTRAINT `tb_sidang_ibfk_6` FOREIGN KEY (`dospeng_2`) REFERENCES `tb_dosen` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
