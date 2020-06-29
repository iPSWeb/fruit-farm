-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 23, 2020 at 09:34 AM
-- Server version: 5.6.39-83.1
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ce11468_swanlake`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_autoref`
--

CREATE TABLE IF NOT EXISTS `db_autoref` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `cost` float(11,2) NOT NULL DEFAULT '0.00',
  `term` int(11) NOT NULL,
  `end` datetime NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_autoref_history`
--

CREATE TABLE IF NOT EXISTS `db_autoref_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `referal_id` bigint(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_autoref_temp`
--

CREATE TABLE IF NOT EXISTS `db_autoref_temp` (
  `user_id` bigint(20) NOT NULL,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_bonus_list`
--

CREATE TABLE IF NOT EXISTS `db_bonus_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `sum` float(11,2) NOT NULL DEFAULT '0.00',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_bonus_list`
--

INSERT INTO `db_bonus_list` (`id`, `user`, `user_id`, `sum`, `date_add`, `date_del`) VALUES
(3, 'Admin', 1, 0.06, 1586368606, 1586455006);

-- --------------------------------------------------------

--
-- Table structure for table `db_conabrul`
--

CREATE TABLE IF NOT EXISTS `db_conabrul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rules` text NOT NULL,
  `about` text NOT NULL,
  `contacts` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_conabrul`
--

INSERT INTO `db_conabrul` (`id`, `rules`, `about`, `contacts`) VALUES
(1, '<p>Правила проекта</p>', '<p>О проекте</p>', '<p>Контактные данные</p>');

-- --------------------------------------------------------

--
-- Table structure for table `db_config`
--

CREATE TABLE IF NOT EXISTS `db_config` (
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

--
-- Dumping data for table `db_config`
--

INSERT INTO `db_config` (`id`, `admin`, `pass`, `min_pay`, `ser_per_wmr`, `ser_per_wmz`, `ser_per_wme`, `ser_per_psc`, `percent_swap`, `percent_sell`, `items_per_coin`, `a_in_h`, `b_in_h`, `c_in_h`, `d_in_h`, `e_in_h`, `amount_a_t`, `amount_b_t`, `amount_c_t`, `amount_d_t`, `amount_e_t`) VALUES
(1, 'admin', 'c5c8fa49f8a50a94488992ee662a4071', 100.00, 100, 3300, 4200, 10, 50, 50, 10, 1001, 2001, 3001, 4001, 5001, 1001, 2001, 3001, 4001, 5001);

-- --------------------------------------------------------

--
-- Table structure for table `db_history_login`
--

CREATE TABLE IF NOT EXISTS `db_history_login` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `ip` int(10) UNSIGNED NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='История авторизаций';

--
-- Dumping data for table `db_history_login`
--

INSERT INTO `db_history_login` (`id`, `user_id`, `ip`, `timestamp`) VALUES
(1, 1, 2994523295, '2020-04-12 15:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `db_insert_money`
--

CREATE TABLE IF NOT EXISTS `db_insert_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `money` float(11,2) NOT NULL DEFAULT '0.00',
  `serebro` int(11) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_lottery`
--

CREATE TABLE IF NOT EXISTS `db_lottery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user` varchar(50) NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_lottery_winners`
--

CREATE TABLE IF NOT EXISTS `db_lottery_winners` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_newlottery`
--

CREATE TABLE IF NOT EXISTS `db_newlottery` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_newlottery_prizes`
--

CREATE TABLE IF NOT EXISTS `db_newlottery_prizes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` enum('a_t','b_t','c_t','d_t','e_t','money_b','money_p') NOT NULL DEFAULT 'money_b',
  `title` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_newlottery_prizes`
--

INSERT INTO `db_newlottery_prizes` (`id`, `name`, `title`, `image`) VALUES
(1, 'a_t', 'Лимонное дерево', '/assets/style/img/fruit/a_t.jpg'),
(2, 'b_t', 'Вишневое дерево', '/assets/style/img/fruit/b_t.jpg'),
(3, 'c_t', 'Куст клубники', '/assets/style/img/fruit/c_t.jpg'),
(4, 'd_t', 'Дерево киви', '/assets/style/img/fruit/d_t.jpg'),
(5, 'e_t', 'Дерево апельсинов', '/assets/style/img/fruit/e_t.jpg'),
(6, 'money_b', 'Серебра на покупки', '/assets/style/img/man-2.jpg'),
(7, 'money_p', 'Серебра на вывод', '/assets/style/img/man-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `db_newlottery_users`
--

CREATE TABLE IF NOT EXISTS `db_newlottery_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lottery_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('winner','loser','waiting') NOT NULL DEFAULT 'waiting',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_news`
--

CREATE TABLE IF NOT EXISTS `db_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `news` text NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_news`
--

INSERT INTO `db_news` (`id`, `title`, `news`, `date_add`) VALUES
(1, 'Тестовая новость', '<p style=\"text-align: center;\"><span style=\"color: #ff0000; font-family: &quot;arial black&quot;, &quot;avant garde&quot;; font-size: medium;\"><strong>Это тестовая новость</strong></span></p>', 1510832442),
(3, 'проба', '<p>проба</p>', 1510900013),
(4, 'проба1', '<p>проба1</p>', 1510919121),
(6, 'тест ', '<div style=\"text-align: center;\"><b>тестовая</b></div>', 1511086117);

-- --------------------------------------------------------

--
-- Table structure for table `db_payeer_insert`
--

CREATE TABLE IF NOT EXISTS `db_payeer_insert` (
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_payeer_insert`
--

INSERT INTO `db_payeer_insert` (`id`, `user_id`, `user`, `sum`, `date_add`, `status`, `description`, `ps`, `request_id`, `operation_id`, `account`) VALUES
(1, 1, 'Admin', 100.00, 1579230518, 0, 'Payeer', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `db_payment`
--

CREATE TABLE IF NOT EXISTS `db_payment` (
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

--
-- Dumping data for table `db_payment`
--

INSERT INTO `db_payment` (`id`, `user`, `user_id`, `purse`, `sum`, `comission`, `valuta`, `serebro`, `status`, `pay_sys`, `pay_sys_id`, `response`, `payment_id`, `date_add`, `date_del`) VALUES
(1, 'Admin', 1, 'P8706145', 1.00, 0.00, 'RUB', 100, 3, '0', 0, 0, '806223850', 1559933720, 0),
(2, 'Admin', 1, 'P1013746860', 1.00, 0.00, 'RUB', 100, 3, '0', 0, 0, '806226765', 1559934092, 0),
(3, 'Admin', 1, '410014713264252', 2.00, 0.00, 'RUB', 200, 3, '0', 0, 0, '631909705766040301', 1578594505, 0),
(5, 'Admin', 1, 'P8706145', 1.00, 0.00, 'RUB', 100, 2, '0', 0, 0, '', 1587986482, 0),
(6, 'Admin', 1, 'P8706145', 1.00, 0.00, 'RUB', 100, 3, '0', 0, 0, '', 1587986941, 0);

-- --------------------------------------------------------

--
-- Table structure for table `db_psc`
--

CREATE TABLE IF NOT EXISTS `db_psc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `publickey` varchar(64) NOT NULL,
  `accountRS` varchar(25) NOT NULL,
  `account` int(50) NOT NULL,
  `phrase` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_psc`
--

INSERT INTO `db_psc` (`id`, `user_id`, `publickey`, `accountRS`, `account`, `phrase`) VALUES
(1, 1, 'a44f98b78c4a05ec09fe86b4b70cbb7518d7988d10fe35a44939f45967c75e46', 'PSC-XHTV-X3EK-FZVC-G43KP', 2147483647, 'promise cruel pause stuck through threw here candle complain balance very grief');

-- --------------------------------------------------------

--
-- Table structure for table `db_recovery`
--

CREATE TABLE IF NOT EXISTS `db_recovery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `ip` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_recovery`
--

INSERT INTO `db_recovery` (`id`, `email`, `ip`, `date_add`, `date_del`) VALUES
(3, 'bax.edik@yandex.ru', 1509523661, 1510918999, 1510919899);

-- --------------------------------------------------------

--
-- Table structure for table `db_regkey`
--

CREATE TABLE IF NOT EXISTS `db_regkey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `referer_id` int(11) NOT NULL DEFAULT '0',
  `referer_name` varchar(50) NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_sell_items`
--

CREATE TABLE IF NOT EXISTS `db_sell_items` (
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_sell_items`
--

INSERT INTO `db_sell_items` (`id`, `user`, `user_id`, `a_s`, `b_s`, `c_s`, `d_s`, `e_s`, `amount`, `all_sell`, `date_add`, `date_del`) VALUES
(2, 'Admin', 1, 143409, 143338, 214971, 286604, 358237, 114655.90, 1146559, 1511084878, 1512380878),
(3, 'Admin', 1, 27165279, 27151710, 40720781, 54289851, 67858922, 21718654.00, 217186543, 1559933542, 1561229542),
(4, 'Admin', 1, 10731224, 10725864, 16086115, 21446367, 26806619, 8579619.00, 85796189, 1579230466, 1580526466),
(5, 'Admin', 1, 2319868, 2318709, 3477484, 4636259, 5795034, 1854735.38, 18547354, 1583402060, 1584698060);

-- --------------------------------------------------------

--
-- Table structure for table `db_sender`
--

CREATE TABLE IF NOT EXISTS `db_sender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mess` text NOT NULL,
  `page` int(5) NOT NULL DEFAULT '0',
  `sended` int(7) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_sender`
--

INSERT INTO `db_sender` (`id`, `name`, `mess`, `page`, `sended`, `status`, `date_add`) VALUES
(1, 'Тестовая рассылка', 'Привет, {!USER!}!\r\nЭто тестовая рассылка', 0, 0, 0, 1510834066);

-- --------------------------------------------------------

--
-- Table structure for table `db_stats`
--

CREATE TABLE IF NOT EXISTS `db_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `all_users` int(11) NOT NULL DEFAULT '0',
  `all_payments` float(11,2) NOT NULL DEFAULT '0.00',
  `all_insert` float(11,2) NOT NULL DEFAULT '0.00',
  `donations` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_stats`
--

INSERT INTO `db_stats` (`id`, `all_users`, `all_payments`, `all_insert`, `donations`) VALUES
(1, 10, 6.00, 0.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `db_stats_btree`
--

CREATE TABLE IF NOT EXISTS `db_stats_btree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user` varchar(50) NOT NULL,
  `tree_name` varchar(50) NOT NULL,
  `amount` float(11,2) NOT NULL DEFAULT '0.00',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_stats_btree`
--

INSERT INTO `db_stats_btree` (`id`, `user_id`, `user`, `tree_name`, `amount`, `date_add`, `date_del`) VALUES
(1, 1, 'Admin', 'Лайм', 1001.00, 1510826203, 1512122203),
(2, 1, 'Admin', 'Лайм', 1001.00, 1510826278, 1512122278),
(3, 1, 'Admin', 'Вишня', 2001.00, 1510826290, 1512122290),
(4, 1, 'Admin', 'Апельсин', 5001.00, 1510826294, 1512122294),
(5, 1, 'Admin', 'Киви', 4001.00, 1510826298, 1512122298),
(6, 1, 'Admin', 'Клубника', 3001.00, 1510826300, 1512122300);

-- --------------------------------------------------------

--
-- Table structure for table `db_swap_ser`
--

CREATE TABLE IF NOT EXISTS `db_swap_ser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `amount_b` float(11,2) NOT NULL DEFAULT '0.00',
  `amount_p` float(11,2) NOT NULL DEFAULT '0.00',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_swap_ser`
--

INSERT INTO `db_swap_ser` (`id`, `user_id`, `user`, `amount_b`, `amount_p`, `date_add`, `date_del`) VALUES
(3, 1, 'Admin', 1500.00, 1000.00, 1510898628, 1512194628);

-- --------------------------------------------------------

--
-- Table structure for table `db_users_a`
--

CREATE TABLE IF NOT EXISTS `db_users_a` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `referer` varchar(50) NOT NULL,
  `referer_id` int(11) NOT NULL DEFAULT '0',
  `referals` int(11) NOT NULL DEFAULT '0',
  `date_reg` int(11) NOT NULL DEFAULT '0',
  `date_login` int(11) NOT NULL DEFAULT '0',
  `ip` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `banned` int(1) NOT NULL DEFAULT '0',
  `refback` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_users_a`
--

INSERT INTO `db_users_a` (`id`, `user`, `email`, `pass`, `referer`, `referer_id`, `referals`, `date_reg`, `date_login`, `ip`, `banned`, `refback`) VALUES
(1, 'Admin', 'admin@admin.ru', 'admin', 'Admin', 1, 8, 1367313062, 1592836895, 1427827337, 0, 50),
(2, 'aleksey', 'leha.vodanov@mail.ru', 'aleksey', 'Admin', 1, 0, 1440868538, 1440868651, 1832711990, 0, 0),
(3, 'baxedik', 'bax.edik@yandex.ru', '000000', 'Admin', 1, 0, 1510901125, 1510904750, 1509523661, 0, 0),
(4, 'lexa2015', 'bax@yandex.ru', '000000', 'Admin', 1, 0, 1510901171, 0, 1509523661, 0, 0),
(7, 'pligin', 'pligin103@gmail.com', 'a12344321', 'Admin', 1, 0, 1510915285, 0, 2956760126, 0, 0),
(8, 'lexa', 'edik@yandex.ru', '000000', 'Admin', 1, 0, 1510919054, 0, 1509523661, 0, 0),
(9, 'luchinin', 'maksim@luchinin.net', 'dZtXrWR49B4rF3G', 'Admin', 1, 0, 1543990229, 1544222965, 3585554581, 0, 0),
(10, 'icutuz', 'cutuzowandrey@gmail.com', 'swat181199', 'Admin', 1, 0, 1591646873, 0, 771757176, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `db_users_b`
--

CREATE TABLE IF NOT EXISTS `db_users_b` (
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

--
-- Dumping data for table `db_users_b`
--

INSERT INTO `db_users_b` (`id`, `user`, `money_b`, `money_p`, `a_t`, `b_t`, `c_t`, `d_t`, `e_t`, `a_b`, `b_b`, `c_b`, `d_b`, `e_b`, `all_time_a`, `all_time_b`, `all_time_c`, `all_time_d`, `all_time_e`, `last_sbor`, `from_referals`, `to_referer`, `payment_sum`, `insert_sum`, `kredit`) VALUES
(1, 'Admin', -20.00, 9499.00, 2, 1, 1, 1, 1, 2693649, 2692304, 4037783, 5383262, 6728741, 43053870, 43032366, 64537795, 86043224, 107548655, 1588245785, 0.00, 0.00, 5.00, 0.00, 0.00),
(2, 'aleksey', 0.00, 0.00, 1, 0, 0, 0, 0, 40979062, 0, 0, 0, 0, 40979062, 0, 0, 0, 0, 1588245785, 0.00, 0.00, 0.00, 0.00, 0.00),
(3, 'baxedik', 0.00, 0.00, 1, 0, 0, 0, 0, 21506112, 0, 0, 0, 0, 21506112, 0, 0, 0, 0, 1588245785, 0.00, 0.00, 0.00, 0.00, 0.00),
(4, 'lexa2015', 0.00, 0.00, 1, 0, 0, 0, 0, 21506100, 0, 0, 0, 0, 21506100, 0, 0, 0, 0, 1588245785, 0.00, 0.00, 0.00, 0.00, 0.00),
(8, 'lexa', 0.00, 0.00, 1, 0, 0, 0, 0, 21501127, 0, 0, 0, 0, 21501127, 0, 0, 0, 0, 1588245785, 0.00, 0.00, 0.00, 0.00, 0.00),
(7, 'pligin', 0.00, 0.00, 1, 0, 0, 0, 0, 21502175, 0, 0, 0, 0, 21502175, 0, 0, 0, 0, 1588245785, 0.00, 0.00, 0.00, 0.00, 0.00),
(9, 'luchinin', 0.00, 0.00, 1, 0, 0, 0, 0, 12305503, 0, 0, 0, 0, 12305503, 0, 0, 0, 0, 1588245785, 0.00, 0.00, 0.00, 0.00, 0.00),
(10, 'icutuz', 0.00, 0.00, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1591646873, 0.00, 0.00, 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `db_welcomText`
--

CREATE TABLE IF NOT EXISTS `db_welcomText` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
