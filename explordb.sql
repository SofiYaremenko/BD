-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 07, 2019 at 10:38 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `explordb`
--

-- --------------------------------------------------------

--
-- Table structure for table `carrier`
--

DROP TABLE IF EXISTS `carrier`;
CREATE TABLE IF NOT EXISTS `carrier` (
  `id_carrier` int(11) NOT NULL AUTO_INCREMENT,
  `car_number` char(8) CHARACTER SET latin1 NOT NULL,
  `name_company` varchar(30) CHARACTER SET latin1 NOT NULL,
  `seats` int(11) NOT NULL,
  `driver_license` char(9) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_carrier`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `carrier`
--

INSERT INTO `carrier` (`id_carrier`, `car_number`, `name_company`, `seats`, `driver_license`) VALUES
(1, 'CE1784BA', 'TourRide', 29, 'BYA000256');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `cl_login` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `cl_password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `cl_surname` varchar(30) CHARACTER SET latin1 NOT NULL,
  `cl_name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `cl_fname` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `passport_n` varchar(8) CHARACTER SET latin1 DEFAULT NULL,
  `birthday` date NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `cl_phone` varchar(10) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id_client`, `cl_login`, `cl_password`, `user_type`, `cl_surname`, `cl_name`, `cl_fname`, `passport_n`, `birthday`, `email`, `cl_phone`) VALUES
(1, 'Sofi', 'Sofi', 'user', 'Yaremenko', 'Sofi', '', '', '1999-09-26', 'sofia@yaremenko.ws', '0973360447'),
(3, 'Liza', 'liza_user', 'user', 'Big', 'Liza', '', 'TY123529', '1999-07-12', 'liza@gmail.com', '0452317628');

-- --------------------------------------------------------

--
-- Table structure for table `consists_of`
--

