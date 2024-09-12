-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 03:09 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dmcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `patientname` text NOT NULL,
  `medicine` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `time_purchased` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `patientname`, `medicine`, `amount`, `quantity`, `time_purchased`) VALUES
(1, 'Yort', 1, 0, 3, NULL),
(2, 'Yort', 1, 10, 2, NULL),
(3, 'teogan', 1, 10, 2, NULL),
(5, 'bron', 9, 20, 2, NULL),
(6, 'Wew', 0, 0, 5, NULL),
(7, 'Yort', 0, 0, 4, NULL),
(8, 'Yort', 39, 165, 5, NULL),
(9, 'bron', 40, 1364, 4, NULL),
(10, 'bron123', 2, 20, 1, NULL),
(11, 'bron', 3, 55, 2, NULL),
(12, 'bron', 73, 480, 1, NULL),
(13, 'omsim', 34, 792, 3, NULL),
(14, 'bron12', 68, 1391, 3, NULL),
(16, 'janna', 86, 136, 2, NULL),
(17, 'omsim', 72, 46, 3, NULL),
(18, 'bron', 4, 361, 2, NULL),
(19, 'bron', 41, 726, 4, '2023-02-27 12:09:29'),
(20, 'bron', 33, 1484, 2, '2023-02-27 12:24:25'),
(21, 'bron', 2, 40, 2, '2023-02-27 12:32:09'),
(22, 'omsim', 2, 60, 3, '2023-02-27 12:33:57'),
(23, 'bron', 73, 480, 1, '2023-02-27 12:34:30'),
(24, 'bron', 73, 480, 1, '2023-02-27 12:40:25'),
(25, 'bron', 79, 77, 2, '2023-02-27 12:47:51'),
(26, 'omsim', 73, 960, 2, '2023-02-27 13:07:02'),
(27, 'bron', 0, 0, 3, '2023-02-27 13:07:16'),
(28, 'bron123', 97, 253, 1, '2023-02-27 13:09:51'),
(29, 'bron123', 73, 1440, 3, '2023-02-27 13:10:06'),
(30, 'omsim', 217, 1910, 2, '2023-02-27 14:37:31'),
(31, 'omsim', 72, 31, 2, '2023-02-27 14:37:50'),
(32, 'bron', 71, 48, 1, '2023-02-27 14:38:24'),
(33, 'bron123', 2, 40, 2, '2023-02-27 14:39:05'),
(34, 'aerawr', 42, 75, 3, '2023-02-27 14:39:16'),
(35, 'ga', 77, 402, 3, '2023-02-27 14:39:30'),
(36, 'wew', 72, 31, 2, '2023-02-27 14:40:24'),
(37, 'omsim', 40, 682, 2, '2023-02-27 14:49:14'),
(38, 'bron', 41, 182, 1, '2023-02-27 15:02:35'),
(39, 'bron', 39, 99, 3, '2023-02-27 15:02:55'),
(40, 'bron', 38, 21, 1, '2023-02-27 15:05:34'),
(41, 'goku', 42, 75, 3, '2023-02-27 21:13:33'),
(42, 'goku', 70, 543, 2, '2023-02-27 21:13:49'),
(43, 'goku', 86, 203, 3, '2023-02-27 21:14:06'),
(44, 'aw', 42, 50, 2, '2023-02-28 05:49:35'),
(45, 'aw', 80, 578, 3, '2023-02-28 05:50:00'),
(46, 'awaw12', 36, 1672, 4, '2023-03-07 00:59:29'),
(47, 'awaw12', 74, 0, 2, '2023-03-07 01:01:05'),
(48, 'awaw12', 91, 128, 4, '2023-03-07 01:01:22'),
(49, 'goku', 3, 81, 3, '2023-03-07 01:14:37'),
(50, 'bron', 2, 240, 12, '2023-03-07 01:21:15'),
(51, 'wew', 72, 30, 2, '2023-03-07 01:22:45'),
(52, 'aw', 39, 33, 1, '2023-03-07 01:27:50'),
(53, 'aw', 39, 66, 2, '2023-03-07 01:28:03'),
(54, 'aw', 462, 90, 2, '2023-03-07 01:28:12'),
(55, 'yawi', 37, 412, 2, '2023-03-07 01:46:44'),
(56, 'yawi', 72, 45, 3, '2023-03-07 01:46:52'),
(57, 'yawi', 92, 40, 2, '2023-03-07 01:47:01'),
(58, '123', 39, 99, 3, '2023-03-07 01:50:03'),
(59, '123', 460, 110, 2, '2023-03-07 01:50:14'),
(60, 'wew', 42, 50, 2, '2023-03-07 01:50:49'),
(61, 'wew', 95, 75, 3, '2023-03-07 01:51:00'),
(62, 'jojo', 36, 836, 2, '2023-03-07 01:58:56'),
(63, 'jojo', 72, 45, 3, '2023-03-07 01:59:05'),
(64, 'jojo', 458, 86, 2, '2023-03-07 01:59:20'),
(65, 'yotrt', 48, 6, 1, '2023-03-07 02:17:04'),
(66, 'chou', 40, 682, 2, '2023-03-08 22:15:39'),
(67, 'chou', 462, 225, 5, '2023-03-08 22:15:52'),
(68, 'hanabi', 37, 412, 2, '2023-03-09 11:36:18'),
(69, 'hanabi', 69, 576, 2, '2023-03-09 11:36:27'),
(70, 'grook', 37, 618, 3, '2023-03-09 11:41:18'),
(71, 'grook', 90, 20, 2, '2023-03-09 11:41:28'),
(72, 'helos', 42, 50, 2, '2023-03-09 11:47:58'),
(73, 'helos', 71, 144, 3, '2023-03-09 11:48:20'),
(74, 'jedi', 38, 40, 2, '2023-03-11 10:13:08'),
(75, 'jedi', 73, 1440, 3, '2023-03-11 10:13:16'),
(76, 'jedi', 91, 96, 3, '2023-03-11 10:14:05'),
(77, 'tufo', 36, 1254, 3, '2023-03-11 10:18:11'),
(78, 'tufo', 462, 225, 5, '2023-03-11 10:18:21'),
(79, 'tufo', 136, 63, 3, '2023-03-11 10:18:30'),
(80, 'tufo', 146, 168, 3, '2023-03-11 10:18:39'),
(81, 'doge', 38, 60, 3, '2023-03-11 10:30:32'),
(82, 'doge', 42, 50, 2, '2023-03-11 10:30:42'),
(83, 'doge', 75, 0, 4, '2023-03-11 10:30:52'),
(84, 'doge', 71, 192, 4, '2023-03-11 10:31:05'),
(85, 'yamete', 38, 40, 2, '2023-03-11 16:19:06'),
(86, 'yamete', 86, 268, 4, '2023-03-11 16:19:15'),
(87, 'yamete', 135, 1014, 3, '2023-03-11 16:19:27'),
(88, 'yuzhong', 35, 29700, 90, '2023-03-11 17:51:02'),
(89, 'wanwan', 25, 31050, 90, '2023-03-11 18:03:57'),
(90, 'miya', 30, 43650, 90, '2023-03-11 18:06:23'),
(91, 'gloo', 27, 20700, 90, '2023-03-11 18:08:58'),
(92, 'zilong', 26, 4800, 10, '2023-03-11 18:14:10'),
(93, 'lapu', 22, 2700, 90, '2023-03-11 18:19:39'),
(94, 'lapu', 72, 45, 3, '2023-03-11 18:27:30'),
(95, 'estes', 32, 38070, 90, '2023-03-11 18:54:02'),
(96, 'moonton', 8, 540, 90, '2023-03-11 18:56:08'),
(97, 'cleaf', 14, 4590, 90, '2023-03-11 18:58:49'),
(98, 'jostar', 2, 40, 2, '2023-03-11 19:03:30'),
(99, 'jostar', 75, 0, 3, '2023-03-11 19:03:47'),
(100, 'jostar', 91, 64, 2, '2023-03-11 19:03:55'),
(101, 'jostar', 39, 132, 4, '2023-03-11 19:04:06'),
(102, 'atlaas', 12, 1980, 90, '2023-03-12 09:36:40'),
(103, 'zeus', 37, 412, 2, '2023-03-14 10:48:45'),
(104, 'zeus', 70, 813, 3, '2023-03-14 10:48:53'),
(105, 'zeus', 462, 135, 3, '2023-03-14 10:49:02'),
(106, 'yuru', 41, 362, 2, '2023-03-14 11:15:47'),
(107, 'yuru', 73, 960, 2, '2023-03-14 11:15:53'),
(108, 'yuru', 3, 81, 3, '2023-03-14 11:16:01'),
(109, 'viajel', 98, 272, 2, '2023-03-14 23:06:12'),
(110, 'viajel', 96, 456, 3, '2023-03-14 23:07:35'),
(111, 'delfino', 59, 208, 2, '2023-03-14 23:31:15'),
(112, 'Carene', 462, 225, 5, '2023-03-15 00:01:50'),
(113, 'Carene', 2, 40, 2, '2023-03-15 00:02:57'),
(114, 'yooy', 41, 543, 3, '2023-03-15 16:28:34'),
(115, 'yooy', 1, 267, 3, '2023-03-15 16:28:42'),
(116, 'yooy', 75, 0, 3, '2023-03-15 16:29:00'),
(117, 'bron', 0, 0, 3, '2023-03-16 20:45:27'),
(118, 'bron', 0, 0, 5, '2023-03-16 20:45:51'),
(119, 'bron123', 0, 0, 1, '2023-03-16 20:46:40'),
(120, 'Yort', 40, 1023, 3, '2023-03-16 20:48:56'),
(121, 'omsim', 74, 0, 2, '2023-03-16 20:51:41'),
(122, 'omsim', 37, 618, 3, '2023-03-16 20:52:03'),
(123, 'kadita', 91, 64, 2, '2023-03-16 20:57:26'),
(124, 'kadita', 75, 0, 3, '2023-03-16 20:57:59'),
(125, 'kadita', 68, 1389, 3, '2023-03-16 20:58:18'),
(126, 'uranus', 39, 99, 3, '2023-03-19 11:01:56'),
(127, 'uranus', 93, 102, 3, '2023-03-19 11:02:04'),
(128, 'uranus', 74, 0, 3, '2023-03-19 11:02:11'),
(129, 'bron', 209, 35, 1, '2023-04-14 02:05:07'),
(130, 'goku', 35, 660, 2, '2023-04-14 11:46:42'),
(131, 'goku', 68, 926, 2, '2023-04-14 11:46:49'),
(132, 'goku', 71, 144, 3, '2023-04-14 11:47:05'),
(133, 'awaw', 32, 846, 2, '2023-04-14 11:50:26'),
(134, 'awaw', 69, 576, 2, '2023-04-14 11:50:34'),
(135, 'rafa', 34, 528, 2, '2023-04-14 18:00:58'),
(136, 'rafa', 78, 144, 2, '2023-04-14 18:01:06'),
(137, 'brody', 39, 66, 2, '2023-04-17 16:12:41'),
(138, 'brody', 75, 0, 2, '2023-04-17 16:12:47'),
(139, 'brody', 72, 30, 2, '2023-04-17 16:12:57'),
(140, 'hulk', 2, 60, 3, '2023-04-17 20:05:06'),
(141, 'hulk', 95, 50, 2, '2023-04-17 20:05:17'),
(142, 'gaps', 10, 615, 3, '2023-04-18 14:17:38'),
(143, 'gaps', 90, 20, 2, '2023-04-18 14:17:47'),
(144, 'jezz commandante', 37, 412, 2, '2023-04-18 16:29:45'),
(145, 'jezz commandante', 36, 418, 1, '2023-04-18 16:31:30'),
(146, 'jezz commandante', 3, 81, 3, '2023-04-18 16:33:25'),
(147, 'jezz commandante', 462, 135, 3, '2023-04-18 16:33:36'),
(148, 'jezz commandante', 95, 50, 2, '2023-04-18 16:34:07'),
(149, 'aurora', 35, 660, 2, '2023-05-01 03:43:17'),
(150, 'aurora', 462, 135, 3, '2023-05-01 04:05:00'),
(151, 'www', 86, 134, 2, '2023-05-01 05:18:48'),
(152, 'www', 95, 50, 2, '2023-05-01 05:19:27'),
(153, 'www', 37, 412, 2, '2023-05-01 05:20:13'),
(154, 'wick', 39, 66, 2, '2023-05-01 14:32:24'),
(155, 'uranus', 38, 40, 2, '2023-05-01 21:24:55'),
(156, 'uranus', 0, 0, 2, '2023-05-01 21:26:58'),
(157, 'uranus', 37, 412, 2, '2023-05-01 21:27:13'),
(158, 'uranus', 2, 60, 3, '2023-05-01 21:27:56'),
(159, 'karrie', 80, 384, 2, '2023-05-01 22:01:06'),
(160, 'karrie', 100, 1078, 2, '2023-05-01 22:01:15'),
(161, 'shiko', 96, 304, 2, '2023-05-29 09:23:54'),
(162, 'shiko', 89, 108, 1, '2023-05-29 09:31:27'),
(163, 'ferfer', 3, 54, 2, '2023-05-29 09:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `medicine` varchar(36) DEFAULT NULL,
  `quantity` int(3) DEFAULT NULL,
  `unit_price` varchar(6) DEFAULT NULL,
  `type` enum('branded','generic') DEFAULT NULL,
  `description` varchar(10) DEFAULT NULL,
  `meds_date` datetime DEFAULT NULL,
  `medicine_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `medicine`, `quantity`, `unit_price`, `type`, `description`, `meds_date`, `medicine_status`) VALUES
(1, 'Alanerv Capsule', 7, '89.1', '', 'sadasdsads', '2023-03-06 21:47:06', 'updated'),
(2, 'Aldactone 25MG', 68, '20', '', '', '2023-03-06 21:47:06', 'updated'),
(3, 'Alduet Tablet', 0, '27.3', 'generic', '', '2023-03-06 21:47:06', 'updated'),
(4, 'Allerkid Drop', 98, '180.45', '', '', '2023-03-06 21:47:06', 'updated'),
(5, 'Allerkid Syrup 30ML', 9, '150.15', '', '', '2023-03-06 21:47:06', 'updated'),
(6, 'Allerkid Syrup 60ML', 100, '288.6', '', '', '2023-03-06 21:47:06', 'updated'),
(7, 'Allertene 4MG', 10, '22.105', '', '', '2023-03-06 21:47:06', 'updated'),
(8, 'Almefen 500MG', 10, '6.9', '', '', '2023-03-06 21:47:06', 'updated'),
(9, 'Almefen Suspension', 100, '110', '', '', '2023-03-06 21:47:06', 'updated'),
(10, 'Alnix Drops', 97, '205.15', '', '', '2023-03-06 21:47:06', 'updated'),
(11, 'Alnix Plus Syrup', 100, '306.35', '', '', '2023-03-06 21:47:06', 'updated'),
(12, 'Alnix Plus Tablet', 10, '22.85', '', '', '2023-03-06 21:47:06', 'updated'),
(13, 'Alsium Suspension 120ML', 100, '173.8', '', '', '2023-03-06 21:47:06', 'updated'),
(14, 'Altoclav 625MG', 10, '51.7', '', '', '2023-03-06 21:47:06', 'updated'),
(15, 'Amazar 5/50MG Tablet', 100, '14', '', '', '2023-03-06 21:47:06', 'updated'),
(16, 'Amoclav 228.5MG 70ML', 100, '20', '', '', '2023-03-06 21:47:06', 'updated'),
(17, 'Amoclav 457MG 35ML', 100, '279.6', '', '', '2023-03-06 21:47:06', 'updated'),
(18, 'Amoclav 457MG 70ML', 100, '438.65', '', '', '2023-03-06 21:47:06', 'updated'),
(19, 'Allerget', 100, '24.05', '', '', '2023-03-06 21:47:06', 'updated'),
(20, 'Alnix Syrup 30ML', 100, '178.35', '', '', '2023-03-06 21:47:06', 'updated'),
(21, 'Alnix Syrup 60ML', 100, '294.4', '', '', '2023-03-06 21:47:06', 'updated'),
(22, 'Alnix Tablet', 10, '30.3', '', '', '2023-03-06 21:47:06', 'updated'),
(23, 'Brightens (Lightening Lotion)', 10, '780', 'branded', '', '2023-04-18 11:33:45', 'updated'),
(24, 'Enhances (Gluta Power)', 100, '2680', 'generic', '', '2023-04-18 11:33:57', 'updated'),
(25, 'Freshens (Herbal Toothpaste)', 10, '345', 'generic', '', '2023-04-18 11:34:06', 'updated'),
(26, '(Lightening Cream)', 290, '480', 'branded', '', '2023-04-30 23:19:20', 'updated'),
(28, 'Restores (Night Repair Cream)', 100, '430', 'generic', '', '2023-04-18 11:34:25', 'updated'),
(29, 'Revives (Collagen Soap)', 10, '260', 'branded', '', '2023-04-18 11:34:34', 'updated'),
(30, 'Purifies (Clarifying Liquid Toner)', 100, '485', 'branded', '', '2023-04-18 11:34:15', 'updated'),
(31, 'Glucobest', 100, '1002.5', '', '', '2023-03-06 21:47:06', 'updated'),
(32, 'Acce Mac Suspension', 200, '423.5', 'branded', '', '2023-04-14 11:52:34', 'updated'),
(33, 'A1 110 400G', 10, '742.15', 'branded', '', '2023-05-02 08:45:31', 'updated'),
(34, 'Acefixime 100G 30ML', 195, '264', 'generic', '', '2023-04-18 11:35:12', 'updated'),
(35, 'Acefixime 100MG 60ML', 6, '330', 'branded', '', '2023-04-18 11:35:19', 'updated'),
(36, 'Acecef 60ML', 200, '418', 'generic', '', '2023-04-18 16:48:26', 'updated'),
(37, 'Acneed Soap', 82, '206.8', 'branded', '', '2023-04-18 11:35:30', 'updated'),
(38, 'Acresil 150MG', 8, '20.9', 'generic', '', '2023-04-18 11:35:46', 'updated'),
(39, 'Acresil 300MG', 80, '33', 'generic', '', '2023-04-18 11:35:57', 'updated'),
(40, 'Adnyst Drops', 8, '341', 'branded', '', '2023-04-18 11:36:14', 'updated'),
(41, 'Aezinc 120ML', 90, '181.5', '', '', '2023-03-06 21:47:06', 'updated'),
(42, 'Agravan', 86, '25', '', '', '2023-03-06 21:47:06', 'updated'),
(43, 'Ampimax 750MG', 100, '', '', '', '2023-03-06 21:47:06', 'updated'),
(44, 'Appetal Syrup 120ML', 100, '269.5', '', '', '2023-03-06 21:47:06', 'updated'),
(45, 'Ascortin 500MG', 100, '23.5', '', '', '2023-03-06 21:47:06', 'updated'),
(46, 'Aroled Syrup N60ML', 100, '253', '', '', '2023-03-06 21:47:06', 'updated'),
(47, 'Aroled Tablet', 100, '38.5', '', '', '2023-03-06 21:47:06', 'updated'),
(48, 'Ascortin 100MG', 99, '6.5', '', '', '2023-03-06 21:47:06', 'updated'),
(49, 'Asferon GF Syrup 60ML', 100, '111.1', '', '', '2023-03-06 21:47:06', 'updated'),
(50, 'Asferon GF Syrup 120ML', 100, '203.5', '', '', '2023-03-06 21:47:06', 'updated'),
(51, 'Asferon Syrup 60ML', 100, '91.3', '', '', '2023-03-06 21:47:06', 'updated'),
(52, 'Asmalin Brocho Syrup', 100, '', '', '', '2023-03-06 21:47:06', 'updated'),
(53, 'Asmalin Pulmoneb', 100, '28.5', '', '', '2023-03-06 21:47:06', 'updated'),
(54, 'Asmalin Syrup', 100, '', '', '', '2023-03-06 21:47:06', 'updated'),
(55, 'Asmavent Nebule', 100, '', '', '', '2023-03-06 21:47:06', 'updated'),
(56, 'Antenurix 20MG', 100, '14.9', '', '', '2023-03-06 21:47:06', 'updated'),
(57, 'Antenurix 40MG', 100, '23.3', '', '', '2023-03-06 21:47:06', 'updated'),
(58, 'Athero 10MG', 100, '19.8', '', '', '2023-03-06 21:47:06', 'updated'),
(59, 'AZA 500MG', 98, '104.5', '', '', '2023-03-06 21:47:06', 'updated'),
(60, 'Azcore 500MG', 100, '78.2', '', '', '2023-03-06 21:47:06', 'updated'),
(61, 'Azemax 500MG', 100, '', '', '', '2023-03-06 21:47:06', 'updated'),
(62, 'Aziboc 20MG', 100, '20', '', '', '2023-03-06 21:47:06', 'updated'),
(63, 'Aztrocin 500MG', 100, '104.5', '', '', '2023-03-06 21:47:06', 'updated'),
(64, 'Azihold 500MG', 100, '62.15', '', '', '2023-03-06 21:47:06', 'updated'),
(65, 'Azilo 500MG', 100, '99.5', '', '', '2023-03-06 21:47:06', 'updated'),
(66, 'Azro 500MG', 100, '70.4', '', '', '2023-03-06 21:47:06', 'updated'),
(67, 'Aztrocin 30ML', 100, '495', '', '', '2023-03-06 21:47:06', 'updated'),
(68, 'Bactifree 10G', 92, '463.73', '', '', '2023-03-06 21:47:06', 'updated'),
(69, 'Bactifree 5G', 96, '288.65', '', '', '2023-03-06 21:47:06', 'updated'),
(70, 'Bactrigon 5G', 95, '271.7', '', '', '2023-03-06 21:47:06', 'updated'),
(71, 'Bearse Tablet', 189, '48.4', '', '', '2023-03-06 21:47:06', 'updated'),
(72, 'BetaVit Tablet', 80, '15.45', '', '', '2023-03-06 21:47:06', 'updated'),
(73, 'Bethamistine Cream 15G', 87, '480', '', '', '2023-03-06 21:47:06', 'updated'),
(74, 'BetnoDerm Cream 5G', 93, '', '', '', '2023-03-06 21:47:06', 'updated'),
(75, 'Bifilac 500MG', 85, '', '', '', '2023-03-06 21:47:06', 'updated'),
(76, 'Bilaxten 20MG', 100, '29.1', '', '', '2023-03-06 21:47:06', 'updated'),
(77, 'Biogesic 250MG 60ML', 97, '133.95', '', '', '2023-03-06 21:47:06', 'updated'),
(78, 'Biogesic Drops', 98, '72.05', '', '', '2023-03-06 21:47:06', 'updated'),
(79, 'Biokult Capsule', 98, '38.5', '', '', '2023-03-06 21:47:06', 'updated'),
(80, 'Biotermin AS 120ML', 95, '192.5', '', '', '2023-03-06 21:47:06', 'updated'),
(81, 'Breecort 250MCG Nebule', 100, '95.75', '', '', '2023-03-06 21:47:06', 'updated'),
(82, 'Bronchofen Drops', 100, '111.4', '', '', '2023-03-06 21:47:06', 'updated'),
(83, 'Bronchofen Syrup', 100, '113.65', '', '', '2023-03-06 21:47:06', 'updated'),
(84, 'Bugshield Spray', 100, '195', '', '', '2023-03-06 21:47:06', 'updated'),
(85, 'C Zett 600MG', 100, '', '', '', '2023-03-06 21:47:06', 'updated'),
(86, 'C4 Kids Drops', 139, '67.8', '', '', '2023-03-06 21:47:06', 'updated'),
(87, 'C4 Kids With Zinc Syrup 120ML', 100, '140.8', '', '', '2023-03-06 21:47:06', 'updated'),
(88, 'C4 Kids Plain Syrup 120ML', 100, '121', '', '', '2023-03-06 21:47:06', 'updated'),
(89, 'Calazin Cream', 99, '108.9', '', '', '2023-03-06 21:47:06', 'updated'),
(90, 'Calciumade Tablet', 96, '10.05', '', '', '2023-03-06 21:47:06', 'updated'),
(91, 'Candez 16MG', 89, '32.95', '', '', '2023-03-06 21:47:06', 'updated'),
(92, 'Candez 8MG', 98, '20.95', '', '', '2023-03-06 21:47:06', 'updated'),
(93, 'Candez Plus', 97, '34', '', '', '2023-03-06 21:47:06', 'updated'),
(94, 'Canison Plus Cream', 100, '643.5', '', '', '2023-03-06 21:47:06', 'updated'),
(95, 'Caxin', 91, '25.5', '', '', '2023-03-06 21:47:06', 'updated'),
(96, 'Ceelin Chewable TABX 30S', 95, '152.15', '', '', '2023-03-06 21:47:06', 'updated'),
(97, 'Ceelin Chewable TABX 60S', 99, '252.8', '', '', '2023-03-06 21:47:06', 'updated'),
(98, 'Ceelin Drops 30ML', 98, '136.15', '', '', '2023-03-06 21:47:06', 'updated'),
(99, 'Ceelin Plus Syrup 120ML', 100, '153.8', '', '', '2023-03-06 21:47:06', 'updated'),
(100, 'Ceelin Plus Chewable TAB/100', 98, '539.4', '', '', '2023-03-06 21:47:06', 'updated'),
(101, 'Ceelin Plus Drops 30ML', 100, '157.65', '', '', '2023-03-06 21:47:06', 'updated'),
(102, 'Ceelin Syrup 120ML', 100, '127.7', '', '', '2023-03-06 21:47:06', 'updated'),
(103, 'Cefitrene 60ML', 100, '651.3', '', '', '2023-03-06 21:47:06', 'updated'),
(104, 'Cefitrene Drops', 100, '269.5', '', '', '2023-03-06 21:47:06', 'updated'),
(105, 'Ceftri Drops', 100, '269.5', '', '', '2023-03-06 21:47:06', 'updated'),
(106, 'Ceftri Suspension', 100, '544.5', '', '', '2023-03-06 21:47:06', 'updated'),
(107, 'Cefulax Drops', 100, '308', '', '', '2023-03-06 21:47:06', 'updated'),
(108, 'Cefuclav 250MG/62.5MG', 100, '553.3', '', '', '2023-03-06 21:47:06', 'updated'),
(109, 'Cefuclav 625MG', 100, '92.6', '', '', '2023-03-06 21:47:06', 'updated'),
(110, 'Cefulax Suspension', 100, '649', '', '', '2023-03-06 21:47:06', 'updated'),
(111, 'Celcoxx 200MG', 100, '30', '', '', '2023-03-06 21:47:06', 'updated'),
(112, 'Celcoxx 400MG', 100, '49.5', '', '', '2023-03-06 21:47:06', 'updated'),
(113, 'Ceraklin Bar 90G', 100, '231.8', '', '', '2023-03-06 21:47:06', 'updated'),
(114, 'Ceraklin Lotion', 100, '537.15', '', '', '2023-03-06 21:47:06', 'updated'),
(115, 'Celence 400MG', 100, '34.1', '', '', '2023-03-06 21:47:06', 'updated'),
(116, 'Chocovit Syrup', 100, '203.5', '', '', '2023-03-06 21:47:06', 'updated'),
(117, 'Cinazith 500MG', 100, '88', '', '', '2023-03-06 21:47:06', 'updated'),
(118, 'Cinazith DS Suspension', 100, '281.6', '', '', '2023-03-06 21:47:06', 'updated'),
(119, 'Clapidz 75MG', 100, '22', '', '', '2023-03-06 21:47:06', 'updated'),
(120, 'Clarithrocid 250MG 70ML', 100, '', '', '', '2023-03-06 21:47:06', 'updated'),
(121, 'Clarithrocid 250MG Tablet', 100, '', '', '', '2023-03-06 21:47:06', 'updated'),
(122, 'Clasi Flora', 100, '38.5', '', '', '2023-03-06 21:47:06', 'updated'),
(123, 'Climaxin 300MG', 100, '29.5', '', '', '2023-03-06 21:47:06', 'updated'),
(124, 'Clobenate 15G', 100, '495', '', '', '2023-03-06 21:47:06', 'updated'),
(125, 'Clobenate 5G', 100, '223.15', '', '', '2023-03-06 21:47:06', 'updated'),
(126, 'Cofmed Syrup', 100, '143', '', '', '2023-03-06 21:47:06', 'updated'),
(127, 'Cofmed Tablet', 100, '269.85', '', '', '2023-03-06 21:47:06', 'updated'),
(128, 'Cortizan Cream', 100, '269.85', '', '', '2023-03-06 21:47:06', 'updated'),
(129, 'Coxid 200MG', 100, '', '', '', '2023-03-06 21:47:06', 'updated'),
(130, 'Coxid 400MG', 100, '', '', '', '2023-03-06 21:47:06', 'updated'),
(131, 'Corvi Plus 60ML', 100, '159.5', '', '', '2023-03-06 21:47:06', 'updated'),
(132, 'D3 Intense', 100, '8.8', '', '', '2023-03-06 21:47:06', 'updated'),
(133, 'Dancef Ds 60ML', 100, '660', '', '', '2023-03-06 21:47:06', 'updated'),
(134, 'Dancoxib 200MG', 100, '33', '', '', '2023-03-06 21:47:06', 'updated'),
(135, 'Dandrex Anti-Dandruff Shampoo', 97, '338.8', '', '', '2023-03-06 21:47:06', 'updated'),
(136, 'Dazomet 500MG', 97, '21', '', '', '2023-03-06 21:47:06', 'updated'),
(137, 'Dense CT Hair Serum 50ML', 100, '948.5', '', '', '2023-03-06 21:47:06', 'updated'),
(138, 'Dense CT Hair Shampoo 200ML', 100, '356.4', '', '', '2023-03-06 21:47:06', 'updated'),
(139, 'Duvaprine Tablet', 100, '20.35', '', '', '2023-03-06 21:47:06', 'updated'),
(140, 'E Zinc Drops', 100, '98.85', '', '', '2023-03-06 21:47:06', 'updated'),
(141, 'E Zinc Syrup', 100, '105.35', '', '', '2023-03-06 21:47:06', 'updated'),
(142, 'Eczacort Cream', 100, '345.25', '', '', '2023-03-06 21:47:06', 'updated'),
(143, 'Eczekleen Replenishing Cream 75G', 100, '462', '', '', '2023-03-06 21:47:06', 'updated'),
(144, 'Efamed Plus Syrup', 100, '82.5', '', '', '2023-03-06 21:47:06', 'updated'),
(145, 'Efamed Plus Tablet', 100, '4.4', '', '', '2023-03-06 21:47:06', 'updated'),
(146, 'Efamed Plain 60ML', 97, '56', '', '', '2023-03-06 21:47:06', 'updated'),
(147, 'Elidel 1% Cream', 100, '1,100', '', '', '2023-03-06 21:47:06', 'updated'),
(148, 'Emolkleen Liquid Cleanser', 100, '227.7', '', '', '2023-03-06 21:47:06', 'updated'),
(149, 'Emolkleen Soap', 100, '225.5', '', '', '2023-03-06 21:47:06', 'updated'),
(150, 'Endwarts freeze', 100, '726', '', '', '2023-03-06 21:47:06', 'updated'),
(151, 'Ener A Plus Drops 30ML', 100, '178.2', '', '', '2023-03-06 21:47:06', 'updated'),
(152, 'Ener A Plus Syrup 120ML', 100, '221.5', '', '', '2023-03-06 21:47:06', 'updated'),
(153, 'Enfacare Sachet', 100, '27.5', '', '', '2023-03-06 21:47:06', 'updated'),
(154, 'Estogen 40MG', 100, '50.5', '', '', '2023-03-06 21:47:06', 'updated'),
(155, 'Exflem 200MG', 100, '17.4', '', '', '2023-03-06 21:47:06', 'updated'),
(156, 'Exflem 600MG', 100, '', '', '', '2023-03-06 21:47:06', 'updated'),
(157, 'Exigo 16MG', 100, '47.45', '', '', '2023-03-06 21:47:06', 'updated'),
(158, 'Exigo 8MG', 100, '34.95', '', '', '2023-03-06 21:47:06', 'updated'),
(159, 'Dermpibac 5G', 100, '308', '', '', '2023-03-06 21:47:06', 'updated'),
(160, 'Diafeno', 100, '37', '', '', '2023-03-06 21:47:06', 'updated'),
(161, 'Difluvid 150MG', 100, '344.5', '', '', '2023-03-06 21:47:06', 'updated'),
(162, 'Difluzol 150MG', 100, '203.5', '', '', '2023-03-06 21:47:06', 'updated'),
(163, 'Dilfur Suspension', 100, '330', '', '', '2023-03-06 21:47:06', 'updated'),
(164, 'Dilfur Tablet', 100, '39.55', '', '', '2023-03-06 21:47:06', 'updated'),
(165, 'Dimezine 40/20MG', 100, '21.35', '', '', '2023-03-06 21:47:06', 'updated'),
(166, 'Disoflem 500MG', 100, '9.35', '', '', '2023-03-06 21:47:06', 'updated'),
(167, 'Disudrin Drops', 100, '118.35', '', '', '2023-03-06 21:47:06', 'updated'),
(168, 'Disudrin Syrup 60ML', 100, '120.5', '', '', '2023-03-06 21:47:06', 'updated'),
(169, 'Dizoflox Ear drops', 100, '283.8', '', '', '2023-03-06 21:47:06', 'updated'),
(170, 'Dolan 200MG 60ML', 100, '151.5', '', '', '2023-03-06 21:47:06', 'updated'),
(171, 'Dolan Drops', 100, '88.4', '', '', '2023-03-06 21:47:06', 'updated'),
(172, 'Dolowin Plus', 100, '22.5', '', '', '2023-03-06 21:47:06', 'updated'),
(173, 'Domilium Tab', 100, '11', '', '', '2023-03-06 21:47:06', 'updated'),
(174, 'Dolvitab', 100, '22', '', '', '2023-03-06 21:47:06', 'updated'),
(175, 'Dotilium 10MG', 100, '14.3', '', '', '2023-03-06 21:47:06', 'updated'),
(176, 'Doxyclir 400MG', 100, '21.75', '', '', '2023-03-06 21:47:06', 'updated'),
(177, 'Droxzine 10MG', 100, '19.8', '', '', '2023-03-06 21:47:06', 'updated'),
(178, 'Duavent Nebule', 100, '45.9', '', '', '2023-03-06 21:47:06', 'updated'),
(179, 'Ducid Sachet', 100, '20.25', '', '', '2023-03-06 21:47:06', 'updated'),
(180, 'Fasfec 400MG', 100, '26.7', '', '', '2023-03-06 21:47:06', 'updated'),
(181, 'Fauna Plus', 100, '38.5', '', '', '2023-03-06 21:47:06', 'updated'),
(182, 'Fenoflex 160MG', 100, '40.25', '', '', '2023-03-06 21:47:06', 'updated'),
(183, 'Fenogal 160MG', 100, '40.5', '', '', '2023-03-06 21:47:06', 'updated'),
(184, 'Fenostat 10MG/160MG', 100, '25.2', '', '', '2023-03-06 21:47:06', 'updated'),
(185, 'Ferlin Drops', 100, '141.2', '', '', '2023-03-06 21:47:06', 'updated'),
(186, 'Ferlin Syrup 120ML', 100, '328.7', '', '', '2023-03-06 21:47:06', 'updated'),
(187, 'Fevcet', 100, '23.65', '', '', '2023-03-06 21:47:06', 'updated'),
(188, 'Finarid 5MG', 100, '27.5', '', '', '2023-03-06 21:47:06', 'updated'),
(189, 'Fixim 200MG', 100, '93.5', '', '', '2023-03-06 21:47:06', 'updated'),
(190, 'Flo 15ML ', 100, '759.5', '', '', '2023-03-06 21:47:06', 'updated'),
(191, 'Flotera 90MG/5ML Drops', 100, '', '', '', '2023-03-06 21:47:06', 'updated'),
(192, 'Flotera Chewable', 100, '34.55', '', '', '2023-03-06 21:47:06', 'updated'),
(193, 'Flotera Minipack', 100, '36.35', '', '', '2023-03-06 21:47:06', 'updated'),
(194, 'Floxel 500MG', 100, '200.6', '', '', '2023-03-06 21:47:06', 'updated'),
(195, 'Foliage Plus', 100, '8.75', '', '', '2023-03-06 21:47:06', 'updated'),
(196, 'Fluimucil 100MG', 100, '13.35', '', '', '2023-03-06 21:47:06', 'updated'),
(197, 'Fluimucil 100MG/100ML', 100, '', '', '', '2023-03-06 21:47:06', 'updated'),
(198, 'Fluimucil 200MG', 100, '17.5', '', '', '2023-03-06 21:47:06', 'updated'),
(199, 'Fluimucil 600MG', 100, '38.4', '', '', '2023-03-06 21:47:06', 'updated'),
(200, 'Flutizal 25/125MCG', 100, '431.2', '', '', '2023-03-06 21:47:06', 'updated'),
(201, 'Flutizal 25/250MCG', 100, '640.45', '', '', '2023-03-06 21:47:06', 'updated'),
(202, 'Folart Oral Drops', 100, '143', '', '', '2023-03-06 21:47:06', 'updated'),
(203, 'Folart Syrup 60ML', 100, '143', '', '', '2023-03-06 21:47:06', 'updated'),
(204, 'Folart Syrup 120ML', 100, '226.6', '', '', '2023-03-06 21:47:06', 'updated'),
(205, 'Fortifer FA', 100, '15.4', '', '', '2023-03-06 21:47:06', 'updated'),
(206, 'Fungkleen Soap', 100, '206.8', '', '', '2023-03-06 21:47:06', 'updated'),
(207, 'Furomid 40MG', 100, '5.5', '', '', '2023-03-06 21:47:06', 'updated'),
(208, 'Gabica 75MG', 100, '33', '', '', '2023-03-06 21:47:06', 'updated'),
(209, 'Gabix 100MG', 99, '35.2', '', '', '2023-03-06 21:47:06', 'updated'),
(210, 'Gabix 300MG ', 100, '38.6', '', '', '2023-03-06 21:47:06', 'updated'),
(211, 'Geofer', 100, '14.85', '', '', '2023-03-06 21:47:06', 'updated'),
(212, 'Gestivia Capsule', 100, '29.9', '', '', '2023-03-06 21:47:06', 'updated'),
(213, 'Gestivia Sachet', 100, '29.9', '', '', '2023-03-06 21:47:06', 'updated'),
(214, 'Geworin 300/150/50MG', 100, '11', '', '', '2023-03-06 21:47:06', 'updated'),
(215, 'GI Protech 1+', 100, '', '', '', '2023-03-06 21:47:06', 'updated'),
(216, 'GI Protech 7+', 100, '', '', '', '2023-03-06 21:47:06', 'updated'),
(217, 'Glucobest', 98, '954.75', '', '', '2023-03-06 21:47:06', 'updated'),
(218, 'Glycokleen Soap', 100, '206.8', '', '', '2023-03-06 21:47:06', 'updated'),
(219, 'Goxib 200MG', 100, '27.5', '', '', '2023-03-06 21:47:06', 'updated'),
(220, 'Growee Drops', 100, '88.6', '', '', '2023-03-06 21:47:06', 'updated'),
(221, 'Growee Syrup 120ML', 100, '173.15', '', '', '2023-03-06 21:47:06', 'updated'),
(222, 'Gutskin Capsule', 100, '53.9', '', '', '2023-03-06 21:47:06', 'updated'),
(223, 'Haemorix 500MG', 100, '19.8', '', '', '2023-03-06 21:47:06', 'updated'),
(224, 'H One 30ML Syrup', 100, '142', '', '', '2023-03-06 21:47:06', 'updated'),
(225, 'H One 60ML Syrup', 100, '255.2', '', '', '2023-03-06 21:47:06', 'updated'),
(226, 'H One Drops', 100, '133.2', '', '', '2023-03-06 21:47:06', 'updated'),
(227, 'H One Tablet', 100, '18.7', '', '', '2023-03-06 21:47:06', 'updated'),
(458, 'neozep', 8, '43', 'branded', '', '2023-03-06 21:47:06', 'updated'),
(460, 'ritemed', 53, '55', 'branded', 'awawawaw', '2023-03-06 21:47:06', 'updated'),
(462, 'bioflu', 174, '45', 'generic', '', '2023-03-06 23:03:12', 'updated'),
(463, 'omeprazole', 55, '11', 'branded', '', '2023-03-07 00:37:30', 'updated'),
(464, 'luperamide', 100, '55', 'branded', '', '2023-03-08 10:17:03', 'added'),
(466, 'diatabs', 100, '122', 'generic', '', '2023-03-19 17:02:40', 'added'),
(467, 'unilab', 100, '50', 'generic', '', '2023-03-19 22:34:26', 'added');

-- --------------------------------------------------------

--
-- Table structure for table `purchased_session`
--

CREATE TABLE `purchased_session` (
  `session_id` int(11) NOT NULL,
  `session_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchased_session`
--

INSERT INTO `purchased_session` (`session_id`, `session_date`) VALUES
(1, '2023-02-27 12:56:33'),
(2, '2023-02-27 13:07:02'),
(3, '2023-02-27 13:09:50'),
(4, '2023-02-27 14:37:31'),
(5, '2023-02-27 14:38:24'),
(6, '2023-02-27 14:40:23'),
(7, '2023-02-27 15:02:35'),
(8, '2023-02-27 15:05:34'),
(9, '2023-02-27 21:13:32'),
(10, '2023-02-28 05:49:35'),
(11, '2023-03-07 00:59:29'),
(12, '2023-03-07 01:14:37'),
(13, '2023-03-07 01:21:15'),
(14, '2023-03-07 01:22:45'),
(15, '2023-03-07 01:27:49'),
(16, '2023-03-07 01:46:44'),
(17, '2023-03-07 01:50:03'),
(18, '2023-03-07 01:50:49'),
(19, '2023-03-07 01:58:56'),
(20, '2023-03-07 02:17:03'),
(21, '2023-03-08 22:15:39'),
(22, '2023-03-09 11:36:18'),
(23, '2023-03-09 11:41:18'),
(24, '2023-03-09 11:47:58'),
(25, '2023-03-11 10:13:08'),
(26, '2023-03-11 10:18:10'),
(27, '2023-03-11 10:30:32'),
(28, '2023-03-11 16:19:06'),
(29, '2023-03-11 17:51:02'),
(30, '2023-03-11 18:03:57'),
(31, '2023-03-11 18:06:22'),
(32, '2023-03-11 18:08:58'),
(33, '2023-03-11 18:14:10'),
(34, '2023-03-11 18:19:38'),
(35, '2023-03-11 18:54:02'),
(36, '2023-03-11 18:56:08'),
(37, '2023-03-11 18:58:49'),
(38, '2023-03-11 19:03:30'),
(39, '2023-03-12 09:36:40'),
(40, '2023-03-14 10:48:45'),
(41, '2023-03-14 11:15:47'),
(42, '2023-03-14 23:06:12'),
(43, '2023-03-14 23:31:15'),
(44, '2023-03-15 00:01:50'),
(45, '2023-03-15 16:28:34'),
(46, '2023-03-16 20:45:27'),
(47, '2023-03-16 20:46:40'),
(48, '2023-03-16 20:48:56'),
(49, '2023-03-16 20:51:41'),
(50, '2023-03-16 20:57:26'),
(51, '2023-03-19 11:01:56'),
(52, '2023-04-14 02:05:06'),
(53, '2023-04-14 11:46:42'),
(54, '2023-04-14 11:50:26'),
(55, '2023-04-14 18:00:58'),
(56, '2023-04-17 16:12:40'),
(57, '2023-04-17 20:05:05'),
(58, '2023-04-18 14:17:38'),
(59, '2023-04-18 16:29:45'),
(60, '2023-05-01 03:43:17'),
(61, '2023-05-01 05:20:13'),
(62, '2023-05-01 14:32:24'),
(63, '2023-05-01 21:24:55'),
(64, '2023-05-01 21:26:58'),
(65, '2023-05-01 22:01:06'),
(66, '2023-05-29 09:31:27'),
(67, '2023-05-29 09:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `patient` text NOT NULL,
  `date` date NOT NULL,
  `time_sched` text NOT NULL,
  `service` text NOT NULL,
  `contact_sched` text NOT NULL,
  `status` text NOT NULL,
  `notify_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `patient`, `date`, `time_sched`, `service`, `contact_sched`, `status`, `notify_status`) VALUES
