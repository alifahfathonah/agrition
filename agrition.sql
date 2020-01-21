/*
SQLyog Enterprise v12.09 (64 bit)
MySQL - 10.4.8-MariaDB : Database - agrition
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`agrition` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id_admin` int(3) NOT NULL AUTO_INCREMENT,
  `nama_admin` varchar(50) DEFAULT NULL,
  `tmpt_lahir` varchar(25) DEFAULT NULL,
  `tgl_lahir` varchar(12) DEFAULT NULL,
  `jns_kel` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `level` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id_admin`,`nama_admin`,`tmpt_lahir`,`tgl_lahir`,`jns_kel`,`alamat`,`foto`,`username`,`password`,`level`) values (1,'Super Admin','Jogjakarta','10/02/1998','Laki-laki','Jogjakarta','default.png','admin','0192023a7bbd73250516f069df18b500','1');

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(50) DEFAULT NULL,
  `berat_barang` varchar(50) DEFAULT NULL,
  `harga_barang` varchar(50) DEFAULT NULL,
  `gambar` varchar(300) DEFAULT NULL,
  `jmlh_barang` int(3) DEFAULT NULL,
  `status_barang` enum('Tersedia','Habis') DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `id_toko` int(11) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

/*Table structure for table `detail_transaksi` */

DROP TABLE IF EXISTS `detail_transaksi`;

