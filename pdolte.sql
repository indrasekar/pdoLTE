# Host: localhost  (Version 5.7.19)
# Date: 2017-12-31 16:58:28
# Generator: MySQL-Front 6.0  (Build 2.20)


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
# Structure for table "site_config"
#

CREATE TABLE `site_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` enum('text','image') DEFAULT NULL,
  `value` text,
  `active` enum('1','0') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "site_config"
#

INSERT INTO `site_config` VALUES (1,'site_title','text','Griya Dayun Indah','1'),(2,'logo_mini','text','<b>GDI</b>','1'),(3,'logo_lg','text','Griya Dayun Indah','1');

#
# Structure for table "users"
#

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `sex` enum('m','f') DEFAULT NULL COMMENT 'm=male, f=female',
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `active` enum('1','0') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

#
# Data for table "users"
#

INSERT INTO `users` VALUES (1,'Indra Sekar','Pekanbaru','indra.sekar@gmail.com','085265656446','m','indra.sekar','sekar','1');
