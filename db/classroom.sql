-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 08:15 PM
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
-- Database: `techlab`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `d_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `d_name`) VALUES
(1, 'CS'),
(2, 'IT'),
(3, 'E&TC'),
(4, 'MECH'),
(5, 'EL');

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `e_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL DEFAULT 0,
  `ip` varchar(100) NOT NULL,
  `in_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `out_time` timestamp NULL DEFAULT NULL,
  `isAttended` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`e_id`, `user_id`, `lab_id`, `ip`, `in_time`, `out_time`, `isAttended`) VALUES
(2, 33, 1, '192.168.0.1', '2024-01-26 02:30:00', '2024-01-26 11:30:00', 0),
(3, 33, 10, '192.168.0.2', '2024-01-27 04:00:00', '2024-01-27 13:15:00', 0),
(4, 9, 10, '127.0.0.1', '2024-02-03 12:06:49', '2024-02-03 13:00:00', 1),
(6, 1, 0, '119.176.54.228', '2020-08-15 20:31:24', '2020-08-15 20:31:24', 0),
(7, 9, 0, '38.106.62.133', '2023-02-05 14:18:47', '2023-02-05 14:55:00', 0),
(8, 1, 0, '51.171.144.222', '2023-06-27 12:25:15', '2023-06-27 16:33:07', 0),
(9, 9, 0, '4.14.224.110', '2020-03-07 00:46:21', '2020-03-07 00:47:09', 0),
(10, 1, 0, '47.181.45.0', '2021-05-08 06:40:59', '2021-05-08 08:11:10', 0),
(11, 1, 0, '50.10.64.44', '2023-02-20 03:01:29', '2023-02-20 04:39:31', 0),
(12, 9, 0, '48.173.115.198', '2023-01-02 06:16:32', '2023-01-02 07:17:07', 0),
(13, 9, 0, '13.207.222.153', '2022-01-08 17:31:31', '2022-01-08 17:32:25', 0),
(14, 11, 0, '35.145.5.96', '2021-05-08 00:16:15', '2021-05-08 15:06:29', 0),
(15, 1, 0, '101.59.7.144', '2022-05-04 11:49:48', '2022-05-04 13:51:55', 0),
(16, 11, 0, '98.51.136.3', '2021-05-27 22:05:05', '2021-05-28 02:35:04', 0),
(17, 9, 0, '86.72.174.48', '2023-11-04 01:33:59', '2023-11-04 03:38:36', 0),
(18, 1, 0, '90.119.101.16', '2022-01-12 20:17:02', '2022-01-13 00:45:35', 0),
(19, 11, 0, '114.41.62.254', '2023-12-19 23:12:09', '2023-12-20 15:50:43', 0),
(20, 11, 0, '52.31.105.177', '2023-03-01 03:29:03', '2023-03-01 12:37:28', 0),
(21, 1, 0, '14.134.148.201', '2023-07-29 02:23:21', '2023-07-29 06:21:18', 0),
(22, 9, 0, '57.163.2.208', '2024-01-28 00:34:15', '2024-01-28 09:15:26', 0),
(23, 1, 0, '108.165.109.59', '2021-11-03 13:03:18', '2021-11-03 18:16:12', 0),
(24, 1, 0, '75.154.121.138', '2023-03-18 18:05:43', '2023-03-18 18:17:23', 0),
(25, 9, 0, '49.253.223.194', '2021-01-21 16:13:31', '2021-01-21 18:13:43', 0),
(26, 1, 0, '93.247.163.166', '2023-07-29 18:37:05', '2023-07-29 20:24:39', 0),
(27, 1, 0, '42.233.116.189', '2023-04-27 20:46:01', '2023-04-28 14:54:08', 0),
(28, 1, 0, '30.16.132.131', '2020-07-01 19:20:32', '2020-07-02 17:00:33', 0),
(29, 9, 0, '12.185.179.96', '2023-09-27 21:07:09', '2023-09-28 17:51:07', 0),
(30, 11, 0, '17.163.103.227', '2021-11-15 08:54:28', '2021-11-15 09:27:10', 0),
(31, 1, 0, '48.3.161.28', '2021-12-04 10:39:42', '2021-12-04 11:13:30', 0),
(32, 9, 0, '70.123.99.242', '2023-09-10 17:03:49', '2023-09-10 18:06:19', 0),
(33, 11, 0, '68.188.20.16', '2022-08-08 16:17:23', '2022-08-08 18:21:53', 0),
(34, 11, 0, '85.168.30.190', '2024-01-30 08:53:46', '2024-01-30 09:29:25', 0),
(35, 11, 0, '79.100.242.91', '2020-11-01 16:43:27', '2020-11-01 16:49:06', 0),
(36, 9, 0, '117.8.99.61', '2021-08-07 14:06:44', '2021-08-07 16:49:38', 0),
(37, 9, 0, '111.186.183.225', '2021-07-09 07:22:15', '2021-07-09 18:00:09', 0),
(38, 9, 0, '72.172.115.127', '2021-04-13 09:38:42', '2021-04-13 15:02:25', 0),
(39, 1, 0, '82.9.179.225', '2023-05-13 22:31:21', '2023-05-14 13:50:35', 0),
(40, 1, 0, '54.174.208.77', '2020-07-23 13:44:22', '2020-07-23 14:17:13', 0),
(41, 9, 0, '42.152.42.183', '2022-02-15 09:21:40', '2022-02-15 10:10:43', 0),
(42, 11, 0, '73.66.133.235', '2020-01-31 05:37:38', '2020-01-31 13:02:04', 0),
(43, 9, 0, '32.40.30.182', '2021-03-19 20:03:47', '2021-03-20 08:01:19', 0),
(44, 9, 0, '85.176.44.58', '2020-03-06 10:43:46', '2020-03-06 17:07:00', 0),
(45, 1, 0, '11.83.237.90', '2021-02-28 16:36:22', '2021-02-28 16:51:24', 0),
(46, 11, 0, '81.161.134.51', '2023-12-07 09:51:15', '2023-12-07 10:28:31', 0),
(47, 11, 0, '17.225.95.116', '2022-07-16 13:27:17', '2022-07-16 16:07:11', 0),
(48, 9, 0, '64.235.197.57', '2020-04-20 06:22:27', '2020-04-20 09:58:53', 0),
(49, 9, 0, '53.205.178.112', '2022-06-10 18:50:28', '2022-06-10 21:59:02', 0),
(50, 9, 0, '41.205.17.73', '2021-09-24 06:53:54', '2021-09-24 12:03:52', 0),
(51, 9, 0, '71.251.7.81', '2024-01-13 14:27:52', '2024-01-13 15:24:19', 0),
(52, 11, 0, '90.62.13.128', '2022-12-27 08:15:03', '2022-12-27 18:08:32', 0),
(53, 9, 0, '41.43.49.225', '2023-03-21 13:56:37', '2023-03-21 17:44:00', 0),
(54, 9, 0, '87.187.82.59', '2023-02-18 03:11:57', '2023-02-18 10:45:19', 0),
(55, 11, 0, '113.68.83.32', '2021-06-17 02:15:01', '2021-06-17 12:36:02', 0),
(56, 1, 0, '123.32.109.182', '2021-10-17 14:13:03', '2021-10-17 16:04:41', 0),
(57, 1, 0, '93.153.119.10', '2020-01-23 00:59:23', '2020-01-23 17:32:35', 0),
(58, 9, 0, '47.209.224.221', '2022-01-12 14:47:22', '2022-01-12 17:36:03', 0),
(59, 1, 0, '97.16.200.101', '2022-05-01 00:20:12', '2022-05-01 00:56:28', 0),
(60, 11, 0, '73.139.221.175', '2020-11-08 19:01:37', '2020-11-09 14:25:26', 0),
(61, 9, 0, '53.241.220.221', '2020-02-20 03:46:03', '2020-02-20 14:19:23', 0),
(62, 11, 0, '39.182.63.99', '2020-10-19 00:18:57', '2020-10-19 00:33:35', 0),
(63, 1, 0, '95.209.140.103', '2020-01-27 23:47:09', '2020-01-28 09:35:28', 0),
(64, 9, 0, '41.131.252.111', '2023-09-21 16:35:41', '2023-09-21 18:26:47', 0),
(65, 1, 0, '92.154.183.114', '2022-12-23 03:21:26', '2022-12-23 09:05:10', 0),
(66, 9, 0, '78.94.139.241', '2021-09-04 10:31:03', '2021-09-04 16:12:32', 0),
(67, 1, 0, '105.46.12.104', '2020-05-23 07:25:50', '2020-05-23 08:46:18', 0),
(68, 9, 0, '111.178.42.116', '2022-10-15 04:44:55', '2022-10-15 09:19:51', 0),
(69, 11, 0, '16.137.109.212', '2020-05-14 11:43:52', '2020-05-14 14:09:25', 0),
(70, 11, 0, '76.111.167.70', '2021-01-10 20:52:51', '2021-01-11 03:33:47', 0),
(71, 1, 0, '35.243.0.105', '2022-04-21 21:24:54', '2022-04-22 18:02:45', 0),
(72, 11, 0, '23.134.251.128', '2023-12-20 13:05:21', '2023-12-20 17:28:26', 0),
(73, 9, 0, '88.47.61.46', '2022-02-26 14:46:25', '2022-02-26 17:56:22', 0),
(74, 11, 0, '84.119.186.235', '2021-05-14 12:08:02', '2021-05-14 15:04:15', 0),
(75, 11, 0, '35.137.255.145', '2023-12-25 12:31:26', '2023-12-25 18:16:32', 0),
(76, 11, 0, '109.10.105.112', '2022-08-11 08:16:07', '2022-08-11 12:42:54', 0),
(77, 9, 0, '57.0.109.172', '2020-08-02 04:45:46', '2020-08-02 17:27:00', 0),
(78, 9, 0, '121.77.73.49', '2022-01-24 00:56:19', '2022-01-24 15:06:33', 0),
(79, 1, 0, '29.209.135.163', '2021-05-29 02:26:52', '2021-05-29 11:19:41', 0),
(80, 11, 0, '125.238.97.165', '2021-10-04 03:50:48', '2021-10-04 18:11:35', 0),
(81, 1, 0, '62.164.96.141', '2022-10-27 21:59:56', '2022-10-28 11:22:19', 0),
(82, 9, 0, '109.167.42.192', '2020-07-11 00:08:53', '2020-07-11 14:57:43', 0),
(83, 1, 0, '3.168.133.128', '2020-09-10 22:29:12', '2020-09-11 07:51:31', 0),
(84, 9, 0, '0.102.177.174', '2023-05-09 23:36:31', '2023-05-10 06:33:58', 0),
(85, 11, 0, '30.180.95.229', '2022-03-30 02:40:45', '2022-03-30 08:44:29', 0),
(86, 11, 0, '55.161.40.219', '2021-09-05 21:43:36', '2021-09-06 05:59:38', 0),
(87, 9, 0, '62.199.217.249', '2022-01-19 20:54:01', '2022-01-20 12:36:47', 0),
(88, 11, 0, '126.50.125.175', '2023-08-05 20:12:26', '2023-08-06 11:53:23', 0),
(89, 9, 0, '95.128.202.147', '2022-09-22 15:39:19', '2022-09-22 17:09:14', 0),
(90, 9, 0, '67.216.58.250', '2021-03-17 22:43:17', '2021-03-18 04:08:39', 0),
(91, 1, 0, '4.101.217.185', '2023-05-22 07:29:30', '2023-05-22 08:17:19', 0),
(92, 9, 0, '118.250.58.252', '2020-07-07 17:55:55', '2020-07-07 18:20:54', 0),
(93, 11, 0, '112.117.51.107', '2021-12-20 13:17:38', '2021-12-20 14:20:12', 0),
(94, 11, 0, '72.188.113.25', '2020-10-11 07:18:17', '2020-10-11 11:50:43', 0),
(95, 11, 0, '123.85.221.206', '2020-11-27 00:54:18', '2020-11-27 16:39:29', 0),
(96, 11, 0, '3.39.30.31', '2020-04-26 11:01:21', '2020-04-26 14:07:58', 0),
(97, 9, 0, '81.105.42.34', '2020-11-01 23:32:40', '2020-11-02 01:42:08', 0),
(98, 1, 0, '120.204.190.57', '2023-01-21 06:46:22', '2023-01-21 16:44:56', 0),
(99, 1, 0, '87.31.54.175', '2020-09-19 01:21:42', '2020-09-19 10:04:07', 0),
(100, 1, 0, '106.25.124.12', '2021-12-17 02:49:54', '2021-12-17 04:28:47', 0),
(101, 9, 0, '76.195.186.149', '2020-04-20 19:25:42', '2020-04-21 12:32:17', 0),
(102, 9, 0, '118.148.5.164', '2023-01-26 19:29:40', '2023-01-27 04:03:46', 0),
(103, 9, 0, '89.173.182.99', '2022-03-30 02:13:35', '2022-03-30 17:07:41', 0),
(104, 9, 0, '119.163.106.127', '2021-11-29 08:34:39', '2021-11-29 13:13:28', 0),
(105, 9, 0, '18.20.253.14', '2022-01-13 11:21:15', '2022-01-13 18:20:20', 0),
(106, 11, 0, '0.193.233.245', '2021-10-08 09:11:26', '2021-10-08 10:06:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `g_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `g_name`) VALUES
(1, 'Male'),
(2, 'Female'),
(3, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE `lab` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `start_time` varchar(100) NOT NULL,
  `end_time` varchar(100) NOT NULL,
  `task_title` varchar(255) NOT NULL,
  `task_desc` varchar(2000) NOT NULL,
  `task_file` varchar(2000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`id`, `department_id`, `year_id`, `subject_id`, `start_time`, `end_time`, `task_title`, `task_desc`, `task_file`, `date`) VALUES
(1, 1, 2, 1, '10.00', '13.00', 'Sample Task', 'Sample Desc', '', '2024-02-02 20:10:33'),
(10, 1, 2, 1, '13.00', '15.00', '', '', '', '2024-02-03 11:25:16'),
(12, 1, 1, 1, '15.00', '16.00', '', '', '', '2024-02-03 11:52:29'),
(14, 1, 1, 1, '16.00', '17.00', '', '', '', '2024-02-20 16:51:19'),
(15, 2, 3, 2, '17.00', '18.00', '', '', '', '2024-05-30 18:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `lab_attendance`
--

CREATE TABLE `lab_attendance` (
  `id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `is_attended` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lab_attendance`
--

INSERT INTO `lab_attendance` (`id`, `lab_id`, `student_id`, `is_attended`) VALUES
(1, 1, 33, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `year_sem_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `notes` text NOT NULL,
  `notes_file` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `year_sem_id`, `department_id`, `subject_id`, `notes`, `notes_file`, `time`) VALUES
(6, 2, 1, 1, '<p>Test</p><h2>&nbsp;</h2><p>asd</p><p>&nbsp;</p>', 'uploads/notes/2fa4c70fd6e83327d80e5ce211ed9806BT Notes.pdf', '2024-02-03 12:07:57'),
(8, 1, 1, 1, 'Sample Notes', 'uploads/notes/2fa4c70fd6e83327d80e5ce211ed9806BT Notes.pdf', '2024-03-01 05:38:17'),
(9, 7, 2, 3, 'Sample Notes', 'uploads/notes/2fa4c70fd6e83327d80e5ce211ed9806BT Notes.pdf', '2024-03-01 05:38:17'),
(10, 2, 1, 3, 'Sample Notes', 'uploads/notes/2fa4c70fd6e83327d80e5ce211ed9806BT Notes.pdf', '2024-03-01 05:38:17'),
(11, 3, 4, 3, 'Sample Notes', 'uploads/notes/2fa4c70fd6e83327d80e5ce211ed9806BT Notes.pdf', '2024-03-01 05:38:17'),
(12, 4, 3, 2, 'Sample Notes', 'uploads/notes/2fa4c70fd6e83327d80e5ce211ed9806BT Notes.pdf', '2024-03-01 05:38:17'),
(13, 1, 3, 2, 'Sample Notes', 'uploads/notes/2fa4c70fd6e83327d80e5ce211ed9806BT Notes.pdf', '2024-03-01 05:38:17'),
(14, 3, 4, 2, 'Sample Notes', 'uploads/notes/2fa4c70fd6e83327d80e5ce211ed9806BT Notes.pdf', '2024-03-01 05:38:17'),
(15, 7, 3, 1, 'Sample Notes', 'uploads/notes/2fa4c70fd6e83327d80e5ce211ed9806BT Notes.pdf', '2024-03-01 05:38:17'),
(16, 6, 3, 2, 'Sample Notes', 'uploads/notes/2fa4c70fd6e83327d80e5ce211ed9806BT Notes.pdf', '2024-03-01 05:38:17'),
(17, 8, 3, 1, 'Sample Notes', 'uploads/notes/2fa4c70fd6e83327d80e5ce211ed9806BT Notes.pdf', '2024-03-01 05:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `notes_download`
--

CREATE TABLE `notes_download` (
  `id` int(11) NOT NULL,
  `notes_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `is_downloaded` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notes_download`
--

INSERT INTO `notes_download` (`id`, `notes_id`, `student_id`, `is_downloaded`) VALUES
(1, 6, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `email`, `otp`) VALUES
(1, 'alanwalker7102001@gmail.com', 655613),
(5, 'alanwalker7102001@gmail.com', 109048),
(6, 'vivek.tnitservicesllp@gmail.com', 805347),
(7, 'swamiprathmesh2002@gmail.com', 138176),
(8, 'alanwalker7102001@gmail.com', 424805),
(9, 'alanwalker7102001@gmail.com', 407857),
(10, 'alanwalker7102001@gmail.com', 208037),
(11, 'alanwalker7102001@gmail.com', 533029),
(12, 'alanwalker7102001@gmail.com', 407080),
(13, 'swamiprathmesh2002@gmail.com', 960290);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `s_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `s_name`) VALUES
(1, 'DSA'),
(2, 'ML'),
(3, 'CNS');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `task_title` varchar(2000) NOT NULL,
  `task_file` varchar(2000) NOT NULL,
  `task_desc` varchar(2000) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `lab_id`, `task_title`, `task_file`, `task_desc`, `status`, `time`) VALUES
(1, 1, 1, '', '', 'test', 0, '2024-02-25 21:03:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `f_name` varchar(1000) DEFAULT NULL,
  `m_name` varchar(1000) DEFAULT NULL,
  `l_name` varchar(1000) DEFAULT NULL,
  `user_img` varchar(2000) NOT NULL DEFAULT './images/image.png',
  `dob` varchar(100) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `emailVerified` int(11) NOT NULL DEFAULT 0,
  `dept_id` int(11) DEFAULT NULL,
  `year_id` int(11) DEFAULT NULL,
  `enrollment_id` int(11) DEFAULT NULL,
  `PRN` varchar(100) DEFAULT NULL,
  `password` varchar(2000) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `role` int(11) NOT NULL DEFAULT 2,
  `isVerified` int(11) NOT NULL DEFAULT 0,
  `user_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `f_name`, `m_name`, `l_name`, `user_img`, `dob`, `gender`, `mobile`, `email`, `emailVerified`, `dept_id`, `year_id`, `enrollment_id`, `PRN`, `password`, `status`, `role`, `isVerified`, `user_date`) VALUES
(1, 'Kalpesh', 'Milind', 'Padmawar', 'uploads/images/adb4f6f66073a385d9f0040dd67ab88drealme.jpg', '07/10/2001', 1, '1234567890', 'itsviv1433@gmail.com', 0, 1, 2, 123456778, '6969696', '$2y$10$.4Fi/aLFyCCDvNFgDhLizegFKUd3XtpoScjytFid7Y4PcfVPr/f6C', 1, 1, 1, '2022-05-06 14:26:54'),
(9, 'Test', 'M', 'User', './images/image.png', '12/12/12', 2, '12222', 'test@user.com', 0, 1, 2, 54728917, '112212', '$2y$10$eRLvs/4gUR67ebmyfKEYGO3tEwNjmvnFkHvfj.3PQ7rvqfqU3cd6u', 0, 1, 1, '2024-01-28 20:03:20'),
(11, 'Test', 'Test', 'Test', './images/image.png', '12.2121', 1, '13455555', 'tet@test.com', 0, 3, 1, 66421792, '12121212', '$2y$10$vIEt8ZNgXuj4Yp6NkQNzreYDt5IVhVKJBZhl.FWTmMFJBdDrk9Vxy', 1, 2, 1, '2024-02-03 19:55:46'),
(13, 'Vivek', 'Janardan', 'Mahajan', './images/image.png', '2024-02-18', 1, '1234567890', 'sample@gmail.com', 0, 4, 1, 0, '12345678H', '12345', 1, 2, 1, '2024-02-18 14:35:28'),
(14, 'John', 'Doe', 'Smith', 'profile_pic1.jpg', '1995-05-15', 1, '9876543210', 'john.doe@example.com', 0, 1, 1, 0, 'PRN001', 'password1', 1, 2, 0, '2024-02-26 02:07:50'),
(15, 'Jane', 'Doe', 'Johnson', 'profile_pic2.jpg', '1996-08-21', 2, '9876543211', 'jane.doe@example.com', 0, 2, 2, 0, 'PRN002', 'password2', 1, 2, 0, '2024-02-26 02:07:50'),
(16, 'Bob', 'Smith', 'Taylor', 'profile_pic3.jpg', '1997-02-10', 3, '9876543212', 'bob.smith@example.com', 0, 3, 3, 0, 'PRN003', 'password3', 1, 2, 0, '2024-02-26 02:07:50'),
(17, 'Alice', 'Jones', 'Miller', 'profile_pic4.jpg', '1998-11-30', 1, '9876543213', 'alice.jones@example.com', 0, 2, 4, 0, 'PRN004', 'password4', 1, 2, 0, '2024-02-26 02:07:50'),
(18, 'Charlie', 'Brown', 'Davis', 'profile_pic5.jpg', '1999-07-05', 2, '9876543214', 'charlie.brown@example.com', 0, 2, 5, 0, 'PRN005', 'password5', 1, 2, 0, '2024-02-26 02:07:50'),
(19, 'Emma', 'Clark', 'Evans', 'profile_pic6.jpg', '2000-04-18', 3, '9876543215', 'emma.clark@example.com', 0, 3, 6, 0, 'PRN006', 'password6', 1, 2, 0, '2024-02-26 02:07:50'),
(20, 'David', 'Fisher', 'Gomez', 'profile_pic7.jpg', '2001-01-22', 1, '9876543216', 'david.fisher@example.com', 0, 1, 7, 0, 'PRN007', 'password7', 1, 2, 0, '2024-02-26 02:07:50'),
(21, 'Grace', 'Harris', 'Irwin', 'profile_pic8.jpg', '2002-09-13', 2, '9876543217', 'grace.harris@example.com', 0, 2, 8, 0, 'PRN008', 'password8', 1, 2, 0, '2024-02-26 02:07:50'),
(22, 'Frank', 'Jackson', 'Klein', 'profile_pic9.jpg', '2003-06-07', 3, '9876543218', 'frank.jackson@example.com', 0, 3, 1, 0, 'PRN009', 'password9', 1, 2, 0, '2024-02-26 02:07:50'),
(23, 'Olivia', 'Lee', 'Martin', 'profile_pic10.jpg', '2004-03-25', 1, '9876543219', 'olivia.lee@example.com', 0, 4, 2, 0, 'PRN010', 'password10', 1, 2, 0, '2024-02-26 02:07:50'),
(24, 'Peter', 'Nelson', 'Owen', 'profile_pic11.jpg', '2005-10-09', 2, '9876543220', 'peter.nelson@example.com', 0, 2, 3, 0, 'PRN011', 'password11', 1, 2, 0, '2024-02-26 02:07:50'),
(25, 'Quinn', 'Patel', 'Reyes', 'profile_pic12.jpg', '2006-07-14', 3, '9876543221', 'quinn.patel@example.com', 0, 3, 4, 0, 'PRN012', 'password12', 1, 2, 0, '2024-02-26 02:07:50'),
(26, 'Rachel', 'Smith', 'Turner', 'profile_pic13.jpg', '2007-04-03', 1, '9876543222', 'rachel.smith@example.com', 0, 1, 5, 0, 'PRN013', 'password13', 1, 2, 0, '2024-02-26 02:07:50'),
(27, 'Samuel', 'Thomas', 'Williams', 'profile_pic14.jpg', '2008-01-17', 2, '9876543223', 'samuel.thomas@example.com', 0, 2, 6, 0, 'PRN014', 'password14', 1, 2, 0, '2024-02-26 02:07:50'),
(28, 'Tina', 'Upton', 'Vargas', 'profile_pic15.jpg', '2009-08-28', 3, '9876543224', 'tina.upton@example.com', 0, 3, 7, 0, 'PRN015', 'password15', 1, 2, 0, '2024-02-26 02:07:50'),
(29, 'Victor', 'Ward', 'Young', 'profile_pic16.jpg', '2010-05-12', 1, '9876543225', 'victor.ward@example.com', 0, 1, 8, 0, 'PRN016', 'password16', 1, 2, 0, '2024-02-26 02:07:50'),
(30, 'Wendy', 'Xu', 'Zimmerman', 'profile_pic17.jpg', '2011-02-26', 2, '9876543226', 'wendy.xu@example.com', 0, 2, 1, 0, 'PRN017', 'password17', 1, 2, 0, '2024-02-26 02:07:50'),
(31, 'Xander', 'Yates', 'Zane', 'profile_pic18.jpg', '2012-11-11', 3, '9876543227', 'xander.yates@example.com', 0, 3, 2, 0, 'PRN018', 'password18', 1, 2, 0, '2024-02-26 02:07:50'),
(33, 'Kalpesh', 'Milind', 'Padmawar', './images/image.png', '2003-12-12', 1, '1234567890', 'kalpeshpadmawar22@gmail.com', 1, 1, 2, 24319134, '12121212H', '$2y$10$E4qE.wvP.BYJ0O5w8fAV.OKXaYqZnGKisr9ShwLFBX8klAslpETBS', 1, 2, 1, '2024-02-29 02:30:27'),
(34, 'Prathmesh', 'Santosh', 'Swami', './images/image.png', '2001-02-06', 1, '7219276033', 'swamiprathmesh2002@gmail.com', 1, 1, 2, 45732225, '12345678H', '$2y$10$mKMsRD684GrA/R5j68PQ7e2TF7CYxuNhbJTytvsVyqrfv3ktzsZqq', 1, 1, 1, '2024-03-01 14:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`id`, `year`, `semester`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2),
(5, 3, 1),
(6, 3, 2),
(7, 4, 1),
(8, 4, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab`
--
ALTER TABLE `lab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_attendance`
--
ALTER TABLE `lab_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes_download`
--
ALTER TABLE `notes_download`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lab`
--
ALTER TABLE `lab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `lab_attendance`
--
ALTER TABLE `lab_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `notes_download`
--
ALTER TABLE `notes_download`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