(60, 'patient1 none', '2023-05-09', '2:00 pm', 'consult', '091233454', 'pending', ''),
(61, 'bronny Loonie', '2023-05-19', '02:00 PM', 'consult', '09877775344', 'pending', ''),
(62, 'bronny lebron', '2023-05-20', '02:00 PM', 'consult', '09453865394', 'cancel', 'read'),
(63, 'john Leonades', '2023-05-22', '02:00 PM', 'consult', '09453865394', 'cancel', ''),
(64, 'john Leonades', '2023-05-23', '01:30 PM', 'consult', '09453865394', 'approve', 'read'),
(66, 'bronny lebron', '2023-06-01', '02:30 PM', 'consult', '09453865394', 'approve', 'read'),
(70, 'john Leonades', '2023-05-31', '02:00 PM', 'consult', '09453865394', 'approve', 'read'),
(71, 'yuru ken', '2023-05-22', '02:30 PM', 'consult', '09453865394', 'approve', 'read'),
(72, 'bronny lebron', '2023-05-24', '02:30 PM', 'consult', '', 'cancel', 'read'),
(74, 'bronny lebron', '2023-05-11', '03:30 PM', 'dental', '09453865394', 'approve', 'new'),
(77, 'yuru ken', '2023-06-09', '03:30 PM', 'sds', '121212', 'approve', 'new'),
(78, 'john Leonades', '2023-06-01', '02:30 PM', 'wewew', '09453865394', 'approve', 'new'),
(79, 'bronny lebron', '2023-06-10', '02:00 PM', 'sadsad', '09453865394', 'pending', ''),
(80, 'yuru ken', '2023-06-09', '02:00 PM', 'consult', '09453865394', 'pending', ''),
(91, 'yuru ken', '2023-06-08', '02:00 PM', 'sds', '09453865394', 'pending', ''),
(99, 'bronny lebron', '2023-06-15', '03:30 PM', 'awaw', '09453865394', 'approve', 'new'),
(100, 'Van Van', '2023-06-14', '02:30 PM', 'consult', '09453865394', 'approve', 'read');