DROP TABLE IF EXISTS `consists_of`;
CREATE TABLE IF NOT EXISTS `consists_of` (
  `excursion_fk` int(11) NOT NULL,
  `places_fk` int(11) NOT NULL,
  PRIMARY KEY (`excursion_fk`,`places_fk`),
  KEY `places_fk` (`places_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `excursions`
--

DROP TABLE IF EXISTS `excursions`;
CREATE TABLE IF NOT EXISTS `excursions` (
  `id_excursion` int(11) NOT NULL AUTO_INCREMENT,
  `name_excurs` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `discrip_excurs` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `min_people` int(11) NOT NULL,
  `max_people` int(11) NOT NULL,
  `duration` time NOT NULL,
  `cost_excurs` int(11) NOT NULL,
  `winter` tinyint(1) NOT NULL,
  `spring` tinyint(1) NOT NULL,
  `summer` tinyint(1) NOT NULL,
  `autumn` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_excursion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `excursions`
--

INSERT INTO `excursions` (`id_excursion`, `name_excurs`, `discrip_excurs`, `min_people`, `max_people`, `duration`, `cost_excurs`, `winter`, `spring`, `summer`, `autumn`) VALUES
(1, 'Dendropark Uman', 'Take a stroll under the shady canopy of the trees to make wishes, to boating, to breathe the fresh damp air, feed the squirrels and to believe in love.', 20, 50, '11:00:00', 65, 0, 1, 1, 1),
(2, 'Mamajeva Sloboda', 'A tour to the Mamajeva Sloboda open-air museum is an excellent opportunity to get to know the traditions and discover the authentic Ukrainian...', 12, 30, '03:00:00', 30, 0, 1, 1, 1),
(3, 'Lviv by night', 'Walking tour around streets of Lviv in the evening will feature the stories of city.\r\nLviv is wonderful in the evening, when the lights of seven colors change.', 5, 15, '02:00:00', 15, 1, 1, 1, 1),
(4, 'Seven Wonders of Lviv', 'Walking tour to unique sights of the city.Lviv has many \"wonders\", but only seven of the most worthy were chosen. Be ready to discover them!', 5, 25, '06:00:00', 20, 1, 1, 1, 1),
(5, 'Extreme tour to the Chernobyl', 'You will see the \"ghost city\" Prypyat, abandoned in times of Soviet Union and frozen forever...\r\nYou will touch a part of history that have changed the World!', 10, 25, '11:00:00', 100, 0, 1, 1, 1),
(6, 'The Mysteries of the Odessa', 'Odessa catacombs - the longest in the world. By some estimates the length of underground labyrinths under the city is about 2500 miles.', 10, 15, '04:00:00', 40, 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `excursion_order`
--

DROP TABLE IF EXISTS `excursion_order`;
CREATE TABLE IF NOT EXISTS `excursion_order` (
  `id_excurs_order` int(11) NOT NULL AUTO_INCREMENT,
  `price` int(11) NOT NULL,
  `excurs_date` date NOT NULL,
  `time_start` time NOT NULL,
  `fk_excurs` int(11) NOT NULL,
  `fk_carrier` int(11) NOT NULL,
  `fk_guides` int(11) NOT NULL,
  PRIMARY KEY (`id_excurs_order`),
  KEY `fk_excurs` (`fk_excurs`),
  KEY `fk_carrier` (`fk_carrier`),
  KEY `fk_guides` (`fk_guides`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guides`
--

DROP TABLE IF EXISTS `guides`;
CREATE TABLE IF NOT EXISTS `guides` (
  `tab_number` int(11) NOT NULL AUTO_INCREMENT,
  `g_login` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `g_password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `g_usertype` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `g_surname` varchar(30) CHARACTER SET latin1 NOT NULL,
  `g_name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `g_fname` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `g_phone` char(10) CHARACTER SET latin1 NOT NULL,
  `g_anoth_phone` char(10) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`tab_number`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `guides`
--

INSERT INTO `guides` (`tab_number`, `g_login`, `g_password`, `g_usertype`, `g_surname`, `g_name`, `g_fname`, `g_phone`, `g_anoth_phone`) VALUES
(1, 'Katryn', 'g_katryn', 'guide', 'Krinecheva', 'Katryn', NULL, '0675842344', NULL),
(2, 'sofiyaremenko', 'admin', 'user', 'Big', 'Liza', 'ADMIN', '0452317628', '');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `id_language` int(11) NOT NULL AUTO_INCREMENT,
  `lan_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_language`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id_language`, `lan_name`) VALUES
(1, 'CHINESE'),
(2, 'SPANISH'),
(3, 'PORTUGUESE'),
(4, 'RUSSIAN'),
(5, 'JAPANESE'),
(6, 'GERMAN'),
(7, 'KOREAN'),
(8, 'FRENCH'),
(9, 'TURKISH'),
(10, 'ENGLISH'),
(11, 'ESTONIAN'),
(12, 'ITALIAN'),
(13, 'UKRAINIAN');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

DROP TABLE IF EXISTS `managers`;
CREATE TABLE IF NOT EXISTS `managers` (
  `id_manager` int(11) NOT NULL AUTO_INCREMENT,
  `manag_login` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `manag_password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `m_usertype` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `manag_surname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `manag_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `manag_fname` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manag_phone` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `m_anoth_phone` char(10) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_manager`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id_manager`, `manag_login`, `manag_password`, `m_usertype`, `manag_surname`, `manag_name`, `manag_fname`, `manag_phone`, `m_anoth_phone`) VALUES
(1, 'NataAdmin', 'admin', 'admin', 'Rybak', 'Nata', '', '0982732085', ''),
(2, 'SofiAdmin', 'admin', 'admin', 'Yaremenko', 'Sofi', NULL, '0973360447', NULL),
(4, 'Admin', 'admin', 'admin', 'Big', 'Admin', 'ADMIN', '0973360448', '');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` date NOT NULL,
  `deadline_pay` date NOT NULL,
  `persons` int(11) NOT NULL,
  `language` varchar(30) CHARACTER SET latin1 NOT NULL,
  `response` varchar(300) CHARACTER SET latin1 NOT NULL,
  `discount` int(11) NOT NULL,
  `if_payed` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `client_c_id` int(11) NOT NULL,
  `manag_c_id` int(11) NOT NULL,
  `excurs_c_id` int(11) NOT NULL,
  PRIMARY KEY (`id_order`),
  KEY `excurs_c_id` (`excurs_c_id`),
  KEY `manag_c_id` (`manag_c_id`),
  KEY `client_c_id` (`client_c_id`),
  KEY `client_c_id_2` (`client_c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

DROP TABLE IF EXISTS `places`;
CREATE TABLE IF NOT EXISTS `places` (
  `id_place` int(11) NOT NULL AUTO_INCREMENT,
  `name_place` varchar(30) CHARACTER SET latin1 NOT NULL,
  `discrip_place` varchar(300) CHARACTER SET latin1 NOT NULL,
  `max_people_place` int(11) DEFAULT NULL,
  `provider` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  PRIMARY KEY (`id_place`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id_place`, `name_place`, `discrip_place`, `max_people_place`, `provider`, `longitude`, `latitude`) VALUES
(1, 'KMA', 'Univers in Kyiv', NULL, NULL, 98765, 765432),
(2, 'kpi', 'Univers in Kyiv', NULL, NULL, 24375, 475878),
(4, '', '', 0, '', 747532, 653234);

-- --------------------------------------------------------

--
-- Table structure for table `possess`
--

DROP TABLE IF EXISTS `possess`;
CREATE TABLE IF NOT EXISTS `possess` (
  `guides_fk` int(11) NOT NULL,
  `languag_fk` int(11) NOT NULL,
  PRIMARY KEY (`guides_fk`,`languag_fk`),
  KEY `languag_fk` (`languag_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `possess`
--

INSERT INTO `possess` (`guides_fk`, `languag_fk`) VALUES
(1, 3),
(1, 9),
(1, 13),
(2, 13);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consists_of`
--
ALTER TABLE `consists_of`
  ADD CONSTRAINT `consists_of_ibfk_1` FOREIGN KEY (`excursion_fk`) REFERENCES `excursions` (`id_excursion`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `consists_of_ibfk_2` FOREIGN KEY (`places_fk`) REFERENCES `places` (`id_place`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `excursion_order`
--
ALTER TABLE `excursion_order`
  ADD CONSTRAINT `excursion_order_ibfk_1` FOREIGN KEY (`fk_carrier`) REFERENCES `carrier` (`id_carrier`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `excursion_order_ibfk_2` FOREIGN KEY (`fk_excurs`) REFERENCES `excursions` (`id_excursion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `excursion_order_ibfk_3` FOREIGN KEY (`fk_guides`) REFERENCES `guides` (`tab_number`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`client_c_id`) REFERENCES `clients` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`excurs_c_id`) REFERENCES `excursions` (`id_excursion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`manag_c_id`) REFERENCES `managers` (`id_manager`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `possess`
--
ALTER TABLE `possess`
  ADD CONSTRAINT `possess_ibfk_1` FOREIGN KEY (`guides_fk`) REFERENCES `guides` (`tab_number`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `possess_ibfk_2` FOREIGN KEY (`languag_fk`) REFERENCES `language` (`id_language`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
