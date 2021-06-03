-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2021 at 12:27 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_portty`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_boards`
--

CREATE TABLE `tbl_boards` (
  `id` int(11) NOT NULL,
  `board_name` varchar(128) NOT NULL,
  `board_desc` varchar(128) NOT NULL,
  `board_location` varchar(128) NOT NULL,
  `server_name` varchar(128) NOT NULL,
  `com_port` varchar(64) NOT NULL,
  `board_type` varchar(128) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `temp` varchar(24) NOT NULL,
  `hum` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_boards`
--

INSERT INTO `tbl_boards` (`id`, `board_name`, `board_desc`, `board_location`, `server_name`, `com_port`, `board_type`, `active`, `temp`, `hum`) VALUES
(49, 'piggery_lighting_1', '', '', 'home_san_pedro', 'com10', 'uno', 0, '29.30', '16.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dht`
--

CREATE TABLE `tbl_dht` (
  `id` int(11) NOT NULL,
  `board_name` varchar(128) NOT NULL,
  `temp` varchar(24) NOT NULL,
  `hum` varchar(24) NOT NULL,
  `dt` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_dht`
--

INSERT INTO `tbl_dht` (`id`, `board_name`, `temp`, `hum`, `dt`) VALUES
(1, 'piggery_lighting_1', '28.80', '19.00', '00:17:51'),
(2, 'piggery_lighting_1', '28.70', '19.00', '00:17:54'),
(3, 'piggery_lighting_1', '28.80', '20.00', '00:17:57'),
(4, 'piggery_lighting_1', '28.80', '20.00', '00:18:00'),
(5, 'piggery_lighting_1', '28.80', '19.00', '00:18:03'),
(6, 'piggery_lighting_1', '28.80', '19.00', '00:18:06'),
(7, 'piggery_lighting_1', '28.80', '19.00', '00:18:09'),
(8, 'piggery_lighting_1', '28.80', '19.00', '00:18:12'),
(9, 'piggery_lighting_1', '28.80', '19.00', '00:18:15'),
(10, 'piggery_lighting_1', '28.80', '19.00', '00:18:18'),
(11, 'piggery_lighting_1', '28.80', '19.00', '00:18:21'),
(12, 'piggery_lighting_1', '28.80', '19.00', '00:18:24'),
(13, 'piggery_lighting_1', '28.80', '19.00', '00:18:27'),
(14, 'piggery_lighting_1', '28.80', '19.00', '00:18:30'),
(15, 'piggery_lighting_1', '28.80', '19.00', '00:18:33'),
(16, 'piggery_lighting_1', '28.80', '19.00', '00:18:36'),
(17, 'piggery_lighting_1', '28.80', '19.00', '00:18:39'),
(18, 'piggery_lighting_1', '28.80', '19.00', '00:18:42'),
(19, 'piggery_lighting_1', '28.80', '19.00', '00:18:45'),
(20, 'piggery_lighting_1', '28.80', '19.00', '00:18:48'),
(21, 'piggery_lighting_1', '28.80', '19.00', '00:18:51'),
(22, 'piggery_lighting_1', '28.80', '19.00', '00:18:54'),
(23, 'piggery_lighting_1', '28.80', '19.00', '00:18:57'),
(24, 'piggery_lighting_1', '28.80', '19.00', '00:19:00'),
(25, 'piggery_lighting_1', '28.80', '19.00', '00:19:03'),
(26, 'piggery_lighting_1', '28.80', '19.00', '00:19:06'),
(27, 'piggery_lighting_1', '28.80', '19.00', '00:19:09'),
(28, 'piggery_lighting_1', '28.80', '19.00', '00:19:12'),
(29, 'piggery_lighting_1', '28.80', '19.00', '00:19:15'),
(30, 'piggery_lighting_1', '28.80', '19.00', '00:19:18'),
(31, 'piggery_lighting_1', '28.80', '19.00', '00:19:21'),
(32, 'piggery_lighting_1', '28.80', '19.00', '00:19:24'),
(33, 'piggery_lighting_1', '28.80', '18.00', '00:19:27'),
(34, 'piggery_lighting_1', '28.70', '18.00', '00:19:30'),
(35, 'piggery_lighting_1', '28.70', '18.00', '00:19:33'),
(36, 'piggery_lighting_1', '28.70', '18.00', '00:19:36'),
(37, 'piggery_lighting_1', '28.80', '18.00', '00:19:39'),
(38, 'piggery_lighting_1', '28.80', '18.00', '00:19:42'),
(39, 'piggery_lighting_1', '28.80', '18.00', '00:19:45'),
(40, 'piggery_lighting_1', '28.80', '18.00', '00:19:48'),
(41, 'piggery_lighting_1', '28.80', '18.00', '00:19:51'),
(42, 'piggery_lighting_1', '28.80', '18.00', '00:19:54'),
(44, 'piggery_lighting_1', '28.60', '18.00', '00:20:00'),
(45, 'piggery_lighting_1', '28.70', '18.00', '00:20:03'),
(46, 'piggery_lighting_1', '28.60', '18.00', '00:20:06'),
(47, 'piggery_lighting_1', '28.70', '19.00', '00:20:09'),
(48, 'piggery_lighting_1', '28.70', '19.00', '00:20:12'),
(49, 'piggery_lighting_1', '28.70', '19.00', '00:20:15'),
(50, 'piggery_lighting_1', '28.70', '19.00', '00:20:18'),
(51, 'piggery_lighting_1', '28.70', '19.00', '00:20:21'),
(52, 'piggery_lighting_1', '28.70', '19.00', '00:20:24'),
(53, 'piggery_lighting_1', '28.70', '19.00', '00:20:27'),
(54, 'piggery_lighting_1', '28.70', '18.00', '00:20:30'),
(55, 'piggery_lighting_1', '28.70', '19.00', '00:20:33'),
(56, 'piggery_lighting_1', '28.70', '19.00', '00:20:36'),
(57, 'piggery_lighting_1', '28.70', '19.00', '00:20:39'),
(58, 'piggery_lighting_1', '28.70', '19.00', '00:20:42'),
(59, 'piggery_lighting_1', '28.70', '19.00', '00:20:45'),
(60, 'piggery_lighting_1', '28.70', '19.00', '00:20:48'),
(61, 'piggery_lighting_1', '28.70', '19.00', '00:20:51'),
(62, 'piggery_lighting_1', '28.60', '19.00', '00:20:54'),
(63, 'piggery_lighting_1', '28.70', '19.00', '00:20:57'),
(64, 'piggery_lighting_1', '28.60', '19.00', '00:21:00'),
(65, 'piggery_lighting_1', '28.70', '19.00', '00:21:03'),
(66, 'piggery_lighting_1', '28.70', '19.00', '00:21:06'),
(67, 'piggery_lighting_1', '28.70', '19.00', '00:21:09'),
(68, 'piggery_lighting_1', '28.70', '19.00', '00:21:12'),
(69, 'piggery_lighting_1', '28.70', '19.00', '00:21:15'),
(70, 'piggery_lighting_1', '28.70', '19.00', '00:21:18'),
(71, 'piggery_lighting_1', '28.70', '19.00', '00:21:21'),
(72, 'piggery_lighting_1', '28.70', '19.00', '00:21:24'),
(73, 'piggery_lighting_1', '28.70', '18.00', '00:21:27'),
(74, 'piggery_lighting_1', '28.50', '18.00', '00:21:30'),
(75, 'piggery_lighting_1', '28.70', '18.00', '00:21:33'),
(76, 'piggery_lighting_1', '28.70', '18.00', '00:21:36'),
(77, 'piggery_lighting_1', '28.70', '19.00', '00:21:39'),
(78, 'piggery_lighting_1', '28.70', '18.00', '00:21:42'),
(79, 'piggery_lighting_1', '29.00', '19.00', '00:21:45'),
(80, 'piggery_lighting_1', '28.80', '18.00', '00:21:48'),
(81, 'piggery_lighting_1', '28.60', '18.00', '00:21:51'),
(82, 'piggery_lighting_1', '28.80', '18.00', '00:21:54'),
(83, 'piggery_lighting_1', '28.90', '18.00', '00:21:57'),
(84, 'piggery_lighting_1', '28.80', '18.00', '00:22:00'),
(85, 'piggery_lighting_1', '28.90', '18.00', '00:22:03'),
(86, 'piggery_lighting_1', '28.90', '18.00', '00:22:06'),
(87, 'piggery_lighting_1', '28.80', '18.00', '00:22:09'),
(88, 'piggery_lighting_1', '28.90', '18.00', '00:22:12'),
(89, 'piggery_lighting_1', '29.20', '19.00', '00:22:15'),
(90, 'piggery_lighting_1', '29.00', '19.00', '00:22:18'),
(91, 'piggery_lighting_1', '29.00', '19.00', '00:22:21'),
(92, 'piggery_lighting_1', '29.00', '19.00', '00:22:24'),
(93, 'piggery_lighting_1', '29.00', '18.00', '00:22:27'),
(94, 'piggery_lighting_1', '29.10', '18.00', '00:22:30'),
(95, 'piggery_lighting_1', '29.10', '18.00', '00:22:33'),
(96, 'piggery_lighting_1', '29.00', '18.00', '00:22:36'),
(97, 'piggery_lighting_1', '29.10', '18.00', '00:22:39'),
(98, 'piggery_lighting_1', '29.10', '18.00', '00:22:42'),
(99, 'piggery_lighting_1', '29.00', '18.00', '00:22:45'),
(100, 'piggery_lighting_1', '29.20', '18.00', '00:22:48'),
(101, 'piggery_lighting_1', '29.20', '18.00', '00:22:51'),
(102, 'piggery_lighting_1', '29.20', '18.00', '00:22:54'),
(103, 'piggery_lighting_1', '29.20', '18.00', '00:22:57'),
(104, 'piggery_lighting_1', '29.20', '18.00', '00:23:00'),
(105, 'piggery_lighting_1', '29.20', '18.00', '00:23:03'),
(106, 'piggery_lighting_1', '29.20', '18.00', '00:23:06'),
(107, 'piggery_lighting_1', '29.20', '18.00', '00:23:09'),
(108, 'piggery_lighting_1', '29.20', '17.00', '00:23:12'),
(109, 'piggery_lighting_1', '29.20', '17.00', '00:23:15'),
(110, 'piggery_lighting_1', '29.30', '17.00', '00:23:18'),
(111, 'piggery_lighting_1', '29.30', '17.00', '00:23:21'),
(112, 'piggery_lighting_1', '29.20', '17.00', '00:23:24'),
(113, 'piggery_lighting_1', '29.20', '17.00', '00:23:27'),
(114, 'piggery_lighting_1', '29.20', '17.00', '00:23:30'),
(115, 'piggery_lighting_1', '29.30', '17.00', '00:23:33'),
(116, 'piggery_lighting_1', '29.20', '17.00', '00:23:36'),
(117, 'piggery_lighting_1', '29.30', '17.00', '00:23:39'),
(118, 'piggery_lighting_1', '29.30', '17.00', '00:23:42'),
(119, 'piggery_lighting_1', '29.40', '17.00', '00:23:45'),
(120, 'piggery_lighting_1', '29.30', '17.00', '00:23:48'),
(121, 'piggery_lighting_1', '29.30', '17.00', '00:23:51'),
(122, 'piggery_lighting_1', '29.30', '17.00', '00:23:54'),
(123, 'piggery_lighting_1', '29.30', '17.00', '00:23:57'),
(124, 'piggery_lighting_1', '29.30', '17.00', '00:24:00'),
(125, 'piggery_lighting_1', '29.30', '17.00', '00:24:03'),
(126, 'piggery_lighting_1', '29.40', '17.00', '00:24:06'),
(127, 'piggery_lighting_1', '29.30', '17.00', '00:24:09'),
(128, 'piggery_lighting_1', '29.30', '17.00', '00:24:12'),
(129, 'piggery_lighting_1', '29.20', '17.00', '00:24:15'),
(130, 'piggery_lighting_1', '29.30', '17.00', '00:24:18'),
(131, 'piggery_lighting_1', '29.30', '17.00', '00:24:21'),
(132, 'piggery_lighting_1', '29.40', '17.00', '00:24:24'),
(133, 'piggery_lighting_1', '29.40', '17.00', '00:24:27'),
(134, 'piggery_lighting_1', '29.30', '17.00', '00:24:30'),
(135, 'piggery_lighting_1', '29.30', '16.00', '00:24:33'),
(136, 'piggery_lighting_1', '29.30', '17.00', '00:24:36'),
(137, 'piggery_lighting_1', '29.50', '17.00', '00:24:39'),
(138, 'piggery_lighting_1', '29.40', '16.00', '00:24:42'),
(139, 'piggery_lighting_1', '29.40', '16.00', '00:24:45'),
(140, 'piggery_lighting_1', '29.50', '16.00', '00:24:48'),
(141, 'piggery_lighting_1', '29.40', '16.00', '00:24:51'),
(142, 'piggery_lighting_1', '29.40', '16.00', '00:24:54'),
(143, 'piggery_lighting_1', '29.40', '16.00', '00:24:57'),
(144, 'piggery_lighting_1', '29.40', '16.00', '00:25:00'),
(145, 'piggery_lighting_1', '29.50', '16.00', '00:25:03'),
(146, 'piggery_lighting_1', '29.50', '16.00', '00:25:06'),
(147, 'piggery_lighting_1', '29.40', '16.00', '00:25:09'),
(148, 'piggery_lighting_1', '29.50', '16.00', '00:25:12'),
(149, 'piggery_lighting_1', '29.50', '16.00', '00:25:15'),
(150, 'piggery_lighting_1', '29.50', '16.00', '00:25:18'),
(151, 'piggery_lighting_1', '29.50', '16.00', '00:25:21'),
(152, 'piggery_lighting_1', '29.50', '16.00', '00:25:24'),
(153, 'piggery_lighting_1', '29.50', '16.00', '00:25:27'),
(154, 'piggery_lighting_1', '29.50', '16.00', '00:25:30'),
(155, 'piggery_lighting_1', '29.50', '16.00', '00:25:33'),
(156, 'piggery_lighting_1', '29.50', '16.00', '00:25:36'),
(157, 'piggery_lighting_1', '29.30', '16.00', '00:25:39'),
(158, 'piggery_lighting_1', '29.50', '16.00', '00:25:42'),
(159, 'piggery_lighting_1', '29.50', '16.00', '00:25:45'),
(160, 'piggery_lighting_1', '29.50', '16.00', '00:25:48'),
(161, 'piggery_lighting_1', '29.50', '16.00', '00:25:51'),
(162, 'piggery_lighting_1', '29.50', '16.00', '00:25:54'),
(163, 'piggery_lighting_1', '29.50', '16.00', '00:25:57'),
(164, 'piggery_lighting_1', '29.50', '16.00', '00:26:00'),
(165, 'piggery_lighting_1', '29.50', '16.00', '00:26:03'),
(166, 'piggery_lighting_1', '29.40', '16.00', '00:26:06'),
(167, 'piggery_lighting_1', '29.50', '16.00', '00:26:09'),
(168, 'piggery_lighting_1', '29.50', '16.00', '00:26:12'),
(169, 'piggery_lighting_1', '29.50', '16.00', '00:26:15'),
(170, 'piggery_lighting_1', '29.50', '16.00', '00:26:18'),
(171, 'piggery_lighting_1', '29.40', '16.00', '00:26:21'),
(172, 'piggery_lighting_1', '29.70', '16.00', '00:26:24'),
(173, 'piggery_lighting_1', '29.50', '16.00', '00:26:27'),
(174, 'piggery_lighting_1', '29.50', '16.00', '00:26:30'),
(175, 'piggery_lighting_1', '29.50', '16.00', '00:26:33'),
(176, 'piggery_lighting_1', '29.50', '16.00', '00:26:36'),
(177, 'piggery_lighting_1', '29.50', '16.00', '00:26:39'),
(178, 'piggery_lighting_1', '29.50', '16.00', '00:26:42'),
(179, 'piggery_lighting_1', '29.70', '16.00', '00:26:45'),
(180, 'piggery_lighting_1', '29.70', '16.00', '00:26:48'),
(181, 'piggery_lighting_1', '29.70', '16.00', '00:26:51'),
(182, 'piggery_lighting_1', '29.60', '16.00', '00:26:54'),
(183, 'piggery_lighting_1', '29.60', '16.00', '00:26:57'),
(184, 'piggery_lighting_1', '29.50', '16.00', '00:27:00'),
(185, 'piggery_lighting_1', '29.50', '16.00', '00:27:03'),
(186, 'piggery_lighting_1', '29.50', '16.00', '00:27:06'),
(187, 'piggery_lighting_1', '29.50', '16.00', '00:27:09'),
(188, 'piggery_lighting_1', '29.60', '16.00', '00:27:12'),
(189, 'piggery_lighting_1', '29.60', '16.00', '00:27:15'),
(190, 'piggery_lighting_1', '29.50', '15.00', '00:27:18'),
(191, 'piggery_lighting_1', '29.50', '15.00', '00:27:21'),
(192, 'piggery_lighting_1', '29.50', '15.00', '00:27:24'),
(193, 'piggery_lighting_1', '29.30', '16.00', '00:27:27'),
(194, 'piggery_lighting_1', '29.40', '15.00', '00:27:30'),
(195, 'piggery_lighting_1', '29.30', '15.00', '00:27:33'),
(196, 'piggery_lighting_1', '29.40', '16.00', '00:27:36'),
(197, 'piggery_lighting_1', '29.20', '16.00', '00:27:39'),
(198, 'piggery_lighting_1', '29.30', '16.00', '00:27:42'),
(199, 'piggery_lighting_1', '29.30', '16.00', '00:27:45'),
(200, 'piggery_lighting_1', '29.30', '16.00', '00:27:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pins`
--

CREATE TABLE `tbl_pins` (
  `id` int(11) NOT NULL,
  `pin_name` varchar(128) NOT NULL,
  `pin_desc` varchar(128) NOT NULL,
  `pin_num` int(2) NOT NULL,
  `board_name` varchar(128) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pins`
--

INSERT INTO `tbl_pins` (`id`, `pin_name`, `pin_desc`, `pin_num`, `board_name`, `active`) VALUES
(661, 'default_name', 'default_desc', 0, 'piggery_lighting_1', 0),
(662, 'default_name', 'default_desc', 1, 'piggery_lighting_1', 0),
(663, 'default_name', 'default_desc', 2, 'piggery_lighting_1', 0),
(664, 'default_name', 'default_desc', 3, 'piggery_lighting_1', 0),
(665, 'default_name', 'default_desc', 4, 'piggery_lighting_1', 0),
(666, 'default_name', 'default_desc', 5, 'piggery_lighting_1', 0),
(667, 'default_name', 'default_desc', 6, 'piggery_lighting_1', 0),
(668, 'default_name', 'default_desc', 7, 'piggery_lighting_1', 0),
(669, 'default_name', 'default_desc', 8, 'piggery_lighting_1', 0),
(670, 'default_name', 'default_desc', 9, 'piggery_lighting_1', 1),
(671, 'default_name', 'default_desc', 10, 'piggery_lighting_1', 0),
(672, 'default_name', 'default_desc', 11, 'piggery_lighting_1', 0),
(673, 'default_name', 'default_desc', 12, 'piggery_lighting_1', 0),
(674, 'default_name', 'default_desc', 13, 'piggery_lighting_1', 0),
(675, 'default_name', 'default_desc', 14, 'piggery_lighting_1', 0),
(676, 'default_name', 'default_desc', 15, 'piggery_lighting_1', 0),
(677, 'default_name', 'default_desc', 16, 'piggery_lighting_1', 0),
(678, 'default_name', 'default_desc', 17, 'piggery_lighting_1', 0),
(679, 'default_name', 'default_desc', 18, 'piggery_lighting_1', 0),
(680, 'default_name', 'default_desc', 19, 'piggery_lighting_1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_servers`
--

CREATE TABLE `tbl_servers` (
  `id` int(11) NOT NULL,
  `server_name` varchar(128) NOT NULL,
  `server_desc` varchar(128) NOT NULL,
  `server_ip` varchar(16) NOT NULL,
  `server_location` varchar(128) NOT NULL,
  `server_timezone` varchar(128) NOT NULL,
  `htdocs_dir` varchar(128) NOT NULL,
  `conf_dir` varchar(128) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `_default` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_servers`
--

INSERT INTO `tbl_servers` (`id`, `server_name`, `server_desc`, `server_ip`, `server_location`, `server_timezone`, `htdocs_dir`, `conf_dir`, `active`, `_default`) VALUES
(23, 'home_san_pedro', '', '192.168.100.2', 'san pedro', 'Asia/Manila', 'C:\\xampp\\htdocs\\portty', 'C:\\xampp\\htdocs\\portty\\exe\\conf', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_switches`
--

CREATE TABLE `tbl_switches` (
  `id` int(11) NOT NULL,
  `pin_name` varchar(128) NOT NULL,
  `pin_desc` varchar(128) NOT NULL,
  `pin_num` int(2) NOT NULL,
  `board_name` varchar(128) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_switches`
--

INSERT INTO `tbl_switches` (`id`, `pin_name`, `pin_desc`, `pin_num`, `board_name`, `active`) VALUES
(111, 'default_name', 'default_desc', 0, 'board #1 lighting', 0),
(112, 'default_name', 'default_desc', 1, 'board #1 lighting', 0),
(113, 'default_name', 'default_desc', 2, 'board #1 lighting', 0),
(114, 'default_name', 'default_desc', 3, 'board #1 lighting', 0),
(115, 'default_name', 'default_desc', 4, 'board #1 lighting', 0),
(116, 'switch_feeding_motor', 'default_desc', 5, 'board #1 lighting', 0),
(117, 'default_name', 'default_desc', 6, 'board #1 lighting', 0),
(118, 'default_name', 'default_desc', 7, 'board #1 lighting', 0),
(119, 'default_name', 'default_desc', 8, 'board #1 lighting', 0),
(120, 'default_name', 'default_desc', 9, 'board #1 lighting', 0),
(121, 'default_name', 'default_desc', 10, 'board #1 lighting', 0),
(122, 'default_name', 'default_desc', 11, 'board #1 lighting', 0),
(123, 'default_name', 'default_desc', 12, 'board #1 lighting', 0),
(124, 'default_name', 'default_desc', 13, 'board #1 lighting', 0),
(125, 'default_name', 'default_desc', 14, 'board #1 lighting', 0),
(126, 'default_name', 'default_desc', 15, 'board #1 lighting', 0),
(127, 'default_name', 'default_desc', 16, 'board #1 lighting', 0),
(128, 'default_name', 'default_desc', 17, 'board #1 lighting', 0),
(129, 'default_name', 'default_desc', 18, 'board #1 lighting', 0),
(130, 'default_name', 'default_desc', 19, 'board #1 lighting', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_url`
--

CREATE TABLE `tbl_url` (
  `id` int(11) NOT NULL,
  `url` varchar(512) NOT NULL,
  `board_name` varchar(128) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `server_ip` varchar(64) NOT NULL,
  `response` varchar(128) NOT NULL,
  `pins` varchar(128) NOT NULL,
  `server_name` varchar(128) NOT NULL,
  `conf_dir` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_url`
--

INSERT INTO `tbl_url` (`id`, `url`, `board_name`, `active`, `server_ip`, `response`, `pins`, `server_name`, `conf_dir`) VALUES
(26, 'http://192.168.100.2/portty/api/?b=piggery_lighting_1&p=00000000010000000000&conf_dir=C:\\xampp\\htdocs\\portty\\exe\\conf', 'piggery_lighting_1', 0, '192.168.100.2', 'piggery_lighting_1,00:27:48,29.30,16.00,0ld7vcxm72c2g3yz', '00000000010000000000', 'home_san_pedro', 'C:\\xampp\\htdocs\\portty\\exe\\conf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_boards`
--
ALTER TABLE `tbl_boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_dht`
--
ALTER TABLE `tbl_dht`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pins`
--
ALTER TABLE `tbl_pins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_servers`
--
ALTER TABLE `tbl_servers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_switches`
--
ALTER TABLE `tbl_switches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_url`
--
ALTER TABLE `tbl_url`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_boards`
--
ALTER TABLE `tbl_boards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tbl_dht`
--
ALTER TABLE `tbl_dht`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `tbl_pins`
--
ALTER TABLE `tbl_pins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=681;

--
-- AUTO_INCREMENT for table `tbl_servers`
--
ALTER TABLE `tbl_servers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_switches`
--
ALTER TABLE `tbl_switches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `tbl_url`
--
ALTER TABLE `tbl_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
