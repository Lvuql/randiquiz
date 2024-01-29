/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.28-MariaDB : Database - quiz
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`quiz` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `quiz`;

/*Table structure for table `tbl_pelanggan` */

DROP TABLE IF EXISTS `tbl_pelanggan`;

CREATE TABLE `tbl_pelanggan` (
  `id` char(10) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nohp` varchar(20) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_pelanggan` */

insert  into `tbl_pelanggan`(`id`,`nama`,`nohp`,`alamat`) values 
('P001','Randi Fadillah','08234234332','Jl Teratai Indah'),
('P002','Musri Wandra','08345345','Jl Padang Sawah'),
('P003','Ilham Jaya Kusuma','082342347997','Jl Banuaran');

/*Table structure for table `tbl_tarif` */

DROP TABLE IF EXISTS `tbl_tarif`;

CREATE TABLE `tbl_tarif` (
  `idtarif` char(10) NOT NULL,
  `klass` varchar(50) DEFAULT NULL,
  `tarif` double DEFAULT NULL,
  PRIMARY KEY (`idtarif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_tarif` */

insert  into `tbl_tarif`(`idtarif`,`klass`,`tarif`) values 
('T001','Ekonomi',2000),
('T002','Standar',3000);

/*Table structure for table `tbl_transaksi` */

DROP TABLE IF EXISTS `tbl_transaksi`;

CREATE TABLE `tbl_transaksi` (
  `idt` int(11) NOT NULL AUTO_INCREMENT,
  `idpel` char(10) DEFAULT NULL,
  `idharga` char(10) DEFAULT NULL,
  `meterblnini` double DEFAULT NULL,
  `meterblnlalu` double DEFAULT NULL,
  `tglbayar` date DEFAULT NULL,
  PRIMARY KEY (`idt`),
  KEY `idpel` (`idpel`),
  KEY `idharga` (`idharga`),
  CONSTRAINT `tbl_transaksi_ibfk_1` FOREIGN KEY (`idpel`) REFERENCES `tbl_pelanggan` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_transaksi_ibfk_2` FOREIGN KEY (`idharga`) REFERENCES `tbl_tarif` (`idtarif`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_transaksi` */

insert  into `tbl_transaksi`(`idt`,`idpel`,`idharga`,`meterblnini`,`meterblnlalu`,`tglbayar`) values 
(2,'P001','T001',200,100,'2024-01-24'),
(3,'P002','T002',300,150,'2024-01-24'),
(4,'P003','T001',400,100,'2024-01-24'),
(5,'P003','T002',200,170,'2024-01-25'),
(6,'P001','T001',200,150,'2024-01-26');

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id_user` char(11) NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id_user`,`nama_user`,`email`,`password`,`level`) values 
('001','wandra','wandra@gmail.com ','827ccb0eea8a706c4c34a16891f84e7b',2),
('003','putra','putra@gmail.com','$2y$10$D/zHRLaTicAN1o./rq.xO.R0o2aNsctqVi62nMN7Q/d6Si58c4ova',1),
('004','randi','randi@gmail.com','$2y$10$s0qeaRYl2pDF/kiTVUwk8.8cqJpRJXIZgUKiVDNYMyPlagHw4Cdl.',1),
('005','corny','corny@gmail.com','$2y$10$VzjQtRhvspJyo2cXFsioee8NsdvA7fC.YYcEB7NAtXrFrWrWmNsGi',3),
('006','admin','admin@gmail.com','$2y$10$IBlHYveYX4dqdrs18DBIvu.YgcJsFhHxSNMTQQ19f3FJ6oUES0oxa',1),
('007','donatur','donatur@gmail.com','$2y$10$N9FkWYfvPXDxJZn6VyCo7OUIvjs1f.LH54TwGvPDaG0yk2pkdGCx2',2),
('008','bendahara','bendahara@gmail.com','$2y$10$OMVjvsqq7IWvwvvCxZkAwOY7hxU4MI2Kn4b.AqWFjyd8BqNf7VU5q',3);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
