-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2021 at 06:21 AM
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
  `name` varchar(128) NOT NULL,
  `desc0` varchar(128) NOT NULL,
  `boardtype` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_switches`
--

CREATE TABLE `tbl_switches` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `desc0` varchar(128) NOT NULL,
  `pin_num` int(2) NOT NULL,
  `board_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_webservers`
--

CREATE TABLE `tbl_webservers` (
  `id` int(11) NOT NULL,
  `server_name` varchar(128) NOT NULL,
  `server_desc` varchar(128) NOT NULL,
  `server_ip` varchar(16) NOT NULL,
  `server_location` varchar(128) NOT NULL,
  `server_timezone` varchar(128) NOT NULL,
  `htdocs_dir` varchar(128) NOT NULL,
  `conf_dir` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_webservers`
--

INSERT INTO `tbl_webservers` (`id`, `server_name`, `server_desc`, `server_ip`, `server_location`, `server_timezone`, `htdocs_dir`, `conf_dir`) VALUES
(7, 'alcatraz', 'my home', '192.168.100.100', 'san pedro', '+3', 'c:xampphtdocs', 'c:	mpconf'),
(8, 'alcatraz2', 'my home3', '192.168.100.101', 'san pedro', '+3', 'c:\\xampp\\htdocs', 'c:\\tmp\\conf\\');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_boards`
--
ALTER TABLE `tbl_boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_switches`
--
ALTER TABLE `tbl_switches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_webservers`
--
ALTER TABLE `tbl_webservers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_boards`
--
ALTER TABLE `tbl_boards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_switches`
--
ALTER TABLE `tbl_switches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_webservers`
--
ALTER TABLE `tbl_webservers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
