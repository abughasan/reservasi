-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.34 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for aitimedi_villa
CREATE DATABASE IF NOT EXISTS `aitimedi_villa` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `aitimedi_villa`;


-- Dumping structure for table aitimedi_villa.buku
CREATE TABLE IF NOT EXISTS `buku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table aitimedi_villa.buku: 5 rows
/*!40000 ALTER TABLE `buku` DISABLE KEYS */;
INSERT INTO `buku` (`id`, `nama`) VALUES
	(1, 'Kas Kasir'),
	(2, 'Kas Bank'),
	(3, 'Petty Cash'),
	(4, 'Piutang'),
	(5, 'Hutang');
/*!40000 ALTER TABLE `buku` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.captcha
CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- Dumping data for table aitimedi_villa.captcha: 2 rows
/*!40000 ALTER TABLE `captcha` DISABLE KEYS */;
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
	(57, 1411948702, '0.0.0.0', '797508'),
	(56, 1411948640, '0.0.0.0', '642976');
/*!40000 ALTER TABLE `captcha` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.ci_sessions
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.ci_sessions: ~1 rows (approximately)
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
	('fc72109484936eb51d1dc649c8837920', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0', 1413724926, 'a:6:{s:9:"user_data";s:0:"";s:8:"username";s:4:"adin";s:8:"password";s:32:"c1e8a000473957b8c5d51542c4c75e0c";s:13:"nama_pengguna";s:4:"adin";s:4:"stts";s:5:"admin";s:9:"dateorder";a:2:{i:0;s:10:"2014-10-25";i:1;s:10:"2014-10-30";}}');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.jenis_transaksi
CREATE TABLE IF NOT EXISTS `jenis_transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buku_debet` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `buku_kredit` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `nama` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `jenis` int(1) DEFAULT NULL,
  `auto` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.jenis_transaksi: 14 rows
/*!40000 ALTER TABLE `jenis_transaksi` DISABLE KEYS */;
INSERT INTO `jenis_transaksi` (`id`, `buku_debet`, `buku_kredit`, `nama`, `jenis`, `auto`) VALUES
	(26, '+5+', '', '(auto) Guide belum dibayar', 0, 1),
	(3, '+1+', '', '(auto) Pembayaran Villa Tunai', 1, 1),
	(27, '', '+3+5+', '(auto) Pembayaran utang Guide', 2, 1),
	(28, '+4+', '', '(auto) Villa belum dibayar', 0, 1),
	(29, '+1+', '+4+', '(auto) Pembayaran cicilan Villa oleh customer', 1, 1),
	(19, '+2+', '+1+', 'Setoran Kasir ke Bank', 0, 0),
	(20, '+3+', '+2+', 'Penarikan dari Bank ke Petty Cash', 0, 0),
	(25, '+3+', '+4+', 'Pembayaran pinjaman karyawan', 1, 0),
	(21, '', '+2+', 'Penarikan oleh Owner', 2, 0),
	(22, '', '+3+', 'Pembelanjaan Barang', 2, 0),
	(24, '+4+', '+3+', 'Pemberian pinjaman karyawan', 2, 0),
	(1, '+3+', '', 'Modal Awal', 0, 0),
	(31, '+1+', '', '(auto) Pembayaran DP Villa Cicil', 1, 1),
	(32, '', '+2+', 'Bayar Gaji Karyawan', 2, 0);
/*!40000 ALTER TABLE `jenis_transaksi` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.tbl_barang
CREATE TABLE IF NOT EXISTS `tbl_barang` (
  `kode_barang` varchar(5) NOT NULL,
  `kode_villa` varchar(10) NOT NULL,
  `id_kamar` int(2) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah_barang` int(4) NOT NULL,
  `harga_satuan` int(20) NOT NULL,
  `kondisi` int(2) NOT NULL,
  PRIMARY KEY (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.tbl_barang: ~4 rows (approximately)
/*!40000 ALTER TABLE `tbl_barang` DISABLE KEYS */;
INSERT INTO `tbl_barang` (`kode_barang`, `kode_villa`, `id_kamar`, `nama_barang`, `jumlah_barang`, `harga_satuan`, `kondisi`) VALUES
	('21', 'VIL001', 1, 'Kacang', 2, 12, 0),
	('B001', 'VIL001', 3, 'sabun', 2, 2000, 0),
	('kl001', 'VIL001', 2, 'Lukisan', 5, 12300, 0),
	('t0091', 'VIL001', 2, 'gelas', 3, 5000, 0);
/*!40000 ALTER TABLE `tbl_barang` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.tbl_denda
CREATE TABLE IF NOT EXISTS `tbl_denda` (
  `id_denda` int(2) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(10) NOT NULL,
  `kode_barang` int(4) NOT NULL,
  `jumlah` int(2) NOT NULL,
  `denda` varchar(10) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`id_denda`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.tbl_denda: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_denda` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_denda` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.tbl_guide
CREATE TABLE IF NOT EXISTS `tbl_guide` (
  `kode_guide` varchar(10) NOT NULL,
  `no_ktp` varchar(30) NOT NULL,
  `nama_guide` varchar(30) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `sisa_pembayaran` int(20) NOT NULL,
  `stts_guide` int(1) NOT NULL,
  PRIMARY KEY (`kode_guide`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.tbl_guide: ~6 rows (approximately)
/*!40000 ALTER TABLE `tbl_guide` DISABLE KEYS */;
INSERT INTO `tbl_guide` (`kode_guide`, `no_ktp`, `nama_guide`, `alamat`, `no_telp`, `sisa_pembayaran`, `stts_guide`) VALUES
	('GU001', '123', 'adin', 'tangerang', '021', 0, 1),
	('GU002', '123', 'Alim', 'Jakarta', '021888888888', 0, 0),
	('GU003', '3333333', 'Badrin', 'kakskfsldfksjflk', '03939393', 0, 0),
	('GU004', '222222', 'banyak%20', 'dlkfjdflkj', '22222222', 0, 0),
	('GU005', '00007', 'ibrahim', 'bogor', '0251', 0, 0),
	('GU006', '12121212121', 'Susi', 'Jln.%20Bangka%20V', '28%20RT%2012', 0, 0);
/*!40000 ALTER TABLE `tbl_guide` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.tbl_hadir
CREATE TABLE IF NOT EXISTS `tbl_hadir` (
  `id_hadir` int(4) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(10) NOT NULL,
  `tgl_datang` date NOT NULL,
  `tgl_pulang` date NOT NULL,
  PRIMARY KEY (`id_hadir`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.tbl_hadir: ~29 rows (approximately)
/*!40000 ALTER TABLE `tbl_hadir` DISABLE KEYS */;
INSERT INTO `tbl_hadir` (`id_hadir`, `no_transaksi`, `tgl_datang`, `tgl_pulang`) VALUES
	(1, 'TR00000007', '2014-07-11', '0000-00-00'),
	(2, 'TR00000005', '2014-07-11', '0000-00-00'),
	(3, 'TR00000006', '2014-07-11', '0000-00-00'),
	(4, 'TR00000001', '2014-07-11', '2014-08-01'),
	(5, 'TR00000001', '2014-07-11', '2014-08-01'),
	(6, 'TR00000002', '2014-07-11', '2014-07-12'),
	(7, 'TR00000002', '2014-07-11', '2014-07-12'),
	(8, 'TR00000003', '2014-07-11', '2014-08-10'),
	(9, 'TR00000003', '2014-07-11', '2014-08-10'),
	(10, 'TR00000005', '2014-07-11', '0000-00-00'),
	(11, 'TR00000005', '2014-07-11', '0000-00-00'),
	(12, 'TR00000001', '2014-07-11', '2014-08-01'),
	(13, 'TR00000002', '2014-07-11', '2014-07-12'),
	(14, 'TR00000005', '2014-07-12', '0000-00-00'),
	(15, 'TR00000006', '2014-07-12', '0000-00-00'),
	(16, 'TR00000002', '2014-07-12', '2014-07-12'),
	(17, 'TR00000008', '2014-07-12', '2014-07-12'),
	(18, 'TR00000006', '2014-07-12', '0000-00-00'),
	(19, 'TR00000008', '2014-07-12', '2014-07-12'),
	(20, 'TR00000005', '2014-07-12', '0000-00-00'),
	(21, 'TR00000001', '2014-07-12', '2014-08-01'),
	(22, 'TR00000002', '2014-07-12', '0000-00-00'),
	(23, 'TR00000001', '2014-08-01', '2014-08-01'),
	(24, 'TR00000004', '2014-08-04', '2014-08-10'),
	(25, 'TR00000002', '2014-08-04', '0000-00-00'),
	(26, 'TR00000001', '2014-08-09', '0000-00-00'),
	(27, 'TR00000003', '2014-08-10', '2014-08-10'),
	(28, 'TR00000004', '2014-08-10', '2014-08-10'),
	(29, 'TR00000002', '2014-08-22', '0000-00-00');
/*!40000 ALTER TABLE `tbl_hadir` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.tbl_kalender
CREATE TABLE IF NOT EXISTS `tbl_kalender` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `bulan` varchar(100) NOT NULL,
  `jml_hari` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.tbl_kalender: ~12 rows (approximately)
/*!40000 ALTER TABLE `tbl_kalender` DISABLE KEYS */;
INSERT INTO `tbl_kalender` (`id`, `bulan`, `jml_hari`) VALUES
	(1, 'Januari', 31),
	(2, 'Februari', 29),
	(3, 'Maret', 31),
	(4, 'April', 30),
	(5, 'Mei', 31),
	(6, 'Juni', 30),
	(7, 'Juli', 31),
	(8, 'Agustus', 31),
	(9, 'September', 30),
	(10, 'Oktober', 31),
	(11, 'Nopember', 30),
	(12, 'Desember', 31);
/*!40000 ALTER TABLE `tbl_kalender` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.tbl_kamar
CREATE TABLE IF NOT EXISTS `tbl_kamar` (
  `id_kamar` int(2) NOT NULL AUTO_INCREMENT,
  `nama_kamar` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kamar`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.tbl_kamar: ~6 rows (approximately)
/*!40000 ALTER TABLE `tbl_kamar` DISABLE KEYS */;
INSERT INTO `tbl_kamar` (`id_kamar`, `nama_kamar`) VALUES
	(1, 'Ruang Keluarga'),
	(2, 'Ruang Tamu'),
	(3, 'Kamar Mandi'),
	(4, 'Gudang'),
	(5, 'Dapur Umum'),
	(6, 'Kamar Mandi Umum');
/*!40000 ALTER TABLE `tbl_kamar` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.tbl_kartu
CREATE TABLE IF NOT EXISTS `tbl_kartu` (
  `id_kartu` int(2) NOT NULL AUTO_INCREMENT,
  `kartu` varchar(20) NOT NULL,
  PRIMARY KEY (`id_kartu`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.tbl_kartu: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_kartu` DISABLE KEYS */;
INSERT INTO `tbl_kartu` (`id_kartu`, `kartu`) VALUES
	(1, 'KTP'),
	(2, 'PASSPORT');
/*!40000 ALTER TABLE `tbl_kartu` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.tbl_kategori
CREATE TABLE IF NOT EXISTS `tbl_kategori` (
  `id_kategori` int(2) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(30) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.tbl_kategori: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_kategori` DISABLE KEYS */;
INSERT INTO `tbl_kategori` (`id_kategori`, `kategori`) VALUES
	(1, 'Peralatan Kamar Mandi'),
	(2, 'Peralatan Kamar Tidur');
/*!40000 ALTER TABLE `tbl_kategori` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.tbl_login
CREATE TABLE IF NOT EXISTS `tbl_login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(75) NOT NULL,
  `nama_pengguna` varchar(100) NOT NULL,
  `stts` varchar(10) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.tbl_login: ~5 rows (approximately)
/*!40000 ALTER TABLE `tbl_login` DISABLE KEYS */;
INSERT INTO `tbl_login` (`username`, `password`, `nama_pengguna`, `stts`) VALUES
	('adin', 'c1e8a000473957b8c5d51542c4c75e0c', 'adin', 'admin'),
	('ali', '86318e52f5ed4801abe1d13d509443de', 'ali', 'admin'),
	('alim', '3ea6277babd0570c650fca3d17ec4bc5', 'alim', 'operator'),
	('ibra', '0b5ffc09eb62ef2241f07327276ee064', 'ibra', 'admin'),
	('udin', '6bec9c852847242e384a4d5ac0962ba0', 'udin', 'operator');
/*!40000 ALTER TABLE `tbl_login` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.tbl_pembayaran
CREATE TABLE IF NOT EXISTS `tbl_pembayaran` (
  `id_bayar` int(4) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(20) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jml_bayar` varchar(20) NOT NULL,
  `status_bayar` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_bayar`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.tbl_pembayaran: ~15 rows (approximately)
/*!40000 ALTER TABLE `tbl_pembayaran` DISABLE KEYS */;
INSERT INTO `tbl_pembayaran` (`id_bayar`, `no_transaksi`, `tgl_bayar`, `jml_bayar`, `status_bayar`) VALUES
	(1, 'TR00000001', '2014-08-22', '300000', ''),
	(2, 'TR00000002', '2014-08-22', '4', ''),
	(3, 'TR00000003', '2014-08-23', '2000000', ''),
	(4, 'TR00000004', '2014-08-23', '12000000', ''),
	(5, 'TR00000001', '2014-08-23', '100000', ''),
	(6, 'TR00000005', '2014-08-23', '2', NULL),
	(7, 'TR00000003', '2014-08-23', '1000000', ''),
	(8, 'TR00000006', '2014-08-23', '1000000', NULL),
	(9, 'TR00000001', '2014-08-23', '10000', ''),
	(10, 'TR00000007', '2014-08-23', '200000', NULL),
	(11, 'TR00000008', '2014-09-06', '1000000', NULL),
	(12, 'TR00000009', '2014-10-10', '10000', NULL),
	(13, 'TR00000010', '2014-10-13', '999', NULL),
	(14, 'TR00000011', '2014-10-17', '1', NULL),
	(15, 'TR00000012', '2014-10-19', '122', NULL);
/*!40000 ALTER TABLE `tbl_pembayaran` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.tbl_pembayaran_guide
CREATE TABLE IF NOT EXISTS `tbl_pembayaran_guide` (
  `id_pem` int(10) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(50) NOT NULL,
  `keterangan` char(1) NOT NULL DEFAULT '0',
  `pembayaran` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pem`),
  KEY `FK__tbl_transaksi` (`no_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.tbl_pembayaran_guide: ~12 rows (approximately)
/*!40000 ALTER TABLE `tbl_pembayaran_guide` DISABLE KEYS */;
INSERT INTO `tbl_pembayaran_guide` (`id_pem`, `no_transaksi`, `keterangan`, `pembayaran`) VALUES
	(1, 'TR00000001', '0', 0),
	(2, 'TR00000002', '0', 0),
	(3, 'TR00000003', '0', 0),
	(4, 'TR00000004', '0', 0),
	(5, 'TR00000005', '0', 0),
	(6, 'TR00000006', '0', 0),
	(7, 'TR00000007', '0', 0),
	(8, 'TR00000008', '0', 0),
	(9, 'TR00000009', '0', 0),
	(10, 'TR00000010', '0', 0),
	(11, 'TR00000011', '0', 0),
	(12, 'TR00000012', '0', 0);
/*!40000 ALTER TABLE `tbl_pembayaran_guide` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.tbl_pengajuan_barang
CREATE TABLE IF NOT EXISTS `tbl_pengajuan_barang` (
  `id_pengajuan` int(4) NOT NULL AUTO_INCREMENT,
  `tgl_pengajuan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `kode_barang` varchar(6) NOT NULL,
  `jml` int(4) NOT NULL,
  `kondisi_b` int(2) NOT NULL,
  `id_sebab` int(2) NOT NULL,
  `id_status_p` int(2) NOT NULL,
  `tgl_ganti` date NOT NULL,
  PRIMARY KEY (`id_pengajuan`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.tbl_pengajuan_barang: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_pengajuan_barang` DISABLE KEYS */;
INSERT INTO `tbl_pengajuan_barang` (`id_pengajuan`, `tgl_pengajuan`, `kode_barang`, `jml`, `kondisi_b`, `id_sebab`, `id_status_p`, `tgl_ganti`) VALUES
	(5, '2014-08-02 11:07:11', '001', 1, 1, 2, 2, '2014-08-02'),
	(16, '2014-08-03 22:33:40', 't0091', 3, 2, 1, 2, '2014-08-03');
/*!40000 ALTER TABLE `tbl_pengajuan_barang` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.tbl_sebab
CREATE TABLE IF NOT EXISTS `tbl_sebab` (
  `id_sebab` int(2) NOT NULL,
  `penyebab` varchar(250) NOT NULL,
  PRIMARY KEY (`id_sebab`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.tbl_sebab: ~5 rows (approximately)
/*!40000 ALTER TABLE `tbl_sebab` DISABLE KEYS */;
INSERT INTO `tbl_sebab` (`id_sebab`, `penyebab`) VALUES
	(1, 'Karena sudah lama/tua / dimakan usia'),
	(2, 'Mati / Sudah tidak berfungsi'),
	(3, 'Tamu/Pengguna yang kurang hati-hati'),
	(4, 'Kesalahan Pegawai'),
	(5, 'Lain-lain');
/*!40000 ALTER TABLE `tbl_sebab` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.tbl_status_p
CREATE TABLE IF NOT EXISTS `tbl_status_p` (
  `id_status_b` int(2) NOT NULL,
  `status_b` varchar(100) NOT NULL,
  PRIMARY KEY (`id_status_b`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.tbl_status_p: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_status_p` DISABLE KEYS */;
INSERT INTO `tbl_status_p` (`id_status_b`, `status_b`) VALUES
	(1, 'Belum di ACC'),
	(2, 'Sudah di ACC');
/*!40000 ALTER TABLE `tbl_status_p` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.tbl_status_v
CREATE TABLE IF NOT EXISTS `tbl_status_v` (
  `id_status` int(2) NOT NULL AUTO_INCREMENT,
  `status_villa` varchar(20) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.tbl_status_v: ~4 rows (approximately)
/*!40000 ALTER TABLE `tbl_status_v` DISABLE KEYS */;
INSERT INTO `tbl_status_v` (`id_status`, `status_villa`) VALUES
	(1, 'Free'),
	(2, 'Booking'),
	(3, 'Check In'),
	(4, 'Check Out');
/*!40000 ALTER TABLE `tbl_status_v` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.tbl_tamu
CREATE TABLE IF NOT EXISTS `tbl_tamu` (
  `id_tamu` int(4) NOT NULL AUTO_INCREMENT,
  `jenis_kartu_id` varchar(20) NOT NULL,
  `no_kartu_id` varchar(25) NOT NULL,
  `nama_tamu` varchar(30) NOT NULL,
  `alamat_tamu` varchar(300) NOT NULL,
  `tlp` varchar(15) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id_tamu`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.tbl_tamu: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_tamu` DISABLE KEYS */;
INSERT INTO `tbl_tamu` (`id_tamu`, `jenis_kartu_id`, `no_kartu_id`, `nama_tamu`, `alamat_tamu`, `tlp`, `status`) VALUES
	(1, 'KTP', '02922929228', 'Ahmad Alimuddin', 'Jln. Bangka V/28 RT 12/03 Pela Mampang Jakarta Selatan', '08388105401', '0');
/*!40000 ALTER TABLE `tbl_tamu` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.tbl_transaksi
CREATE TABLE IF NOT EXISTS `tbl_transaksi` (
  `no_transaksi` varchar(10) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `id_tamu` int(4) NOT NULL,
  `kode_villa` varchar(10) NOT NULL,
  `tgl_cekin` date NOT NULL,
  `tgl_cekout` date NOT NULL,
  `lama_hari` int(2) NOT NULL,
  `dapat_harga` int(20) NOT NULL,
  `bayar` int(20) NOT NULL,
  `sisa_bayar` int(20) NOT NULL,
  `kode_guide` varchar(10) DEFAULT NULL,
  `komisi_guide` double DEFAULT NULL,
  `id_status_v` int(2) DEFAULT NULL,
  `id_hadir` int(2) DEFAULT NULL,
  `dapat_diskon` double DEFAULT '0',
  `dapat_denda` double DEFAULT '0',
  PRIMARY KEY (`no_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.tbl_transaksi: ~12 rows (approximately)
/*!40000 ALTER TABLE `tbl_transaksi` DISABLE KEYS */;
INSERT INTO `tbl_transaksi` (`no_transaksi`, `tgl_transaksi`, `id_tamu`, `kode_villa`, `tgl_cekin`, `tgl_cekout`, `lama_hari`, `dapat_harga`, `bayar`, `sisa_bayar`, `kode_guide`, `komisi_guide`, `id_status_v`, `id_hadir`, `dapat_diskon`, `dapat_denda`) VALUES
	('TR00000001', '2014-08-22', 17, 'VIL001', '2014-08-29', '2014-08-31', 2, 3150000, 0, 0, 'GU001', 0.08, 1, NULL, 0.25, 0),
	('TR00000002', '2014-08-22', 19, 'VIL002', '2014-08-22', '2014-08-25', 3, 6900000, 0, 0, 'GU003', 0.06, 3, NULL, 0, 0),
	('TR00000003', '2014-08-23', 23, 'VIL001', '2014-09-01', '2014-09-04', 3, 4725000, 0, 0, 'GU003', 0.1, 2, NULL, 0.25, 0),
	('TR00000004', '2014-08-23', 8, 'VIL002', '2014-08-27', '2014-09-02', 6, 13800000, 0, 0, 'GU001', 0.1, 2, NULL, 0, 0),
	('TR00000005', '2014-08-23', 15, 'VIL001', '2014-08-23', '2014-08-25', 2, 3150000, 0, 0, 'GU004', 0.07, 2, NULL, 0.25, 0),
	('TR00000006', '2014-08-23', 7, 'VIL003', '2014-08-25', '2014-08-28', 3, 5400000, 0, 0, 'GU005', 0.1, 1, NULL, 0, 0),
	('TR00000007', '2014-08-23', 9, 'VIL001', '2014-08-27', '2014-08-29', 2, 3150000, 0, 0, 'GU002', 0.1, 1, NULL, 0.25, 0),
	('TR00000008', '2014-09-06', 7, 'VIL001', '2014-09-26', '2014-09-30', 4, 6300000, 0, 0, 'GU006', 0.1, 2, NULL, 0.25, 0),
	('TR00000009', '2014-10-10', 1, 'VIL001', '2014-10-17', '2014-10-19', 2, 3150000, 0, 0, 'GU002', 0.06, 2, NULL, 0.25, 0),
	('TR00000010', '2014-10-13', 1, 'VIL001', '2014-10-19', '2014-10-20', 1, 1575000, 0, 0, 'GU001', 0.06, 2, NULL, 0.25, 0),
	('TR00000011', '2014-10-17', 1, 'VIL001', '2014-10-20', '2014-11-01', 12, 18900000, 0, 0, 'GU001', 0.07, 2, NULL, 0.25, 0),
	('TR00000012', '2014-10-19', 1, 'VIL002', '2014-10-25', '2014-10-30', 5, 11500000, 0, 0, 'GU002', 0.07, 2, NULL, 0, 0);
/*!40000 ALTER TABLE `tbl_transaksi` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.tbl_villa
CREATE TABLE IF NOT EXISTS `tbl_villa` (
  `kode_villa` varchar(10) NOT NULL,
  `nama_villa` varchar(30) NOT NULL,
  `tarif_villa` int(25) NOT NULL,
  `url` varchar(255) NOT NULL,
  `diskon` double DEFAULT NULL,
  PRIMARY KEY (`kode_villa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.tbl_villa: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbl_villa` DISABLE KEYS */;
INSERT INTO `tbl_villa` (`kode_villa`, `nama_villa`, `tarif_villa`, `url`, `diskon`) VALUES
	('VIL001', 'PANCA 1', 2100000, 'SATU_1.jpg', 0.25),
	('VIL002', 'PANCA 2', 2300000, 'villa21.jpg', NULL),
	('VIL003', 'PANCA 3', 1800000, 'villa31.jpg', NULL);
/*!40000 ALTER TABLE `tbl_villa` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buku` int(11) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `nomor` int(11) DEFAULT NULL,
  `transaksi` int(11) DEFAULT NULL,
  `debet` bigint(20) DEFAULT '0',
  `kredit` bigint(20) DEFAULT '0',
  `keterangan` text,
  `tanggal_transaksi` date DEFAULT NULL,
  `tanggal_catat` varchar(100) DEFAULT NULL,
  `id_piutang` int(11) DEFAULT NULL,
  `bridge_transaksi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- Dumping data for table aitimedi_villa.transaksi: 35 rows
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` (`id`, `buku`, `user`, `nomor`, `transaksi`, `debet`, `kredit`, `keterangan`, `tanggal_transaksi`, `tanggal_catat`, `id_piutang`, `bridge_transaksi`) VALUES
	(4, 1, 1, 4, 31, 4, 0, '#TR00000002 Uang Muka PANCA 2 (3 malam) oleh Adnan Nasution', '2014-08-22', '', NULL, 'TR00000002'),
	(5, 4, 1, 5, 28, 6899996, 0, '#TR00000002 Piutang sewa PANCA 2 (3 malam) oleh Adnan Nasution', '2014-08-22', '', NULL, 'TR00000002'),
	(6, 5, 1, 6, 26, 414000, 0, '#TR00000002 Hutang Guide utk reservasi PANCA 2 (3 malam) oleh Adnan Nasution', '2014-08-22', '', NULL, 'TR00000002'),
	(7, 1, 1, 7, 31, 2000000, 0, '#TR00000003 Uang Muka PANCA 1 (3 malam) oleh Asep', '2014-08-23', '', NULL, 'TR00000003'),
	(8, 4, 1, 8, 28, 2725000, 0, '#TR00000003 Piutang sewa PANCA 1 (3 malam) oleh Asep', '2014-08-23', '', NULL, 'TR00000003'),
	(9, 5, 1, 9, 26, 472500, 0, '#TR00000003 Hutang Guide utk reservasi PANCA 1 (3 malam) oleh Asep', '2014-08-23', '', NULL, 'TR00000003'),
	(10, 1, 1, 10, 31, 12000000, 0, '#TR00000004 Uang Muka PANCA 2 (6 malam) oleh adinPai', '2014-08-23', '', NULL, 'TR00000004'),
	(11, 4, 1, 11, 28, 1800000, 0, '#TR00000004 Piutang sewa PANCA 2 (6 malam) oleh adinPai', '2014-08-23', '', NULL, 'TR00000004'),
	(12, 5, 1, 12, 26, 1380000, 0, '#TR00000004 Hutang Guide utk reservasi PANCA 2 (6 malam) oleh adinPai', '2014-08-23', '', NULL, 'TR00000004'),
	(36, 5, 1, 35, 26, 189000, 0, '#TR00000009 Hutang Guide utk reservasi PANCA 1 (2 malam) oleh Ahmad Alimuddin', '2014-10-10', '', NULL, 'TR00000009'),
	(15, 1, 1, 15, 31, 2, 0, '#TR00000005 Uang Muka PANCA 1 (2 malam) oleh ALam', '2014-08-23', '', NULL, 'TR00000005'),
	(16, 4, 1, 16, 28, 3149998, 0, '#TR00000005 Piutang sewa PANCA 1 (2 malam) oleh ALam', '2014-08-23', '', NULL, 'TR00000005'),
	(17, 5, 1, 17, 26, 220500, 0, '#TR00000005 Hutang Guide utk reservasi PANCA 1 (2 malam) oleh ALam', '2014-08-23', '', NULL, 'TR00000005'),
	(18, 1, 1, 18, 31, 1000000, 0, '#TR00000003 Bayar cicilan utk reservasi PANCA 1 (3 malam) oleh Asep', '2014-08-23', '', NULL, 'TR00000003'),
	(19, 4, 1, 19, 29, 0, 1000000, '#TR00000003 Pelunasan piutang utk reservasi PANCA 1 (3 malam) oleh Asep', '2014-08-23', '', NULL, 'TR00000003'),
	(35, 4, 1, 34, 28, 3140000, 0, '#TR00000009 Piutang sewa PANCA 1 (2 malam) oleh Ahmad Alimuddin', '2014-10-10', '', NULL, 'TR00000009'),
	(34, 1, 1, 33, 31, 10000, 0, '#TR00000009 Uang Muka PANCA 1 (2 malam) oleh Ahmad Alimuddin', '2014-10-10', '', NULL, 'TR00000009'),
	(25, 3, 1, 25, 22, 0, 200000, 'Pembelian Beras', '2014-08-23', '1408799179', NULL, NULL),
	(26, 2, 1, 26, 19, 20000000, 0, 'Setaran pertama oleh Ibrahim', '2014-08-23', '1408799347', NULL, NULL),
	(27, 1, 1, 26, 19, 0, 20000000, 'Setaran pertama oleh Ibrahim', '2014-08-23', '1408799347', NULL, NULL),
	(28, 1, 1, 27, 31, 200000, 0, '#TR00000007 Uang Muka PANCA 1 (2 malam) oleh LIe', '2014-08-23', '', NULL, 'TR00000007'),
	(29, 4, 1, 28, 28, 2950000, 0, '#TR00000007 Piutang sewa PANCA 1 (2 malam) oleh LIe', '2014-08-23', '', NULL, 'TR00000007'),
	(30, 5, 1, 29, 26, 315000, 0, '#TR00000007 Hutang Guide utk reservasi PANCA 1 (2 malam) oleh LIe', '2014-08-23', '', NULL, 'TR00000007'),
	(31, 1, 1, 30, 31, 1000000, 0, '#TR00000008 Uang Muka PANCA 1 (4 malam) oleh Alimudiin', '2014-09-06', '', NULL, 'TR00000008'),
	(32, 4, 1, 31, 28, 5300000, 0, '#TR00000008 Piutang sewa PANCA 1 (4 malam) oleh Alimudiin', '2014-09-06', '', NULL, 'TR00000008'),
	(33, 5, 1, 32, 26, 630000, 0, '#TR00000008 Hutang Guide utk reservasi PANCA 1 (4 malam) oleh Alimudiin', '2014-09-06', '', NULL, 'TR00000008'),
	(37, 1, 1, 36, 31, 999, 0, '#TR00000010 Uang Muka PANCA 1 (1 malam) oleh Ahmad Alimuddin', '2014-10-13', '', NULL, 'TR00000010'),
	(38, 4, 1, 37, 28, 1574001, 0, '#TR00000010 Piutang sewa PANCA 1 (1 malam) oleh Ahmad Alimuddin', '2014-10-13', '', NULL, 'TR00000010'),
	(39, 5, 1, 38, 26, 94500, 0, '#TR00000010 Hutang Guide utk reservasi PANCA 1 (1 malam) oleh Ahmad Alimuddin', '2014-10-13', '', NULL, 'TR00000010'),
	(40, 1, 1, 39, 31, 1, 0, '#TR00000011 Uang Muka PANCA 1 (12 malam) oleh Ahmad Alimuddin', '2014-10-17', '', NULL, 'TR00000011'),
	(41, 4, 1, 40, 28, 18899999, 0, '#TR00000011 Piutang sewa PANCA 1 (12 malam) oleh Ahmad Alimuddin', '2014-10-17', '', NULL, 'TR00000011'),
	(42, 5, 1, 41, 26, 1323000, 0, '#TR00000011 Hutang Guide utk reservasi PANCA 1 (12 malam) oleh Ahmad Alimuddin', '2014-10-17', '', NULL, 'TR00000011'),
	(43, 1, 1, 42, 31, 122, 0, '#TR00000012 Uang Muka PANCA 2 (5 malam) oleh Ahmad Alimuddin', '2014-10-19', '', NULL, 'TR00000012'),
	(44, 4, 1, 43, 28, 11499878, 0, '#TR00000012 Piutang sewa PANCA 2 (5 malam) oleh Ahmad Alimuddin', '2014-10-19', '', NULL, 'TR00000012'),
	(45, 5, 1, 44, 26, 805000, 0, '#TR00000012 Hutang Guide utk reservasi PANCA 2 (5 malam) oleh Ahmad Alimuddin', '2014-10-19', '', NULL, 'TR00000012');
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;


-- Dumping structure for table aitimedi_villa.user
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(30) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_logincount` int(11) NOT NULL DEFAULT '0',
  `user_level` enum('operator','admin') DEFAULT 'operator',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table aitimedi_villa.user: 1 rows
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_name`, `user_logincount`, `user_level`) VALUES
	(1, 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'Administrator', 25, 'admin');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
