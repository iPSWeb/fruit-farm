-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2020 at 08:42 PM
-- Server version: 5.5.64-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_1_ff`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_autoref`
--

CREATE TABLE IF NOT EXISTS `db_autoref` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `cost` float(11,2) NOT NULL DEFAULT '0.00',
  `term` int(11) NOT NULL,
  `end` datetime NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_autoref_temp`
--

CREATE TABLE IF NOT EXISTS `db_autoref_temp` (
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_bonus_list`
--

CREATE TABLE IF NOT EXISTS `db_bonus_list` (
  `id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `sum` double NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0'
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
  `id` int(11) NOT NULL,
  `rules` text NOT NULL,
  `about` text NOT NULL,
  `contacts` text NOT NULL
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
  `id` int(11) NOT NULL,
  `admin` varchar(10) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `min_pay` double NOT NULL DEFAULT '15',
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
  `amount_e_t` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_config`
--

INSERT INTO `db_config` (`id`, `admin`, `pass`, `min_pay`, `ser_per_wmr`, `ser_per_wmz`, `ser_per_wme`, `ser_per_psc`, `percent_swap`, `percent_sell`, `items_per_coin`, `a_in_h`, `b_in_h`, `c_in_h`, `d_in_h`, `e_in_h`, `amount_a_t`, `amount_b_t`, `amount_c_t`, `amount_d_t`, `amount_e_t`) VALUES
(1, 'admin', 'admin', 100, 100, 3300, 4200, 10, 50, 50, 10, 1001, 2001, 3001, 4001, 5001, 1001, 2001, 3001, 4001, 5001);

-- --------------------------------------------------------

--
-- Table structure for table `db_history_login`
--

CREATE TABLE IF NOT EXISTS `db_history_login` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `ip` int(10) unsigned NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `money` double NOT NULL DEFAULT '0',
  `serebro` int(11) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_lottery`
--

CREATE TABLE IF NOT EXISTS `db_lottery` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user` varchar(10) NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_lottery_winners`
--

CREATE TABLE IF NOT EXISTS `db_lottery_winners` (
  `id` int(11) NOT NULL,
  `user_a` varchar(10) NOT NULL,
  `bil_a` int(11) NOT NULL DEFAULT '0',
  `user_b` varchar(10) NOT NULL,
  `bil_b` int(11) NOT NULL DEFAULT '0',
  `user_c` varchar(10) NOT NULL,
  `bil_c` int(11) NOT NULL DEFAULT '0',
  `bank` float NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_news`
--

CREATE TABLE IF NOT EXISTS `db_news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `news` text NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_news`
--

INSERT INTO `db_news` (`id`, `title`, `news`, `date_add`) VALUES
(1, 'Тестовая новость', '<p style="text-align: center;"><span style="color: #ff0000; font-family: &quot;arial black&quot;, &quot;avant garde&quot;; font-size: medium;"><strong>Это тестовая новость</strong></span></p>', 1510832442),
(3, 'проба', '<p>проба</p>', 1510900013),
(4, 'проба1', '<p>проба1</p>', 1510919121),
(6, 'тест ', '<div style="text-align: center;"><b>тестовая</b></div>', 1511086117);

-- --------------------------------------------------------

--
-- Table structure for table `db_payeer_insert`
--

CREATE TABLE IF NOT EXISTS `db_payeer_insert` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `sum` double NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `description` varchar(20) NOT NULL,
  `ps` varchar(20) NOT NULL,
  `request_id` varchar(64) NOT NULL,
  `operation_id` varchar(20) NOT NULL,
  `account` varchar(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_payeer_insert`
--

INSERT INTO `db_payeer_insert` (`id`, `user_id`, `user`, `sum`, `date_add`, `status`, `description`, `ps`, `request_id`, `operation_id`, `account`) VALUES
(1, 1, 'Admin', 100, 1579230518, 0, 'Payeer', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `db_payment`
--

CREATE TABLE IF NOT EXISTS `db_payment` (
  `id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `purse` varchar(20) NOT NULL,
  `sum` double NOT NULL DEFAULT '0',
  `comission` double NOT NULL DEFAULT '0',
  `valuta` varchar(3) NOT NULL DEFAULT 'RUB',
  `serebro` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `pay_sys` varchar(100) NOT NULL DEFAULT '0',
  `pay_sys_id` int(11) NOT NULL DEFAULT '0',
  `response` int(1) NOT NULL DEFAULT '0',
  `payment_id` varchar(20) NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_payment`
--

INSERT INTO `db_payment` (`id`, `user`, `user_id`, `purse`, `sum`, `comission`, `valuta`, `serebro`, `status`, `pay_sys`, `pay_sys_id`, `response`, `payment_id`, `date_add`, `date_del`) VALUES
(1, 'Admin', 1, 'P8706145', 1, 0, 'RUB', 100, 3, '0', 0, 0, '806223850', 1559933720, 0),
(2, 'Admin', 1, 'P1013746860', 1, 0, 'RUB', 100, 3, '0', 0, 0, '806226765', 1559934092, 0),
(3, 'Admin', 1, '410014713264252', 2, 0, 'RUB', 200, 3, '0', 0, 0, '631909705766040301', 1578594505, 0);

-- --------------------------------------------------------

--
-- Table structure for table `db_psc`
--

CREATE TABLE IF NOT EXISTS `db_psc` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `publickey` varchar(64) NOT NULL,
  `accountRS` varchar(25) NOT NULL,
  `account` int(50) NOT NULL,
  `phrase` varchar(120) NOT NULL
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
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ip` int(10) unsigned NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0'
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
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `referer_id` int(11) NOT NULL DEFAULT '0',
  `referer_name` varchar(10) NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_sell_items`
--

CREATE TABLE IF NOT EXISTS `db_sell_items` (
  `id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `a_s` int(11) NOT NULL DEFAULT '0',
  `b_s` int(11) NOT NULL DEFAULT '0',
  `c_s` int(11) NOT NULL DEFAULT '0',
  `d_s` int(11) NOT NULL DEFAULT '0',
  `e_s` int(11) NOT NULL DEFAULT '0',
  `amount` double NOT NULL DEFAULT '0',
  `all_sell` int(11) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_sell_items`
--

INSERT INTO `db_sell_items` (`id`, `user`, `user_id`, `a_s`, `b_s`, `c_s`, `d_s`, `e_s`, `amount`, `all_sell`, `date_add`, `date_del`) VALUES
(2, 'Admin', 1, 143409, 143338, 214971, 286604, 358237, 114655.9, 1146559, 1511084878, 1512380878),
(3, 'Admin', 1, 27165279, 27151710, 40720781, 54289851, 67858922, 21718654.3, 217186543, 1559933542, 1561229542),
(4, 'Admin', 1, 10731224, 10725864, 16086115, 21446367, 26806619, 8579618.9, 85796189, 1579230466, 1580526466),
(5, 'Admin', 1, 2319868, 2318709, 3477484, 4636259, 5795034, 1854735.4, 18547354, 1583402060, 1584698060);

-- --------------------------------------------------------

--
-- Table structure for table `db_sender`
--

CREATE TABLE IF NOT EXISTS `db_sender` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mess` text NOT NULL,
  `page` int(5) NOT NULL DEFAULT '0',
  `sended` int(7) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0'
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
  `id` int(11) NOT NULL,
  `all_users` int(11) NOT NULL DEFAULT '0',
  `all_payments` double NOT NULL DEFAULT '0',
  `all_insert` double NOT NULL DEFAULT '0',
  `donations` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_stats`
--

INSERT INTO `db_stats` (`id`, `all_users`, `all_payments`, `all_insert`, `donations`) VALUES
(1, 9, 5, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `db_stats_btree`
--

CREATE TABLE IF NOT EXISTS `db_stats_btree` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user` varchar(10) NOT NULL,
  `tree_name` varchar(10) NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_stats_btree`
--

INSERT INTO `db_stats_btree` (`id`, `user_id`, `user`, `tree_name`, `amount`, `date_add`, `date_del`) VALUES
(1, 1, 'Admin', 'Лайм', 1001, 1510826203, 1512122203),
(2, 1, 'Admin', 'Лайм', 1001, 1510826278, 1512122278),
(3, 1, 'Admin', 'Вишня', 2001, 1510826290, 1512122290),
(4, 1, 'Admin', 'Апельсин', 5001, 1510826294, 1512122294),
(5, 1, 'Admin', 'Киви', 4001, 1510826298, 1512122298),
(6, 1, 'Admin', 'Клубника', 3001, 1510826300, 1512122300);

-- --------------------------------------------------------

--
-- Table structure for table `db_swap_ser`
--

CREATE TABLE IF NOT EXISTS `db_swap_ser` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `amount_b` double NOT NULL DEFAULT '0',
  `amount_p` double NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_swap_ser`
--

INSERT INTO `db_swap_ser` (`id`, `user_id`, `user`, `amount_b`, `amount_p`, `date_add`, `date_del`) VALUES
(3, 1, 'Admin', 1500, 1000, 1510898628, 1512194628);

-- --------------------------------------------------------

--
-- Table structure for table `db_users_a`
--

CREATE TABLE IF NOT EXISTS `db_users_a` (
  `id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `referer` varchar(10) NOT NULL,
  `referer_id` int(11) NOT NULL DEFAULT '0',
  `referals` int(11) NOT NULL DEFAULT '0',
  `date_reg` int(11) NOT NULL DEFAULT '0',
  `date_login` int(11) NOT NULL DEFAULT '0',
  `ip` int(10) unsigned NOT NULL DEFAULT '0',
  `banned` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_users_a`
--

INSERT INTO `db_users_a` (`id`, `user`, `email`, `pass`, `referer`, `referer_id`, `referals`, `date_reg`, `date_login`, `ip`, `banned`) VALUES
(1, 'Admin', 'admin@admin.ru', 'admin', 'Admin', 1, 7, 1367313062, 1587221810, 775482167, 0),
(2, 'aleksey', 'leha.vodanov@mail.ru', 'aleksey', 'Admin', 1, 0, 1440868538, 1440868651, 1832711990, 0),
(3, 'baxedik', 'bax.edik@yandex.ru', '000000', 'Admin', 1, 0, 1510901125, 1510904750, 1509523661, 0),
(4, 'lexa2015', 'bax@yandex.ru', '000000', 'Admin', 1, 0, 1510901171, 0, 1509523661, 0),
(7, 'pligin', 'pligin103@gmail.com', 'a12344321', 'Admin', 1, 0, 1510915285, 0, 2956760126, 0),
(8, 'lexa', 'edik@yandex.ru', '000000', 'Admin', 1, 0, 1510919054, 0, 1509523661, 0),
(9, 'luchinin', 'maksim@luchinin.net', 'dZtXrWR49B4rF3G', 'Admin', 1, 0, 1543990229, 1544222965, 3585554581, 0);

-- --------------------------------------------------------

--
-- Table structure for table `db_users_b`
--

CREATE TABLE IF NOT EXISTS `db_users_b` (
  `id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `money_b` double NOT NULL DEFAULT '0',
  `money_p` double NOT NULL DEFAULT '0',
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
  `from_referals` double NOT NULL DEFAULT '0',
  `to_referer` double NOT NULL DEFAULT '0',
  `payment_sum` double NOT NULL DEFAULT '0',
  `insert_sum` double NOT NULL DEFAULT '0',
  `kredit` double NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_users_b`
--

INSERT INTO `db_users_b` (`id`, `user`, `money_b`, `money_p`, `a_t`, `b_t`, `c_t`, `d_t`, `e_t`, `a_b`, `b_b`, `c_b`, `d_b`, `e_b`, `all_time_a`, `all_time_b`, `all_time_c`, `all_time_d`, `all_time_e`, `last_sbor`, `from_referals`, `to_referer`, `payment_sum`, `insert_sum`, `kredit`) VALUES
(1, 'Admin', 0, 0, 2, 1, 1, 1, 1, 0, 0, 0, 0, 0, 40360221, 40340062, 60500012, 80659962, 100819914, 1583402060, 0, 0, 4, 0, 0),
(2, 'aleksey', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1440868538, 0, 0, 0, 0, 0),
(3, 'baxedik', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1510901125, 0, 0, 0, 0, 0),
(4, 'lexa2015', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1510901171, 0, 0, 0, 0, 0),
(8, 'lexa', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1510919054, 0, 0, 0, 0, 0),
(7, 'pligin', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1510915285, 0, 0, 0, 0, 0),
(9, 'luchinin', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1543990229, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_autoref`
--
ALTER TABLE `db_autoref`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_autoref_temp`
--
ALTER TABLE `db_autoref_temp`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `db_bonus_list`
--
ALTER TABLE `db_bonus_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_conabrul`
--
ALTER TABLE `db_conabrul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_config`
--
ALTER TABLE `db_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_history_login`
--
ALTER TABLE `db_history_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_insert_money`
--
ALTER TABLE `db_insert_money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_lottery`
--
ALTER TABLE `db_lottery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_lottery_winners`
--
ALTER TABLE `db_lottery_winners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_news`
--
ALTER TABLE `db_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_payeer_insert`
--
ALTER TABLE `db_payeer_insert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_payment`
--
ALTER TABLE `db_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_psc`
--
ALTER TABLE `db_psc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_recovery`
--
ALTER TABLE `db_recovery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ip` (`ip`);

--
-- Indexes for table `db_regkey`
--
ALTER TABLE `db_regkey`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `db_sell_items`
--
ALTER TABLE `db_sell_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_sender`
--
ALTER TABLE `db_sender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_stats`
--
ALTER TABLE `db_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_stats_btree`
--
ALTER TABLE `db_stats_btree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_swap_ser`
--
ALTER TABLE `db_swap_ser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_users_a`
--
ALTER TABLE `db_users_a`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `ip` (`ip`);

--
-- Indexes for table `db_users_b`
--
ALTER TABLE `db_users_b`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_autoref`
--
ALTER TABLE `db_autoref`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_bonus_list`
--
ALTER TABLE `db_bonus_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `db_conabrul`
--
ALTER TABLE `db_conabrul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `db_config`
--
ALTER TABLE `db_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `db_history_login`
--
ALTER TABLE `db_history_login`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `db_insert_money`
--
ALTER TABLE `db_insert_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_lottery`
--
ALTER TABLE `db_lottery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_lottery_winners`
--
ALTER TABLE `db_lottery_winners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_news`
--
ALTER TABLE `db_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `db_payeer_insert`
--
ALTER TABLE `db_payeer_insert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `db_payment`
--
ALTER TABLE `db_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `db_psc`
--
ALTER TABLE `db_psc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `db_recovery`
--
ALTER TABLE `db_recovery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `db_regkey`
--
ALTER TABLE `db_regkey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_sell_items`
--
ALTER TABLE `db_sell_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `db_sender`
--
ALTER TABLE `db_sender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `db_stats`
--
ALTER TABLE `db_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `db_stats_btree`
--
ALTER TABLE `db_stats_btree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `db_swap_ser`
--
ALTER TABLE `db_swap_ser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `db_users_a`
--
ALTER TABLE `db_users_a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
