-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2024 at 08:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parent_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_user_name` varchar(100) NOT NULL,
  `admin_password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_user_name`, `admin_password`) VALUES
(1, 'admin', '$2y$10$D74Zy1qMkATvmGRoVeq7hed4ajWof2aqDGnEaD3yPHABA.p.e7f4u');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance_status` enum('Present','Absent') NOT NULL,
  `attendance_date` date NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`attendance_id`, `student_id`, `attendance_status`, `attendance_date`, `teacher_id`) VALUES
(1, 7, 'Present', '2019-05-01', 3),
(2, 8, 'Present', '2019-05-01', 3),
(3, 9, 'Absent', '2019-05-01', 3),
(4, 10, 'Present', '2019-05-01', 3),
(5, 11, 'Present', '2019-05-01', 3),
(6, 7, 'Absent', '2019-05-02', 3),
(7, 8, 'Present', '2019-05-02', 3),
(8, 9, 'Present', '2019-05-02', 3),
(9, 10, 'Present', '2019-05-02', 3),
(10, 11, 'Absent', '2019-05-02', 3),
(11, 1, 'Present', '2019-05-01', 2),
(12, 3, 'Present', '2019-05-01', 2),
(13, 4, 'Present', '2019-05-01', 2),
(14, 5, 'Present', '2019-05-01', 2),
(15, 6, 'Present', '2019-05-01', 2),
(16, 1, 'Present', '2019-05-02', 2),
(17, 3, 'Absent', '2019-05-02', 2),
(18, 4, 'Present', '2019-05-02', 2),
(19, 5, 'Absent', '2019-05-02', 2),
(20, 6, 'Present', '2019-05-02', 2),
(21, 1, 'Present', '2019-05-03', 2),
(22, 3, 'Present', '2019-05-03', 2),
(23, 4, 'Absent', '2019-05-03', 2),
(24, 5, 'Present', '2019-05-03', 2),
(25, 6, 'Present', '2019-05-03', 2),
(26, 1, 'Absent', '2019-05-04', 2),
(27, 3, 'Present', '2019-05-04', 2),
(28, 4, 'Present', '2019-05-04', 2),
(29, 5, 'Present', '2019-05-04', 2),
(30, 6, 'Present', '2019-05-04', 2),
(31, 1, 'Present', '2019-05-06', 2),
(32, 3, 'Present', '2019-05-06', 2),
(33, 4, 'Present', '2019-05-06', 2),
(34, 5, 'Present', '2019-05-06', 2),
(35, 6, 'Present', '2019-05-06', 2),
(36, 1, 'Present', '2019-05-07', 2),
(37, 3, 'Present', '2019-05-07', 2),
(38, 4, 'Present', '2019-05-07', 2),
(39, 5, 'Present', '2019-05-07', 2),
(40, 6, 'Absent', '2019-05-07', 2),
(41, 1, 'Present', '2019-05-08', 2),
(42, 3, 'Present', '2019-05-08', 2),
(43, 4, 'Present', '2019-05-08', 2),
(44, 5, 'Absent', '2019-05-08', 2),
(45, 6, 'Present', '2019-05-08', 2),
(46, 1, 'Present', '2019-05-09', 2),
(47, 3, 'Present', '2019-05-09', 2),
(48, 4, 'Present', '2019-05-09', 2),
(49, 5, 'Present', '2019-05-09', 2),
(50, 6, 'Present', '2019-05-09', 2),
(51, 1, 'Present', '2019-05-10', 2),
(52, 3, 'Absent', '2019-05-10', 2),
(53, 4, 'Absent', '2019-05-10', 2),
(54, 5, 'Present', '2019-05-10', 2),
(55, 6, 'Absent', '2019-05-10', 2),
(56, 1, 'Present', '2019-05-11', 2),
(57, 3, 'Present', '2019-05-11', 2),
(58, 4, 'Absent', '2019-05-11', 2),
(59, 5, 'Present', '2019-05-11', 2),
(60, 6, 'Absent', '2019-05-11', 2),
(61, 7, 'Present', '2019-05-03', 3),
(62, 8, 'Present', '2019-05-03', 3),
(63, 9, 'Present', '2019-05-03', 3),
(64, 10, 'Present', '2019-05-03', 3),
(65, 11, 'Present', '2019-05-03', 3),
(66, 7, 'Absent', '2019-05-04', 3),
(67, 8, 'Present', '2019-05-04', 3),
(68, 9, 'Absent', '2019-05-04', 3),
(69, 10, 'Present', '2019-05-04', 3),
(70, 11, 'Absent', '2019-05-04', 3),
(71, 7, 'Present', '2019-05-06', 3),
(72, 8, 'Present', '2019-05-06', 3),
(73, 9, 'Absent', '2019-05-06', 3),
(74, 10, 'Present', '2019-05-06', 3),
(75, 11, 'Present', '2019-05-06', 3),
(76, 7, 'Present', '2019-05-07', 3),
(77, 8, 'Present', '2019-05-07', 3),
(78, 9, 'Present', '2019-05-07', 3),
(79, 10, 'Present', '2019-05-07', 3),
(80, 11, 'Present', '2019-05-07', 3),
(81, 7, 'Present', '2019-05-08', 3),
(82, 8, 'Present', '2019-05-08', 3),
(83, 9, 'Present', '2019-05-08', 3),
(84, 10, 'Absent', '2019-05-08', 3),
(85, 11, 'Absent', '2019-05-08', 3),
(86, 7, 'Present', '2019-05-09', 3),
(87, 8, 'Present', '2019-05-09', 3),
(88, 9, 'Absent', '2019-05-09', 3),
(89, 10, 'Present', '2019-05-09', 3),
(90, 11, 'Present', '2019-05-09', 3),
(91, 7, 'Absent', '2019-05-10', 3),
(92, 8, 'Present', '2019-05-10', 3),
(93, 9, 'Present', '2019-05-10', 3),
(94, 10, 'Present', '2019-05-10', 3),
(95, 11, 'Absent', '2019-05-10', 3),
(96, 7, 'Present', '2019-05-11', 3),
(97, 8, 'Present', '2019-05-11', 3),
(98, 9, 'Present', '2019-05-11', 3),
(99, 10, 'Absent', '2019-05-11', 3),
(100, 11, 'Present', '2019-05-11', 3),
(101, 12, 'Present', '2019-05-01', 4),
(102, 13, 'Present', '2019-05-01', 4),
(103, 14, 'Present', '2019-05-01', 4),
(104, 15, 'Present', '2019-05-01', 4),
(105, 16, 'Present', '2019-05-01', 4),
(106, 12, 'Present', '2019-05-02', 4),
(107, 13, 'Absent', '2019-05-02', 4),
(108, 14, 'Present', '2019-05-02', 4),
(109, 15, 'Absent', '2019-05-02', 4),
(110, 16, 'Present', '2019-05-02', 4),
(111, 12, 'Present', '2019-05-03', 4),
(112, 13, 'Present', '2019-05-03', 4),
(113, 14, 'Present', '2019-05-03', 4),
(114, 15, 'Absent', '2019-05-03', 4),
(115, 16, 'Present', '2019-05-03', 4),
(116, 12, 'Present', '2019-05-04', 4),
(117, 13, 'Present', '2019-05-04', 4),
(118, 14, 'Present', '2019-05-04', 4),
(119, 15, 'Present', '2019-05-04', 4),
(120, 16, 'Present', '2019-05-04', 4),
(121, 12, 'Present', '2019-05-06', 4),
(122, 13, 'Absent', '2019-05-06', 4),
(123, 14, 'Absent', '2019-05-06', 4),
(124, 15, 'Present', '2019-05-06', 4),
(125, 16, 'Present', '2019-05-06', 4),
(126, 12, 'Absent', '2019-05-07', 4),
(127, 13, 'Present', '2019-05-07', 4),
(128, 14, 'Present', '2019-05-07', 4),
(129, 15, 'Present', '2019-05-07', 4),
(130, 16, 'Absent', '2019-05-07', 4),
(131, 12, 'Present', '2019-05-08', 4),
(132, 13, 'Absent', '2019-05-08', 4),
(133, 14, 'Present', '2019-05-08', 4),
(134, 15, 'Present', '2019-05-08', 4),
(135, 16, 'Present', '2019-05-08', 4),
(136, 12, 'Present', '2019-05-09', 4),
(137, 13, 'Present', '2019-05-09', 4),
(138, 14, 'Present', '2019-05-09', 4),
(139, 15, 'Present', '2019-05-09', 4),
(140, 16, 'Absent', '2019-05-09', 4),
(141, 12, 'Present', '2019-05-10', 4),
(142, 13, 'Absent', '2019-05-10', 4),
(143, 14, 'Present', '2019-05-10', 4),
(144, 15, 'Present', '2019-05-10', 4),
(145, 16, 'Absent', '2019-05-10', 4),
(146, 12, 'Present', '2019-05-11', 4),
(147, 13, 'Present', '2019-05-11', 4),
(148, 14, 'Present', '2019-05-11', 4),
(149, 15, 'Present', '2019-05-11', 4),
(150, 16, 'Present', '2019-05-11', 4),
(151, 17, 'Present', '2019-05-01', 5),
(152, 18, 'Present', '2019-05-01', 5),
(153, 19, 'Present', '2019-05-01', 5),
(154, 20, 'Absent', '2019-05-01', 5),
(155, 21, 'Absent', '2019-05-01', 5),
(156, 17, 'Present', '2019-05-02', 5),
(157, 18, 'Present', '2019-05-02', 5),
(158, 19, 'Present', '2019-05-02', 5),
(159, 20, 'Present', '2019-05-02', 5),
(160, 21, 'Present', '2019-05-02', 5),
(161, 17, 'Present', '2019-05-03', 5),
(162, 18, 'Present', '2019-05-03', 5),
(163, 19, 'Present', '2019-05-03', 5),
(164, 20, 'Present', '2019-05-03', 5),
(165, 21, 'Absent', '2019-05-03', 5),
(166, 17, 'Present', '2019-05-04', 5),
(167, 18, 'Present', '2019-05-04', 5),
(168, 19, 'Absent', '2019-05-04', 5),
(169, 20, 'Present', '2019-05-04', 5),
(170, 21, 'Present', '2019-05-04', 5),
(171, 17, 'Present', '2019-05-06', 5),
(172, 18, 'Present', '2019-05-06', 5),
(173, 19, 'Present', '2019-05-06', 5),
(174, 20, 'Present', '2019-05-06', 5),
(175, 21, 'Present', '2019-05-06', 5),
(176, 17, 'Present', '2019-05-07', 5),
(177, 18, 'Present', '2019-05-07', 5),
(178, 19, 'Present', '2019-05-07', 5),
(179, 20, 'Present', '2019-05-07', 5),
(180, 21, 'Absent', '2019-05-07', 5),
(181, 17, 'Present', '2019-05-08', 5),
(182, 18, 'Present', '2019-05-08', 5),
(183, 19, 'Present', '2019-05-08', 5),
(184, 20, 'Absent', '2019-05-08', 5),
(185, 21, 'Present', '2019-05-08', 5),
(186, 17, 'Present', '2019-05-09', 5),
(187, 18, 'Present', '2019-05-09', 5),
(188, 19, 'Absent', '2019-05-09', 5),
(189, 20, 'Absent', '2019-05-09', 5),
(190, 21, 'Present', '2019-05-09', 5),
(191, 17, 'Absent', '2019-05-10', 5),
(192, 18, 'Present', '2019-05-10', 5),
(193, 19, 'Present', '2019-05-10', 5),
(194, 20, 'Present', '2019-05-10', 5),
(195, 21, 'Present', '2019-05-10', 5),
(196, 17, 'Present', '2019-05-11', 5),
(197, 18, 'Present', '2019-05-11', 5),
(198, 19, 'Present', '2019-05-11', 5),
(199, 20, 'Absent', '2019-05-11', 5),
(200, 21, 'Present', '2019-05-11', 5),
(201, 7, 'Present', '2019-05-13', 3),
(202, 8, 'Present', '2019-05-13', 3),
(203, 9, 'Present', '2019-05-13', 3),
(204, 10, 'Absent', '2019-05-13', 3),
(205, 11, 'Present', '2019-05-13', 3),
(206, 7, 'Present', '2019-05-14', 3),
(207, 8, 'Present', '2019-05-14', 3),
(208, 9, 'Absent', '2019-05-14', 3),
(209, 10, 'Present', '2019-05-14', 3),
(210, 11, 'Present', '2019-05-14', 3),
(211, 1, 'Present', '2024-01-24', 2),
(212, 3, 'Absent', '2024-01-24', 2),
(213, 4, 'Present', '2024-01-24', 2),
(214, 5, 'Absent', '2024-01-24', 2),
(215, 6, 'Present', '2024-01-24', 2),
(216, 22, 'Absent', '2024-01-24', 2),
(217, 1, 'Absent', '2024-01-17', 2),
(218, 3, 'Absent', '2024-01-17', 2),
(219, 4, 'Absent', '2024-01-17', 2),
(220, 5, 'Absent', '2024-01-17', 2),
(221, 6, 'Absent', '2024-01-17', 2),
(222, 22, 'Absent', '2024-01-17', 2),
(223, 1, 'Absent', '2024-01-31', 2),
(224, 3, 'Absent', '2024-01-31', 2),
(225, 4, 'Absent', '2024-01-31', 2),
(226, 5, 'Absent', '2024-01-31', 2),
(227, 6, 'Absent', '2024-01-31', 2),
(228, 22, 'Absent', '2024-01-31', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade`
--

CREATE TABLE `tbl_grade` (
  `grade_id` int(11) NOT NULL,
  `grade_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_grade`
--

INSERT INTO `tbl_grade` (`grade_id`, `grade_name`) VALUES
(1, '11 - A'),
(2, '11 - B'),
(3, '12 - A'),
(4, '12 - B'),
(5, '11 - C'),
(6, '13.a');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_parent`
--

CREATE TABLE `tbl_parent` (
  `parent_id` int(11) NOT NULL,
  `parent_name` varchar(150) NOT NULL,
  `parent_address` text NOT NULL,
  `parent_emailid` varchar(100) NOT NULL,
  `parent_password` varchar(100) NOT NULL,
  `parent_mobile` varchar(100) NOT NULL,
  `Alternate_mobile` varchar(100) NOT NULL,
  `parent_job` varchar(100) NOT NULL,
  `parent_doj` date NOT NULL,
  `sex` varchar(100) NOT NULL,
  `parent_relation` varchar(100) NOT NULL,
  `parent_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_parent`
--

INSERT INTO `tbl_parent` (`parent_id`, `parent_name`, `parent_address`, `parent_emailid`, `parent_password`, `parent_mobile`, `Alternate_mobile`, `parent_job`, `parent_doj`, `sex`, `parent_relation`, `parent_image`) VALUES
(12, 'getaneh', 'err', 'getanehwendwesen0@gmail.com', '$2y$10$YMmAtr0ersKp.umwuBhEO.bPRYr.O9ljgUUM4p8ZQdxRTATrWaDhe', '', '', 'rt', '2024-01-14', '', 'Elder-brother', '65aab46979cfc.jpg'),
(14, 'amanuel', 'kkklklkl', 'jonathan12@gmail.com', '$2y$10$MQgNsnWeRv6tmH7Q.uRqXuyTvyjPiTEr1wkWBRVEhy2/3WRWQJnca', '', '', 'fgfg', '2024-01-22', '', 'Grand-Father', '65aab6d2796d0.jpg'),
(15, 'zelalem', 'trtrtr', 'jonatn12@gmail.com', '$2y$10$7UcM6OKBD/8uC/7heQiXYeHtEDv.ZnJwtxHMe40oJCGyXmbSZ3SlG', '', '', 'fgfg', '2024-01-14', '', 'Elder-brother', '65abbd60b70ec.jpg'),
(16, 'begashaw', 'jimma', 'getanehesen0@gmail.com', '$2y$10$oRHWG2sRb3x7t2t2SS298.jPD.PPsWNVgHvvMDHhxcWECANGYeXQ6', '0991230656', '', 'fgfg', '2024-01-23', 'Male', 'Grand-Mother', '65b5f7b0eed00.jpg'),
(17, 'getaneh Wendwesen', 'Mesquite', 'gewesen0@gmail.com', '$2y$10$7ewj.NzjhND1W6RiIB4U2.NMvOcftN.utEMgnBFS/BPzZYX6JZjS6', '0991230656', '', 'rt', '2024-01-23', 'Male', 'Father', '65b5ffa469c09.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_relation`
--

CREATE TABLE `tbl_relation` (
  `relation_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_relation`
--

INSERT INTO `tbl_relation` (`relation_type`) VALUES
('Mother'),
('Father'),
('Grand-Mother'),
('Grand-Father'),
('Aunt'),
('Uncle'),
('Elder-brother'),
('Elder-sister');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_result`
--

CREATE TABLE `tbl_result` (
  `student_id` int(11) NOT NULL,
  `acedamic_year` varchar(150) NOT NULL,
  `semister` varchar(150) NOT NULL,
  `mathes` float DEFAULT NULL,
  `physics` float DEFAULT NULL,
  `english` float DEFAULT NULL,
  `chemistry` float DEFAULT NULL,
  `biology` float DEFAULT NULL,
  `civic` float DEFAULT NULL,
  `ict` float DEFAULT NULL,
  `sport` float DEFAULT NULL,
  `ethics` varchar(150) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `average` float DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `rank` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_result`
--

INSERT INTO `tbl_result` (`student_id`, `acedamic_year`, `semister`, `mathes`, `physics`, `english`, `chemistry`, `biology`, `civic`, `ict`, `sport`, `ethics`, `total`, `average`, `status`, `rank`, `teacher_id`) VALUES
(6, '2010', 'semister_1', 90, 90, 90, 90, 90, 90, 90, 90, 'A', 720, 90, 'Pass', 1, 2),
(1, '2010', 'semister_1', 70, 70, 70, 70, 70, 70, 70, 70, 'B+', 560, 70, 'Pass', 4, 2),
(22, '2010', 'semister_1', 80, 80, 80, 80, 80, 80, 80, 80, 'A', 640, 80, 'Pass', 2, 2),
(5, '2010', 'semister_1', 75, 75, 75, 75, 75, 75, 75, 75, 'B', 600, 75, 'Pass', 3, 2),
(6, '2011', 'semister_1', 67, 89, 78, 78, 55, 67, 56, 89, 'A+', NULL, NULL, NULL, 0, 2),
(6, '2010', 'semister_2', 56, 56, 56, 56, 76, 67, 67, 67, 'B', 501, 62.625, 'Pass', 3, 2),
(6, '2010', 'semister_2', 10, 10, 10, 10, 10, 10, 10, 10, 'C', 80, 10, 'Fail', 3, 2),
(3, '2010', 'semister_1', 34, 34, 34, 34, 34, 34, 34, 34, 'B+', 272, 34, 'Fail', 5, 2),
(3, '2010', 'semister_2', 56, 56, 56, 56, 56, 56, 56, 56, 'A', 448, 56, 'Pass', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sex`
--

CREATE TABLE `tbl_sex` (
  `sex_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sex`
--

INSERT INTO `tbl_sex` (`sex_type`) VALUES
('Male'),
('Female');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(150) NOT NULL,
  `student_roll_number` int(11) NOT NULL,
  `student_dob` date NOT NULL,
  `student_grade_id` int(11) NOT NULL,
  `student_parent_id` int(100) NOT NULL,
  `student_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`student_id`, `student_name`, `student_roll_number`, `student_dob`, `student_grade_id`, `student_parent_id`, `student_image`) VALUES
(1, 'taneh wendwes', 1, '2003-03-04', 1, 12, '5cdd2ed638edc.jpg'),
(3, 'kidist zelalem', 2, '2003-04-19', 1, 0, '5cdd2ed638edc.jpg'),
(4, 'zelalem belay', 3, '2004-01-15', 1, 14, '5cdd2ed638edc.jpg'),
(5, 'nejat husen', 4, '2003-12-14', 1, 15, '5cdd2ed638edc.jpg'),
(6, 'kidist nejat', 5, '2003-07-12', 1, 0, '5cdd2ed638edc.jpg'),
(7, 'getaneh zelalem', 1, '2003-12-19', 2, 0, '5cdd2ed638edc.jpg'),
(8, 'getaneh zelalem', 2, '2002-12-19', 2, 0, '5cdd2ed638edc.jpg'),
(9, 'getaneh zelalem', 3, '2003-04-01', 2, 0, '5cdd2ed638edc.jpg'),
(10, 'getaneh zelalem', 4, '2003-08-15', 2, 0, '5cdd2ed638edc.jpg'),
(11, 'kidist nejat', 5, '2003-06-18', 2, 0, '5cdd2ed638edc.jpg'),
(12, 'kidist nejat', 1, '2002-05-01', 3, 0, '5cdd2ed638edc.jpg'),
(13, 'nejat husen', 2, '2002-04-12', 3, 0, '5cdd2ed638edc.jpg'),
(14, 'nejat husen', 3, '2002-10-12', 3, 0, '5cdd2ed638edc.jpg'),
(15, 'Lillian Harris', 4, '2002-02-27', 3, 0, '5cdd2ed638edc.jpg'),
(16, 'Charles Reed', 5, '2002-06-12', 3, 0, '5cdd2ed638edc.jpg'),
(17, 'Charles Reed', 1, '2002-08-17', 4, 0, '5cdd2ed638edc.jpg'),
(18, 'Mary Floyd', 2, '2002-09-18', 4, 0, '5cdd2ed638edc.jpg'),
(19, 'zelalem belay', 3, '2002-07-15', 4, 0, '5cdd2ed638edc.jpg'),
(20, 'zelalem belay', 4, '2002-01-14', 4, 0, '5cdd2ed638edc.jpg'),
(21, 'Rafael Royal', 5, '2002-12-05', 4, 0, '5cdd2ed638edc.jpg'),
(22, 'zelalem belay', 1, '2002-04-11', 1, 5657, '5cdd2ed638edc.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE `tbl_subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`subject_id`, `subject_name`, `subject_code`, `teacher_id`) VALUES
(2, 'geography', '5', 3),
(3, 'physics', '567', 4),
(4, 'mathes', '2102', 4),
(5, 'english', '4567', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

CREATE TABLE `tbl_teacher` (
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(150) NOT NULL,
  `teacher_address` text NOT NULL,
  `teacher_emailid` varchar(100) NOT NULL,
  `teacher_password` varchar(100) NOT NULL,
  `teacher_qualification` varchar(100) NOT NULL,
  `teacher_doj` date NOT NULL,
  `teacher_image` varchar(100) NOT NULL,
  `subject` int(100) NOT NULL,
  `teacher_grade_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`teacher_id`, `teacher_name`, `teacher_address`, `teacher_emailid`, `teacher_password`, `teacher_qualification`, `teacher_doj`, `teacher_image`, `subject`, `teacher_grade_id`) VALUES
(2, 'amanuel getaneh', '1810 Kuhl Avenue Gainesville, GA 30501', 'jonathan12@gmail.com', '$2y$10$bLU2dnsW03VvCtg7fCQ/F.lHno/fU5J0zc20/LdpJQJcxTMqfW3EW', 'B.Sc, B.Ed', '2019-05-01', '5cdd2ed638edc.jpg', 2, 1),
(3, 'zelalem belay', '620 Jody Road, Philadelphia, PA 19108', 'peter_parker@gmail.com', '$2y$10$jmgJN1xvteg6XqBnHvT7UerviGNJOSnF8KFzBHnCky0FJWa74Nvmu', 'M.Sc, B. Ed', '2017-12-31', '5ce53488d50ec.jpg', 3, 2),
(4, 'kidist nedaw', '780 University Drive, Chicago, IL 60606', 'john.smith@gmail.com', '$2y$10$Vb9t4CvkJwm41KXgPehuLOFcM7o5Qdm1RFxSBxzh9cvBcc21AUAiW', 'B.Sc', '2019-05-01', '5cdd2f35be8fa.jpg', 4, 3),
(5, 'nejat husen', '3354 Round Table Drive, Cincinnati, OH 45240', 'donna.huber@gmail.com', '$2y$10$SVxX4/7lf3pDs1vrpuJexOG7Ue1e1jqIntGmXip3JzxkB753uxBiO', 'M.Sc', '2019-05-01', '5cdd2f767568c.jpg', 5, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `tbl_parent`
--
ALTER TABLE `tbl_parent`
  ADD PRIMARY KEY (`parent_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_parent`
--
ALTER TABLE `tbl_parent`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
