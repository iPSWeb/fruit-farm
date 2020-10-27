-- MySQL dump 10.14  Distrib 5.5.60-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: user1382037_ff
-- ------------------------------------------------------
-- Server version	5.5.60-MariaDB-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `db_autoref`
--

DROP TABLE IF EXISTS `db_autoref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_autoref` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `cost` float(11,2) NOT NULL DEFAULT '0.00',
  `term` int(11) NOT NULL,
  `end` datetime NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_autoref`
--

LOCK TABLES `db_autoref` WRITE;
/*!40000 ALTER TABLE `db_autoref` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_autoref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_autoref_history`
--

DROP TABLE IF EXISTS `db_autoref_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_autoref_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `referal_id` bigint(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_autoref_history`
--

LOCK TABLES `db_autoref_history` WRITE;
/*!40000 ALTER TABLE `db_autoref_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_autoref_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_autoref_temp`
--

DROP TABLE IF EXISTS `db_autoref_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_autoref_temp` (
  `user_id` bigint(20) NOT NULL,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_autoref_temp`
--

LOCK TABLES `db_autoref_temp` WRITE;
/*!40000 ALTER TABLE `db_autoref_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_autoref_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_bonus_list`
--

DROP TABLE IF EXISTS `db_bonus_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_bonus_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `sum` float(11,2) NOT NULL DEFAULT '0.00',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_bonus_list`
--

LOCK TABLES `db_bonus_list` WRITE;
/*!40000 ALTER TABLE `db_bonus_list` DISABLE KEYS */;
INSERT INTO `db_bonus_list` VALUES (8,'MrLogon',12,14.00,1603460202,1603546602);
/*!40000 ALTER TABLE `db_bonus_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_conabrul`
--

DROP TABLE IF EXISTS `db_conabrul`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_conabrul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rules` text NOT NULL,
  `about` text NOT NULL,
  `contacts` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_conabrul`
--

LOCK TABLES `db_conabrul` WRITE;
/*!40000 ALTER TABLE `db_conabrul` DISABLE KEYS */;
INSERT INTO `db_conabrul` VALUES (1,'<p>Правила проекта</p>','<p>О проекте</p>','<p>Контактные данные</p><p>Email: i@psweb.ru</p><p>Telegram: <a href=\"https://t.me/psweb\" title=\"PSWeb\" target=\"_blank\">@psweb</a></p>');
/*!40000 ALTER TABLE `db_conabrul` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_config`
--

DROP TABLE IF EXISTS `db_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` varchar(10) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `min_pay` float(11,2) NOT NULL DEFAULT '15.00',
  `ser_per_wmr` int(11) NOT NULL DEFAULT '1000',
  `ser_per_wmz` int(11) NOT NULL DEFAULT '3300',
  `ser_per_wme` int(11) NOT NULL DEFAULT '4200',
  `ser_per_psc` int(2) NOT NULL DEFAULT '10',
  `percent_swap` int(11) NOT NULL DEFAULT '0',
  `percent_sell` int(2) NOT NULL DEFAULT '10',
  `items_per_coin` int(11) NOT NULL DEFAULT '7',
  `a_in_h` int(11) NOT NULL DEFAULT '0',
  `b_in_h` int(11) NOT NULL DEFAULT '0',
  `c_in_h` int(11) NOT NULL DEFAULT '0',
  `d_in_h` int(11) NOT NULL DEFAULT '0',
  `e_in_h` int(11) NOT NULL DEFAULT '0',
  `amount_a_t` int(11) NOT NULL DEFAULT '0',
  `amount_b_t` int(11) NOT NULL DEFAULT '0',
  `amount_c_t` int(11) NOT NULL DEFAULT '0',
  `amount_d_t` int(11) NOT NULL DEFAULT '0',
  `amount_e_t` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_config`
--

LOCK TABLES `db_config` WRITE;
/*!40000 ALTER TABLE `db_config` DISABLE KEYS */;
INSERT INTO `db_config` VALUES (1,'admin','',100.00,100,3300,4200,10,50,50,10,1001,2001,3001,4001,5001,1001,2001,3001,4001,5001);
/*!40000 ALTER TABLE `db_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_hash`
--

DROP TABLE IF EXISTS `db_hash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_hash` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `hash` varchar(64) NOT NULL,
  `expired` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_hash`
--

LOCK TABLES `db_hash` WRITE;
/*!40000 ALTER TABLE `db_hash` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_hash` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_history_login`
--

DROP TABLE IF EXISTS `db_history_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_history_login` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `ip` int(10) unsigned NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='История авторизаций';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_history_login`
--

LOCK TABLES `db_history_login` WRITE;
/*!40000 ALTER TABLE `db_history_login` DISABLE KEYS */;
INSERT INTO `db_history_login` VALUES (1,1,2994523295,'2020-04-12 15:45:30');
/*!40000 ALTER TABLE `db_history_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_insert_money`
--

DROP TABLE IF EXISTS `db_insert_money`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_insert_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `money` float(11,2) NOT NULL DEFAULT '0.00',
  `serebro` int(11) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_insert_money`
--

LOCK TABLES `db_insert_money` WRITE;
/*!40000 ALTER TABLE `db_insert_money` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_insert_money` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_lottery`
--

DROP TABLE IF EXISTS `db_lottery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_lottery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user` varchar(50) NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_lottery`
--

LOCK TABLES `db_lottery` WRITE;
/*!40000 ALTER TABLE `db_lottery` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_lottery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_lottery_winners`
--

DROP TABLE IF EXISTS `db_lottery_winners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_lottery_winners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_a` varchar(50) NOT NULL,
  `bil_a` int(11) NOT NULL DEFAULT '0',
  `user_b` varchar(50) NOT NULL,
  `bil_b` int(11) NOT NULL DEFAULT '0',
  `user_c` varchar(50) NOT NULL,
  `bil_c` int(11) NOT NULL DEFAULT '0',
  `bank` float NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_lottery_winners`
--

LOCK TABLES `db_lottery_winners` WRITE;
/*!40000 ALTER TABLE `db_lottery_winners` DISABLE KEYS */;
INSERT INTO `db_lottery_winners` VALUES (1,'pligin',1,'pligin',4,'pligin',2,400,1600971184);
/*!40000 ALTER TABLE `db_lottery_winners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_newlottery`
--

DROP TABLE IF EXISTS `db_newlottery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_newlottery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `count_ticket` int(2) NOT NULL DEFAULT '10',
  `cost` float(11,2) NOT NULL DEFAULT '0.00',
  `account` enum('b','p') NOT NULL DEFAULT 'b',
  `prize` bigint(20) NOT NULL DEFAULT '1',
  `count` int(3) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_newlottery`
--

LOCK TABLES `db_newlottery` WRITE;
/*!40000 ALTER TABLE `db_newlottery` DISABLE KEYS */;
INSERT INTO `db_newlottery` VALUES (1,10,10.00,'b',1,1,'2020-09-24 17:04:05','0000-00-00 00:00:00',1);
/*!40000 ALTER TABLE `db_newlottery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_newlottery_prizes`
--

DROP TABLE IF EXISTS `db_newlottery_prizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_newlottery_prizes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` enum('a_t','b_t','c_t','d_t','e_t','money_b','money_p') NOT NULL DEFAULT 'money_b',
  `title` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_newlottery_prizes`
--

LOCK TABLES `db_newlottery_prizes` WRITE;
/*!40000 ALTER TABLE `db_newlottery_prizes` DISABLE KEYS */;
INSERT INTO `db_newlottery_prizes` VALUES (1,'a_t','Лимонное дерево','/assets/style/img/fruit/a_t.jpg'),(2,'b_t','Вишневое дерево','/assets/style/img/fruit/b_t.jpg'),(3,'c_t','Куст клубники','/assets/style/img/fruit/c_t.jpg'),(4,'d_t','Дерево киви','/assets/style/img/fruit/d_t.jpg'),(5,'e_t','Дерево апельсинов','/assets/style/img/fruit/e_t.jpg'),(6,'money_b','Серебра на покупки','/assets/style/img/man-2.jpg'),(7,'money_p','Серебра на вывод','/assets/style/img/man-2.jpg');
/*!40000 ALTER TABLE `db_newlottery_prizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_newlottery_users`
--

DROP TABLE IF EXISTS `db_newlottery_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_newlottery_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lottery_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('winner','loser','waiting') NOT NULL DEFAULT 'waiting',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_newlottery_users`
--

LOCK TABLES `db_newlottery_users` WRITE;
/*!40000 ALTER TABLE `db_newlottery_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_newlottery_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_news`
--

DROP TABLE IF EXISTS `db_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `news` text NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_news`
--

LOCK TABLES `db_news` WRITE;
/*!40000 ALTER TABLE `db_news` DISABLE KEYS */;
INSERT INTO `db_news` VALUES (1,'Тестовая новость','<p style=\"text-align: center;\"><span style=\"color: #ff0000; font-family: &quot;arial black&quot;, &quot;avant garde&quot;; font-size: medium;\"><strong>Это тестовая новость</strong></span></p>',1510832442),(3,'проба','<p>проба</p>',1510900013),(4,'проба1','<p>проба1</p>',1510919121),(6,'тест ','<div style=\"text-align: center;\"><b>тестовая</b></div>',1511086117);
/*!40000 ALTER TABLE `db_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_payeer_insert`
--

DROP TABLE IF EXISTS `db_payeer_insert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_payeer_insert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `sum` float(11,2) NOT NULL DEFAULT '0.00',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `description` varchar(20) NOT NULL,
  `ps` varchar(20) NOT NULL,
  `request_id` varchar(64) NOT NULL,
  `operation_id` varchar(20) NOT NULL,
  `account` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_payeer_insert`
--

LOCK TABLES `db_payeer_insert` WRITE;
/*!40000 ALTER TABLE `db_payeer_insert` DISABLE KEYS */;
INSERT INTO `db_payeer_insert` VALUES (1,1,'Admin',100.00,1579230518,0,'Payeer','','','',''),(2,1,'Admin',100.00,1601062376,0,'Payeer','','','',''),(3,12,'MrLogon',100.00,1603460253,0,'Payeer','','','','');
/*!40000 ALTER TABLE `db_payeer_insert` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_payment`
--

DROP TABLE IF EXISTS `db_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `purse` varchar(20) NOT NULL,
  `sum` float(11,2) NOT NULL DEFAULT '0.00',
  `comission` float(11,2) NOT NULL DEFAULT '0.00',
  `valuta` varchar(3) NOT NULL DEFAULT 'RUB',
  `serebro` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `pay_sys` varchar(100) NOT NULL DEFAULT '0',
  `pay_sys_id` int(11) NOT NULL DEFAULT '0',
  `response` int(1) NOT NULL DEFAULT '0',
  `payment_id` varchar(20) NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_payment`
--

LOCK TABLES `db_payment` WRITE;
/*!40000 ALTER TABLE `db_payment` DISABLE KEYS */;
INSERT INTO `db_payment` VALUES (1,'Admin',1,'P8706145',1.00,0.00,'RUB',100,3,'0',0,0,'806223850',1559933720,0),(2,'Admin',1,'P1013746860',1.00,0.00,'RUB',100,3,'0',0,0,'806226765',1559934092,0),(3,'Admin',1,'410014713264252',2.00,0.00,'RUB',200,3,'0',0,0,'631909705766040301',1578594505,0),(5,'Admin',1,'P8706145',1.00,0.00,'RUB',100,2,'0',0,0,'',1587986482,0),(6,'Admin',1,'P8706145',1.00,0.00,'RUB',100,3,'0',0,0,'',1587986941,0);
/*!40000 ALTER TABLE `db_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_psc`
--

DROP TABLE IF EXISTS `db_psc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_psc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `publickey` varchar(64) NOT NULL,
  `accountRS` varchar(25) NOT NULL,
  `account` int(50) NOT NULL,
  `phrase` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_psc`
--

LOCK TABLES `db_psc` WRITE;
/*!40000 ALTER TABLE `db_psc` DISABLE KEYS */;
INSERT INTO `db_psc` VALUES (1,1,'a44f98b78c4a05ec09fe86b4b70cbb7518d7988d10fe35a44939f45967c75e46','PSC-XHTV-X3EK-FZVC-G43KP',2147483647,'promise cruel pause stuck through threw here candle complain balance very grief');
/*!40000 ALTER TABLE `db_psc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_recovery`
--

DROP TABLE IF EXISTS `db_recovery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_recovery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `ip` int(10) unsigned NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_recovery`
--

LOCK TABLES `db_recovery` WRITE;
/*!40000 ALTER TABLE `db_recovery` DISABLE KEYS */;
INSERT INTO `db_recovery` VALUES (4,'i@psweb.ru',775482177,1601030015,1601030915);
/*!40000 ALTER TABLE `db_recovery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_regkey`
--

DROP TABLE IF EXISTS `db_regkey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_regkey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `referer_id` int(11) NOT NULL DEFAULT '0',
  `referer_name` varchar(50) NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_regkey`
--

LOCK TABLES `db_regkey` WRITE;
/*!40000 ALTER TABLE `db_regkey` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_regkey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_sell_items`
--

DROP TABLE IF EXISTS `db_sell_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_sell_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `a_s` int(11) NOT NULL DEFAULT '0',
  `b_s` int(11) NOT NULL DEFAULT '0',
  `c_s` int(11) NOT NULL DEFAULT '0',
  `d_s` int(11) NOT NULL DEFAULT '0',
  `e_s` int(11) NOT NULL DEFAULT '0',
  `amount` float(11,2) NOT NULL DEFAULT '0.00',
  `all_sell` int(11) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_sell_items`
--

LOCK TABLES `db_sell_items` WRITE;
/*!40000 ALTER TABLE `db_sell_items` DISABLE KEYS */;
INSERT INTO `db_sell_items` VALUES (2,'Admin',1,143409,143338,214971,286604,358237,114655.90,1146559,1511084878,1512380878),(3,'Admin',1,27165279,27151710,40720781,54289851,67858922,21718654.00,217186543,1559933542,1561229542),(4,'Admin',1,10731224,10725864,16086115,21446367,26806619,8579619.00,85796189,1579230466,1580526466),(5,'Admin',1,2319868,2318709,3477484,4636259,5795034,1854735.38,18547354,1583402060,1584698060),(6,'pligin',7,200,0,0,0,0,20.00,200,1600884910,1602180910),(7,'pligin',7,200,0,0,0,0,20.00,200,1600884940,1602180940),(8,'pligin',7,96254,0,0,0,0,9625.40,96254,1600971044,1602267044),(9,'MrLogon',12,2041,0,0,0,0,204.10,2041,1603467512,1604763512);
/*!40000 ALTER TABLE `db_sell_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_sender`
--

DROP TABLE IF EXISTS `db_sender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_sender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mess` text NOT NULL,
  `page` int(5) NOT NULL DEFAULT '0',
  `sended` int(7) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_sender`
--

LOCK TABLES `db_sender` WRITE;
/*!40000 ALTER TABLE `db_sender` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_sender` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_stats`
--

DROP TABLE IF EXISTS `db_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `all_users` int(11) NOT NULL DEFAULT '0',
  `all_payments` float(11,2) NOT NULL DEFAULT '0.00',
  `all_insert` float(11,2) NOT NULL DEFAULT '0.00',
  `donations` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_stats`
--

LOCK TABLES `db_stats` WRITE;
/*!40000 ALTER TABLE `db_stats` DISABLE KEYS */;
INSERT INTO `db_stats` VALUES (1,12,6.00,0.00,0);
/*!40000 ALTER TABLE `db_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_stats_btree`
--

DROP TABLE IF EXISTS `db_stats_btree`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_stats_btree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user` varchar(50) NOT NULL,
  `tree_name` varchar(50) NOT NULL,
  `amount` float(11,2) NOT NULL DEFAULT '0.00',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_stats_btree`
--

LOCK TABLES `db_stats_btree` WRITE;
/*!40000 ALTER TABLE `db_stats_btree` DISABLE KEYS */;
INSERT INTO `db_stats_btree` VALUES (1,1,'Admin','Лайм',1001.00,1510826203,1512122203),(2,1,'Admin','Лайм',1001.00,1510826278,1512122278),(3,1,'Admin','Вишня',2001.00,1510826290,1512122290),(4,1,'Admin','Апельсин',5001.00,1510826294,1512122294),(5,1,'Admin','Киви',4001.00,1510826298,1512122298),(6,1,'Admin','Клубника',3001.00,1510826300,1512122300);
/*!40000 ALTER TABLE `db_stats_btree` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_swap_ser`
--

DROP TABLE IF EXISTS `db_swap_ser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_swap_ser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `amount_b` float(11,2) NOT NULL DEFAULT '0.00',
  `amount_p` float(11,2) NOT NULL DEFAULT '0.00',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_swap_ser`
--

LOCK TABLES `db_swap_ser` WRITE;
/*!40000 ALTER TABLE `db_swap_ser` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_swap_ser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_tg`
--

DROP TABLE IF EXISTS `db_tg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_tg` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `tg_id` bigint(20) NOT NULL,
  `token` varchar(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_tg`
--

LOCK TABLES `db_tg` WRITE;
/*!40000 ALTER TABLE `db_tg` DISABLE KEYS */;
INSERT INTO `db_tg` VALUES (1,1,696245516,'qmgpyrlw-8w54-iuqd-k1kk-f7vlve6nl4mx');
/*!40000 ALTER TABLE `db_tg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_users_a`
--

DROP TABLE IF EXISTS `db_users_a`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_users_a` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(128) NOT NULL,
  `salt` varchar(64) NOT NULL,
  `referer` varchar(50) NOT NULL,
  `referer_id` int(11) NOT NULL DEFAULT '0',
  `referals` int(11) NOT NULL DEFAULT '0',
  `date_reg` int(11) NOT NULL DEFAULT '0',
  `date_login` int(11) NOT NULL DEFAULT '0',
  `ip` int(10) unsigned NOT NULL DEFAULT '0',
  `banned` int(1) NOT NULL DEFAULT '0',
  `refback` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_users_a`
--

LOCK TABLES `db_users_a` WRITE;
/*!40000 ALTER TABLE `db_users_a` DISABLE KEYS */;
INSERT INTO `db_users_a` VALUES (1,'Admin','i@psweb.ru','3fd76819e2198cae8c729b21f1b82d203e1fd99446d5b5c32cef720d2aca2adc8a04b616a1e7f87ee7f361048c6c0a599afb22510471163c79c40036673bb25a','1SGQToTrh1qwpMIDBm9hmrjHm82zl85Lh89uGwNKm6Gg337k66EZLcHmpPfzJLRu','Admin',1,9,1367313062,1602091594,2994523295,0,50),(2,'aleksey','leha.vodanov@mail.ru','aleksey','','Admin',1,0,1440868538,1440868651,1832711990,0,0),(3,'baxedik','bax.edik@yandex.ru','000000','','Admin',1,0,1510901125,1510904750,1509523661,0,0),(4,'lexa2015','bax@yandex.ru','000000','','Admin',1,0,1510901171,0,1509523661,0,0),(7,'pligin','pligin103@gmail.com','ed5ed0ca798cd8ef42df14799b1c1bfcaa47eae9f9a45f249868cd38ee82ec5779d5ee2a1787a06d92dac692b9b183334480c94b6f50324bd7e4d7be075d0619','iglfQG9fn5uFjwkznq9xbppvqsd8PdyVvjJNnPV9SjcZEmA9XlZUVU3XORbyAeUE','Admin',1,0,1510915285,1601028364,775482177,0,0),(8,'lexa','edik@yandex.ru','000000','','Admin',1,0,1510919054,0,1509523661,0,0),(9,'luchinin','maksim@luchinin.net','dZtXrWR49B4rF3G','','Admin',1,0,1543990229,1544222965,3585554581,0,0),(10,'icutuz','cutuzowandrey@gmail.com','swat181199','','Admin',1,0,1591646873,0,771757176,0,0),(11,'qazqaz','qazqaz@ffsnd.ru','41dff820c1ee2006b0aed4ff0dd6d380bb85872b5cb06fbf48efe2a06e61b564483f801c0b2054562f5f88264e5348679fe4891477e23fa3741fa6cafb39c935','jgWOHUp8mbO1tonhLorJb9x6bQlZGyAGUKuzjnzd296L2ykPvBrpHdwwxDvgxSd4','Admin',1,0,1601909675,0,1402279350,0,0),(12,'MrLogon','iskorpionbek@gmail.com','e5c621032956954e8473c30a8c7db88a9974c2fa40b1b7c3e27ce3cdc227276bffe39e21c98d9ce93b7c19780af873ff61b4ff44357a4ecc49aea7c7bd019c10','nLUFfJMHs5qlmYxMFF07vz7jyQVawXNReNE8wHCA5f2Pu70Z33tX7gpx15GuI7hq','Admin',1,0,1603460156,1603467370,3588640962,0,10);
/*!40000 ALTER TABLE `db_users_a` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_users_b`
--

DROP TABLE IF EXISTS `db_users_b`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_users_b` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `money_b` float(11,2) NOT NULL DEFAULT '0.00',
  `money_p` float(11,2) NOT NULL DEFAULT '0.00',
  `a_t` int(11) NOT NULL DEFAULT '0',
  `b_t` int(11) NOT NULL DEFAULT '0',
  `c_t` int(11) NOT NULL DEFAULT '0',
  `d_t` int(11) NOT NULL DEFAULT '0',
  `e_t` int(11) NOT NULL DEFAULT '0',
  `a_b` int(11) NOT NULL DEFAULT '0',
  `b_b` int(11) NOT NULL DEFAULT '0',
  `c_b` int(11) NOT NULL DEFAULT '0',
  `d_b` int(11) NOT NULL DEFAULT '0',
  `e_b` int(11) NOT NULL DEFAULT '0',
  `all_time_a` int(11) NOT NULL DEFAULT '0',
  `all_time_b` int(11) NOT NULL DEFAULT '0',
  `all_time_c` int(11) NOT NULL DEFAULT '0',
  `all_time_d` int(11) NOT NULL DEFAULT '0',
  `all_time_e` int(11) NOT NULL DEFAULT '0',
  `last_sbor` int(11) NOT NULL DEFAULT '0',
  `from_referals` float(11,2) NOT NULL DEFAULT '0.00',
  `to_referer` float(11,2) NOT NULL DEFAULT '0.00',
  `payment_sum` float(11,2) NOT NULL DEFAULT '0.00',
  `insert_sum` float(11,2) NOT NULL DEFAULT '0.00',
  `kredit` float(11,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_users_b`
--

LOCK TABLES `db_users_b` WRITE;
/*!40000 ALTER TABLE `db_users_b` DISABLE KEYS */;
INSERT INTO `db_users_b` VALUES (1,'Admin',74.00,9499.00,2,1,1,1,1,9911085,9906134,14856726,19807318,24757910,50271306,50246196,75356738,100467280,125577824,1601224191,0.00,0.00,5.00,0.00,0.00),(2,'aleksey',0.00,0.00,1,0,0,0,0,44587779,0,0,0,0,44587779,0,0,0,0,1601224191,0.00,0.00,0.00,0.00,0.00),(3,'baxedik',0.00,0.00,1,0,0,0,0,25114829,0,0,0,0,25114829,0,0,0,0,1601224191,0.00,0.00,0.00,0.00,0.00),(4,'lexa2015',0.00,0.00,1,0,0,0,0,25114817,0,0,0,0,25114817,0,0,0,0,1601224191,0.00,0.00,0.00,0.00,0.00),(8,'lexa',0.00,0.00,1,0,0,0,0,25109844,0,0,0,0,25109844,0,0,0,0,1601224191,0.00,0.00,0.00,0.00,0.00),(7,'pligin',5851.70,3852.70,3,0,0,0,0,211171,0,0,0,0,25315843,0,0,0,0,1601224191,0.00,0.00,0.00,0.00,0.00),(9,'luchinin',0.00,0.00,1,0,0,0,0,15914220,0,0,0,0,15914220,0,0,0,0,1601224191,0.00,0.00,0.00,0.00,0.00),(10,'icutuz',0.00,0.00,1,0,0,0,0,2663026,0,0,0,0,2663026,0,0,0,0,1601224191,0.00,0.00,0.00,0.00,0.00),(11,'qazqaz',56.00,0.00,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1601909675,0.00,0.00,0.00,0.00,0.00),(12,'MrLogon',116.05,102.05,1,0,0,0,0,0,0,0,0,0,2041,0,0,0,0,1603467498,0.00,0.00,0.00,0.00,0.00);
/*!40000 ALTER TABLE `db_users_b` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_welcomText`
--

DROP TABLE IF EXISTS `db_welcomText`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_welcomText` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_welcomText`
--

LOCK TABLES `db_welcomText` WRITE;
/*!40000 ALTER TABLE `db_welcomText` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_welcomText` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-23 20:18:07