-- --------------------------------------------------------

--
-- Table structure for table `upcoming_qty`
--

CREATE TABLE `upcoming_qty` (
  `id` int(11) NOT NULL,
  `med_id` int(11) NOT NULL,
  `remaining_qty` int(11) NOT NULL,
  `upcome_qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upcoming_qty`
--

INSERT INTO `upcoming_qty` (`id`, `med_id`, `remaining_qty`, `upcome_qty`, `total`, `date_added`) VALUES
(1, 34, 95, 100, 195, '2023-05-04 22:33:19'),
(2, 71, 89, 100, 189, '2023-05-05 10:53:54'),
(3, 86, 89, 50, 139, '2023-05-07 10:43:49'),
(4, 462, 74, 100, 174, '2023-05-09 18:29:59'),
(5, 32, 100, 100, 200, '2023-05-09 18:34:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `prof_img` text NOT NULL,
  `age` text NOT NULL,
  `gender` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `address` text NOT NULL,
  `usertype` text NOT NULL,
  `user_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `prof_img`, `age`, `gender`, `username`, `password`, `address`, `usertype`, `user_status`) VALUES
(3, 'bron', 'joe', '', '12', 'male', 'bron123@yahoo.com', '123', 'Caloocan Boulv.', 'admin', ''),
(4, 'john', 'Leonades', '67827640_2368955946725423_2445611918019264512_o.jpg', '21', 'male', 'bron123', '1234', 'MGY USA CALI', 'user', ''),
(10, 'noel', 'admin', '', '', 'male', 'killua@gmail.com', 'admin', 'MGY USA CALI 123', 'admin', ''),
(11, 'Maria', 'Dimaano', '', '21', 'male', 'bron123@yahoo.com', 'admin', 'MGY USA CALI', 'admin', ''),
(13, 'era', 'awaw', '', '22', '', 'saiyan@gmail.com', '1212', 'castillo', 'admin', ''),
(14, 'goku', 'uyy', '', '22', 'male', 'goku123@gmail.com', '1212', 'Caloocan Boulv.', 'admin', ''),
(15, 'viajel', 'burikat', '', '23', 'female', 'viajel.burikat@gmail.com', 'burikat', 'Tabon, Bislig City', 'admin', ''),
(16, 'Cristty', 'Cunanan', '', '', 'female', 'Cristy@gmail.com', 'admin', 'tinuy-an', 'admin', ''),
(17, 'Carene', 'Cunanan', '', '23', 'female', 'CareneCunanan@gmail.com', 'Burikat', 'Sug-ubon', 'admin', ''),
(18, 'Doctora', 'awaw', '', '', 'Female', 'admin', 'admin', '', 'admin', ''),
(19, 'bronny', 'lebron', 'picsa_1529381152805.jpg', '', 'Male', 'Lebron123', '1212', 'P7 Gordonas', 'user', ''),
(20, 'patient1', 'none', '', '', '', 'user', 'user', '', 'user', ''),
(21, 'yuru', 'ken', 'books.png', '', 'female', 'yuru122', 'user', '', 'user', ''),
(22, 'awaw', 'aww', '', '', '', 'bron', 'aw', '', 'admin', ''),
(23, 'admin', 'delfin', '', '', '', 'wax', 'wax', '', 'user', ''),
(24, 'Van', 'Van', '', '', 'Male', 'vanvan', '123', 'P5 Castill Village MGY', 'user', ''),
(25, 'jamae', 'bads', '', '1212', '22', 'jamea', 'P7 Gordonas Village', 'male', 'user', ''),
(26, 'ant', 'man', '', '32', 'male', 'antman', '123', 'USA', '', ''),
(27, 'Sel', 'Almoranas', '', '22', 'female', 'sel123', '1212', 'P5 Castillo', 'user', 'approved'),
(28, 'Shella', 'Morre', '', '21', 'female', 'shella12', '123', 'P7 Gordonas Vill', 'staff', 'approved'),
(29, 'rena', 'amoyo', '', '21', 'female', 'rena123', '123', 'P9 Union Site ', 'staff', 'pending'),
(30, 'josh', 'collins', '', '21', 'male', 'josh123', '123', 'P5 Castillo Village MGY', 'user', 'approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchased_session`
--
ALTER TABLE `purchased_session`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upcoming_qty`
--
ALTER TABLE `upcoming_qty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=468;

--
-- AUTO_INCREMENT for table `purchased_session`
--
ALTER TABLE `purchased_session`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `upcoming_qty`
--
ALTER TABLE `upcoming_qty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
