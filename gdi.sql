# Host: localhost  (Version 5.7.20-0ubuntu0.16.04.1)
# Date: 2017-12-31 08:34:49
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "jabatan"
#

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

#
# Data for table "jabatan"
#

INSERT INTO `jabatan` VALUES (1,'Direktur'),(2,'Administrasi'),(3,'Tukang'),(4,'Helper Tukang'),(5,'Operator Alat Berat'),(6,'Komisaris');

#
# Structure for table "menu"
#

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `possition` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `file` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `i_class` varchar(255) DEFAULT NULL,
  `active` enum('ACTIVE','INACTIVE') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

#
# Data for table "menu"
#

INSERT INTO `menu` VALUES (1,0,1,'Dashboard','dashboard','home','fa fa-dashboard','ACTIVE'),(2,0,2,'Master','#','master','fa fa-files-o','ACTIVE'),(3,0,3,'Transaksi','#','transaction','fa fa-pie-chart','ACTIVE'),(4,0,4,'Administration','#','administration','fa fa-files-o','ACTIVE'),(5,2,1,'Customers','customer','customers','fa fa-circle-o','ACTIVE'),(6,2,1,'Pekerja','pekerja','pekerja','fa fa-user','ACTIVE'),(7,3,1,'Keuangan','keuangan','keuangan',NULL,'ACTIVE'),(8,3,2,'Material','material','material',NULL,'ACTIVE');

#
# Structure for table "pekerja"
#

CREATE TABLE `pekerja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` enum('Islam','Kristen','Hindu','Budha','Lainnya') DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `jk` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "pekerja"
#

INSERT INTO `pekerja` VALUES (1,'Indra','Siantar','1991-03-09','Islam','Direktur','Dayun','Laki-Laki','08222');

#
# Structure for table "profiles"
#

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `sex` enum('m','f') DEFAULT NULL COMMENT 'm=male, f=female',
  `area` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

#
# Data for table "profiles"
#

INSERT INTO `profiles` VALUES (1,'Indra Sekar','Pekanbaru','indra.sekar@gmail.com','085265656446','m','Pekanbaru');

#
# Structure for table "users"
#

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_id` varchar(5) DEFAULT NULL,
  `status` enum('1','0') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

#
# Data for table "users"
#

INSERT INTO `users` VALUES (1,'indra.sekar@gmail.com','sekar','1','1');
