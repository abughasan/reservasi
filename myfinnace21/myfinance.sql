/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50159
 Source Host           : localhost
 Source Database       : myfinance

 Target Server Type    : MySQL
 Target Server Version : 50159
 File Encoding         : utf-8

 Date: 12/06/2011 17:45:16 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `buku`
-- ----------------------------
DROP TABLE IF EXISTS `buku`;
CREATE TABLE `buku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `buku`
-- ----------------------------
BEGIN;
INSERT INTO `buku` VALUES ('1', 'Kas Tunai'), ('2', 'Kas BNI'), ('3', 'Kas Hutang'), ('4', 'Kas Piutang');
COMMIT;

-- ----------------------------
--  Table structure for `captcha`
-- ----------------------------
DROP TABLE IF EXISTS `captcha`;
CREATE TABLE `captcha` (
  `captcha_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `jenis_transaksi`
-- ----------------------------
DROP TABLE IF EXISTS `jenis_transaksi`;
CREATE TABLE `jenis_transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buku_debet` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `buku_kredit` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `nama` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `jenis` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `jenis_transaksi`
-- ----------------------------
BEGIN;
INSERT INTO `jenis_transaksi` VALUES ('1', '', '+1+', 'Pengeluaran Tunai', '2'), ('2', '+1+', '', 'Pemasukan Tunai', '1'), ('3', '+1+', '+2+', 'Penarikan Tunai dari Bank', '0'), ('4', '+2+', '+1+', 'Setoran Tunai ke Bank', '0'), ('5', '+2+', '', 'Setoran Langsung ke Bank', '1'), ('6', '+1+3+', '', 'Peminjaman Uang', '1'), ('7', '', '+1+3+', 'Pengembalian Hutang', '2'), ('8', '+4+', '+1+', 'Pemberian Pinjaman dari Kas Tunai', '0'), ('9', '+1+', '+4+', 'Pengembalian Piutang ke Kas Tunai', '0'), ('10', '+2+', '', 'Saldo Awal BNI', '1'), ('11', '+1+', '', 'Saldo Awal Kas Tunai', '1'), ('12', '+1+3+', '', 'Saldo Awal Kas Hutang', '1'), ('13', '+4+', '', 'Saldo Awal Kas Piutang', '1'), ('14', '+4+', '+2+', 'Pemberian Pinjaman dari Bank', '0'), ('15', '', '+2+', 'Transfer dari Bank', '2'), ('16', '+2+', '+4+', 'Pengembalian Piutang ke Bank BNI', null);
COMMIT;

-- ----------------------------
--  Table structure for `transaksi`
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(30) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_logincount` int(11) NOT NULL DEFAULT '0',
  `user_level` enum('operator','admin') DEFAULT 'operator',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('1', 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'Administrator', '0', 'admin');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