CREATE TABLE `detail_transaksi` (
  `id_transaksi` int(11) DEFAULT NULL,
  `id_detail` int(5) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(4) DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  KEY `id_detail` (`id_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detail_transaksi` */

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nm_kategori` varchar(20) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kategori` */

/*Table structure for table `keranjang` */

DROP TABLE IF EXISTS `keranjang`;

CREATE TABLE `keranjang` (
  `id_keranjang` int(3) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `id_toko` int(11) DEFAULT NULL,
  `id_member` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jmlh_barang` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_keranjang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `keranjang` */

/*Table structure for table `kurir` */

DROP TABLE IF EXISTS `kurir`;

CREATE TABLE `kurir` (
  `id_kurir` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kurir` varchar(50) DEFAULT NULL,
  `durasi_kirim` varchar(11) DEFAULT NULL,
  `biaya_kirim` double DEFAULT NULL,
  PRIMARY KEY (`id_kurir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kurir` */

/*Table structure for table `member` */

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL AUTO_INCREMENT,
  `nama_member` varchar(50) DEFAULT NULL,
  `jns_kel` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `tmpt_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` varchar(13) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` enum('Pembeli','Penjual') DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_member`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `member` */

/*Table structure for table `pembayaran` */

DROP TABLE IF EXISTS `pembayaran`;

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_rekening` int(11) DEFAULT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `kode_unik` int(3) DEFAULT NULL,
  `nominal` double DEFAULT NULL,
  `no_rek_bayar` varchar(30) DEFAULT NULL,
  `nama_rek` varchar(20) DEFAULT NULL,
  `bank` varchar(20) DEFAULT NULL,
  `jmlh_bayar` double DEFAULT NULL,
  `bukti_bayar` varchar(100) DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `status` enum('Diterima','Ditolak','Proses') DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pembayaran` */

/*Table structure for table `rekening` */

DROP TABLE IF EXISTS `rekening`;

CREATE TABLE `rekening` (
  `id_rekening` int(11) NOT NULL AUTO_INCREMENT,
  `nm_bank` varchar(10) DEFAULT NULL,
  `kode_bank` varchar(5) DEFAULT NULL,
  `pemilik` varbinary(30) DEFAULT NULL,
  `no_rek` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_rekening`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `rekening` */

/*Table structure for table `toko` */

DROP TABLE IF EXISTS `toko`;

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `no_telp` varchar(50) DEFAULT NULL,
  `id_member` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `nm_rek` varchar(30) DEFAULT NULL,
  `bank` varchar(20) DEFAULT NULL,
  `no_rek` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_toko`),
  KEY `id_toko` (`id_toko`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `toko` */

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tgl_trans` date DEFAULT NULL,
  `id_toko` int(11) DEFAULT NULL,
  `id_member` int(11) DEFAULT NULL,
  `id_kurir` int(11) DEFAULT NULL,
  `total_bayar` varchar(50) DEFAULT NULL,
  `tgl_exp` datetime DEFAULT NULL,
  `status` enum('Menunggu Pembayaran','Pengemasan','Dikirim','Diterima','Memproses Pembayaran','Selesai','Refund') DEFAULT NULL,
  `no_resi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

/* Trigger structure for table `detail_transaksi` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `update stok` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `update stok` AFTER INSERT ON `detail_transaksi` FOR EACH ROW BEGIN
	update barang set jmlh_barang = jmlh_barang-new.qty
	where id_barang= new.id_barang;
    END */$$


DELIMITER ;

/* Trigger structure for table `detail_transaksi` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `update stok 1` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `update stok 1` AFTER DELETE ON `detail_transaksi` FOR EACH ROW BEGIN
	UPDATE barang SET jmlh_barang = jmlh_barang+old.qty
	WHERE id_barang= old.id_barang;
    END */$$


DELIMITER ;

/* Trigger structure for table `member` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `member hapus` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `member hapus` AFTER DELETE ON `member` FOR EACH ROW BEGIN
    Delete from toko where id_member = old.id_member;
    END */$$


DELIMITER ;

/* Trigger structure for table `toko` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `update status` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `update status` AFTER INSERT ON `toko` FOR EACH ROW BEGIN
	update `member` set `status` = 'Penjual' where id_member = new.id_member;
    END */$$


DELIMITER ;

/* Trigger structure for table `toko` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `toko hapus` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `toko hapus` AFTER DELETE ON `toko` FOR EACH ROW BEGIN
	DELETE FROM barang WHERE id_toko = old.id_toko;
	UPDATE `member` SET `status` = 'Pembeli' WHERE id_member = old.id_member;
    END */$$


DELIMITER ;

/* Trigger structure for table `transaksi` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `refund` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `refund` AFTER UPDATE ON `transaksi` FOR EACH ROW BEGIN
    
	if (new.status = "Refund") then
	UPDATE barang SET jmlh_barang = jmlh_barang+(select qty from detail_transaksi where id_transaksi = old.id_transaksi)
	WHERE id_barang= (SELECT id_barang FROM detail_transaksi WHERE id_transaksi = old.id_transaksi);
	
	end if;
    END */$$


DELIMITER ;

/* Trigger structure for table `transaksi` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `transaksi hapus` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `transaksi hapus` AFTER DELETE ON `transaksi` FOR EACH ROW BEGIN
	delete from detail_transaksi where id_transaksi = old.id_transaksi;
	DELETE FROM pembayaran WHERE id_transaksi = old.id_transaksi;
    END */$$


DELIMITER ;

/*!50106 set global event_scheduler = 1*/;

/* Event structure for event `auto_reject` */

/*!50106 DROP EVENT IF EXISTS `auto_reject`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`root`@`localhost` EVENT `auto_reject` ON SCHEDULE EVERY 60 SECOND STARTS '2020-01-06 10:52:34' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
	    UPDATE request SET is_accept="0" WHERE is_accept IS NULL AND `date` < NOW();
	END */$$
DELIMITER ;

/* Event structure for event `delete transaksi` */

/*!50106 DROP EVENT IF EXISTS `delete transaksi`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`root`@`localhost` EVENT `delete transaksi` ON SCHEDULE EVERY 1 SECOND STARTS '2019-07-22 12:10:38' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
	    delete from transaksi where (`status` is null or `status` = "Menunggu Pembayaran") and tgl_exp < now(); 
	END */$$
DELIMITER ;

/* Event structure for event `terima transaksi` */

/*!50106 DROP EVENT IF EXISTS `terima transaksi`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`root`@`localhost` EVENT `terima transaksi` ON SCHEDULE EVERY 1 SECOND STARTS '2019-07-22 12:18:24' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
	    UPDATE transaksi SET STATUS="Diterima" WHERE STATUS = "Dikirim" AND tgl_exp < now();
	END */$$
DELIMITER ;

/* Event structure for event `update transaksi` */

/*!50106 DROP EVENT IF EXISTS `update transaksi`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`root`@`localhost` EVENT `update transaksi` ON SCHEDULE EVERY 1 SECOND STARTS '2019-07-22 12:16:09' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
	    UPDATE transaksi SET STATUS="Refund" WHERE STATUS = "Pengemasan" AND tgl_exp < now();
	END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
